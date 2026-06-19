<?php

namespace Controllers;

use Models\Cycle;
use Models\Log;
use Helpers\Auth;
use Helpers\Response;
use Helpers\Flash;

class CycleController
{
    private Cycle $cycle;
    private Log $log;

    public function __construct($db)
    {
        $this->cycle = new Cycle($db);
        $this->log = new Log($db);
    }

    public function dashboard()
    {
        Auth::requireLogin();

        $userId = Auth::id();

        $cycles = $this->cycle->all($userId);

        $latest = $this->cycle->latest($userId);

        $logs = [];

        if ($latest) {

            $logs = $this->log->forCycle($latest['id']);

        }

        require __DIR__ . '/../Views/dashboard.php';
    }

    public function insights()
    {
        Auth::requireLogin();

        $userId = Auth::id();

        $logs = $this->log->forUser($userId);

        require __DIR__ . '/../Views/insights.php';
    }

    public function store()
    {
        Auth::requireLogin();

        $this->cycle->create(

            Auth::id(),

            $_POST['start_date'],

            (int)$_POST['cycle_length'],

            (int)$_POST['period_length']

        );

        Flash::success("Data siklus berhasil disimpan.");

        Response::redirect('/dashboard');
    }

    public function storeLog()
    {
        Auth::requireLogin();

        $symptoms = $_POST['symptoms'] ?? [];

        if (!is_array($symptoms)) {
            $symptoms = [];
        }

        $this->log->create(

            (int)$_POST['cycle_id'],

            $_POST['date'],

            $_POST['mood'],

            $symptoms,

            $_POST['notes'] ?? '',

            (int)($_POST['energy'] ?? 3)

        );

        Flash::success("Log berhasil ditambahkan.");

        Response::redirect('/dashboard');
    }

    public function deleteCycle()
    {
        Auth::requireLogin();

        $this->cycle->delete(
            (int)$_POST['id']
        );

        Flash::success("Siklus berhasil dihapus.");

        Response::redirect('/dashboard');
    }

    public function deleteLog()
    {
        Auth::requireLogin();

        $this->log->delete(
            (int)$_POST['id']
        );

        Flash::success("Log berhasil dihapus.");

        Response::redirect('/dashboard');
    }
}