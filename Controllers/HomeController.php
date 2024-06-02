<?php

class HomeController
{
    public function __construct()
    {
        // if (session_status() == PHP_SESSION_NONE) {
        //     session_start();
        // }
        // if (!isset($_SESSION['user'])) {
        //     header('Location: ' . base_url() . 'auth/login');
        //     exit();
        // }

        $this->active = 'home';
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'active' => $this->active,
            'content' => 'Views/home/index.php'
        ];
        include_once('Views/Layout/index.php');
    }
}
