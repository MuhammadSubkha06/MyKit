<?php

namespace Helpers;

class Auth
{
    public static function check(): bool
    {
        return Session::has('user_id');
    }

    public static function id(): ?int
    {
        return Session::get('user_id');
    }

    public static function user(): ?array
    {
        return Session::get('user');
    }

    public static function login(array $user): void
    {
        Session::set('user_id', $user['id']);
        Session::set('user', $user);
    }

    public static function logout(): void
    {
        Session::destroy();
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {

            header("Location: /login");

            exit;

        }
    }
}