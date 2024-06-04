<?php
include_once 'Models\KriteriaModel.php';

class KriteriaController
{
    private $KriteriaModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url() . 'auth/login');
            exit();
        }
        $koneksi = new Koneksi();
        $this->KriteriaModel = new KriteriaModel($koneksi);
        $this->active = 'kriteria';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Kriteria',
            'active' => $this->active,
            'items' => $this->KriteriaModel->all(), // Use $this->KriteriaModel
            'content' => 'Views/Kriteria/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Daftar Kriteria',
            'active' => $this->active,
            'content' => 'Views/Kriteria/tambah.php',

        ];

        include_once('Views/Layout/index.php');
    }

    public function simpan()
    {
        $data = [
            'nama'  => $_POST['nama'],
        ];
        $this->KriteriaModel->add($data);
        header('location: ' . base_url() . 'kriteria/index');
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->KriteriaModel->delete($id);

        header('location: ' . base_url() . 'kriteria/index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = [
            'title' => 'Edit Daftar Kriteria',
            'active' => $this->active,
            'item' => $this->KriteriaModel->show($id),
            'content' => 'Views/Kriteria/edit.php',
        ];
        include_once('Views/Layout/index.php');
    }

    public function update()
    {
        $data = [
            'id'    => $_POST['id'],
            'nama'  => $_POST['nama'],
        ];
        $this->KriteriaModel->update($data);
        header('location: ' . base_url() . 'kriteria/index');
    }
}
