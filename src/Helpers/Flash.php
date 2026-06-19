<?php

namespace Helpers;

class Flash
{
    public static function success(string $message): void
    {
        Session::set('success', $message);
    }

    public static function error(string $message): void
    {
        Session::set('error', $message);
    }

    public static function getSuccess(): ?string
    {
        $msg = Session::get('success');

        Session::remove('success');

        return $msg;
    }

    public static function getError(): ?string
    {
        $msg = Session::get('error');

        Session::remove('error');

        return $msg;
    }
}