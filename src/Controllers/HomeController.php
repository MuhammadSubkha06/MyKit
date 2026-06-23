<?php

namespace Controllers;

class HomeController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        require __DIR__ . '/../Views/home.php';
    }

    public function about()
    {
        require __DIR__ . '/../Views/Home/about.php';
    }

    public function privacy()
    {
        require __DIR__ . '/../Views/Home/privacy.php';
    }

    public function terms()
    {
        require __DIR__ . '/../Views/Home/terms.php';
    }
}