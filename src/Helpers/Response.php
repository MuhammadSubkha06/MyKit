<?php

namespace Helpers;

class Response
{
    public static function redirect(string $url): never
    {
        header("Location: {$url}");
        exit;
    }

    public static function json(array $data, int $status = 200): never
    {
        http_response_code($status);

        header('Content-Type: application/json');

        echo json_encode($data);

        exit;
    }
}