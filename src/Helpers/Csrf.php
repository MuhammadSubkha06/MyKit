<?php
namespace Helpers;

class Csrf
{
    public static function token()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (empty($_SESSION['_csrf'])) {
            try {
                $_SESSION['_csrf'] = bin2hex(random_bytes(16));
            } catch (\Exception $e) {
                $_SESSION['_csrf'] = md5(uniqid('', true));
            }
        }
        return $_SESSION['_csrf'];
    }

    public static function verify($token)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (empty($token) || empty($_SESSION['_csrf'])) return false;
        return hash_equals($_SESSION['_csrf'], (string)$token);
    }
}
