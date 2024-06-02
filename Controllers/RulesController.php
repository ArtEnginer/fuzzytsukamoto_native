<?php
include_once 'Models\RulesModel.php';

class RulesController
{
    private $RulesModel;

    public function __construct()
    {
        // if (session_status() == PHP_SESSION_NONE) {
        //     session_start();
        // }
        // if (!isset($_SESSION['user'])) {
        //     header('Location: ' . base_url() . 'auth/login');
        //     exit();
        // }
        $koneksi = new Koneksi();
        $this->RulesModel = new RulesModel($koneksi);
        $this->active = 'Rules';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Rules',
            'active' => $this->active,
            'items' => $this->RulesModel->all(), // Use $this->RulesModel
            'content' => 'Views/Rules/index.php',
        ];

        include_once('Views/Layout/index.php');
    }
}
