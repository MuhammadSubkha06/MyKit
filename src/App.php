<?php

/**
 * Simple front-controller / router used by public/index.php.
 *
 * Usage:
 *   $app = new App($db);
 *   $app->get('/path', 'SomeController@method');
 *   $app->post('/path', 'SomeController@method');
 *   $routes = $app->routes();
 *   $app->call($routes[$method][$path], $db);
 */
class App
{
    /** @var array<string, array<string, string>> */
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /** @var mixed Shared DB connection, opened lazily when a controller/model needs it. */
    public $db;

    public function __construct($db = null)
    {
        $this->db = $db;
    }

    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * Resolve "Controller@method" into a class instance call.
     *
     * @param string $handler e.g. "HomeController@index"
     * @param mixed  $db
     */
    public function call(string $handler, $db)
    {
        [$controllerName, $method] = explode('@', $handler);

        $controllerClass = 'Controllers\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo "<h1>500</h1><p>Controller {$controllerClass} not found.</p>";
            return;
        }

        $controller = new $controllerClass($db);

        if (!method_exists($controller, $method)) {
            http_response_code(500);
            echo "<h1>500</h1><p>Method {$method} not found on {$controllerClass}.</p>";
            return;
        }

        return $controller->$method();
    }

    public function db(): \Models\Database
    {
        if (!$this->db instanceof \Models\Database) {
            $this->db = \Models\Database::instance();
        }

        return $this->db;
    }
}
