<?php

function mykit_env(string $key, $default = null)
{
    $value = $_ENV[$key] ?? getenv($key);

    return ($value === false || $value === null || $value === '') ? $default : $value;
}

return [

    'host' => mykit_env('DB_HOST'),

    'port' => mykit_env('DB_PORT', 5432),

    'database' => mykit_env('DB_DATABASE'),

    'username' => mykit_env('DB_USERNAME'),

    'password' => mykit_env('DB_PASSWORD')

];
