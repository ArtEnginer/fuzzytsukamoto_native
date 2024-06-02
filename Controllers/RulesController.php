<?php
include_once 'Models\RulesModel.php';
include_once 'Models\KriteriaModel.php';
include_once 'Models\SubKriteriaModel.php';

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
        $this->KriteriaModel = new KriteriaModel($koneksi);
        $this->SubKriteriaModel = new SubKriteriaModel($koneksi);
        $this->active = 'Rules';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Rules',
            'active' => $this->active,
            'items' => $this->RulesModel->all(),
            'content' => 'Views/Rules/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Rules',
            'active' => $this->active,
            'kriteria' => $this->KriteriaModel->all(),
            'subkriteria' => $this->SubKriteriaModel,
            'content' => 'Views/Rules/create.php',
        ];

        include_once('Views/Layout/index.php');
    }
}
