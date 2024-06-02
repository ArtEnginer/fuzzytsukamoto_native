<?php
include_once 'Models\AlternatifModel.php';

class AlternatifController
{
    private $datasetModel;

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
        $this->alternatifModel = new AlternatifModel($koneksi);
        $this->active = 'alternatif';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Alternatif',
            'active' => $this->active,
            'items' => $this->alternatifModel->all(), // Use $this->DatasetModel
            'content' => 'Views/Alternatif/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Daftar Alternatif',
            'active' => $this->active,
            'content' => 'Views/Alternatif/tambah.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function simpan()
    {
        $data = [
            'nama'          => $_POST['nama'],
            'kelas'           => $_POST['kelas'],
            'jenis_kelamin'  => $_POST['jenis_kelamin'],
        ];


        $this->alternatifModel->add($data);

        header('location: ' . base_url() . 'alternatif/index');
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->alternatifModel->delete($id);

        header('location: ' . base_url() . 'alternatif/index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = [
            'title' => 'Edit Daftar Alternatif',
            'active' => $this->active,
            'item' => $this->alternatifModel->show($id),
            'content' => 'Views/Alternatif/edit.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function update()
    {
        $data = [
            'id'            => $_POST['id'],
            'nama'          => $_POST['nama'],
            'kelas'           => $_POST['kelas'],
            'jenis_kelamin'  => $_POST['jenis_kelamin'],
        ];

        $this->alternatifModel->update($data);

        header('location: ' . base_url() . 'alternatif/index');
    }
}
