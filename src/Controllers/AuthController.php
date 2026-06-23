<?php

namespace Controllers;

use Models\User;
use Helpers\Auth;
use Helpers\Response;
use Helpers\Validator;
use Helpers\Flash;
use Models\Database;

class AuthController
{
    private ?User $user = null;

    public function __construct($db)
    {
        if ($db instanceof Database) {
            $this->user = new User($db);
        }
    }

    private function user(): User
    {
        if ($this->user === null) {
            $this->user = new User(Database::instance());
        }

        return $this->user;
    }

    public function loginForm()
    {
        require __DIR__ . '/../Views/Auth/login.php';
    }

    public function registerForm()
    {
        require __DIR__ . '/../Views/Auth/register.php';
    }

    public function register()
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (
            !Validator::required($name) ||
            !Validator::email($email) ||
            !Validator::min($password, 6)
        ) {

            Flash::error("Data tidak valid.");

            Response::redirect('/register');
        }

        if ($this->user()->findByEmail($email)) {

            Flash::error("Email sudah digunakan.");

            Response::redirect('/register');
        }

        $this->user()->create(
            $name,
            $email,
            $password
        );

        Flash::success("Registrasi berhasil.");

        Response::redirect('/login');
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->user()->findByEmail($email);

        if (!$user) {

            Flash::error("Email tidak ditemukan.");

            Response::redirect('/login');
        }

        if (!password_verify($password, $user['password'])) {

            Flash::error("Password salah.");

            Response::redirect('/login');
        }

        Auth::login($user);

        Response::redirect('/dashboard');
    }

    public function logout()
    {
        Auth::logout();

        Response::redirect('/');
    }
}
