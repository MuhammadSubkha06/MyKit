<?php

// Saat dijalankan lewat PHP built-in server (php -S ... public/index.php),
// file statis yang benar-benar ada (css, js, gambar, dll) harus dilayani langsung
// oleh server, bukan diproses oleh router kita. Tanpa ini, semua request ke
// /assets/* akan kena 404 karena tidak cocok dengan rute manapun.
if (php_sapi_name() === 'cli-server') {
    $requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $filePath = __DIR__ . $requestedPath;
    if ($requestedPath !== '/' && is_file($filePath)) {
        return false;
    }
}

require __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

session_start();

$config = require __DIR__.'/../config/app.php';

date_default_timezone_set($config['timezone']);

$db = \Models\Database::instance();

require __DIR__.'/../src/App.php';

$app = new App($db);

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

$app->get('/', 'HomeController@index');

$app->get('/login','AuthController@loginForm');

$app->post('/login','AuthController@login');

$app->get('/register','AuthController@registerForm');

$app->post('/register','AuthController@register');

/*
|--------------------------------------------------------------------------
| Private
|--------------------------------------------------------------------------
*/

$app->get('/dashboard','CycleController@dashboard');

$app->get('/insights','CycleController@insights');

$app->post('/cycle','CycleController@store');

$app->post('/cycle/create','CycleController@store');

$app->post('/log','CycleController@storeLog');

$app->get('/logout','AuthController@logout');

/*
|--------------------------------------------------------------------------
| Dispatch
|--------------------------------------------------------------------------
*/

$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

$method = $_SERVER['REQUEST_METHOD'];

$routes = $app->routes();

if(isset($routes[$method][$path])){

    $app->call($routes[$method][$path],$db);

}else{

    http_response_code(404);

    echo "<h1>404</h1>";

}