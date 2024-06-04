<?php
include_once 'Models\SubKriteriaModel.php';

class SubKriteriaController
{
    private $SubKriteriaModel;

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
        $this->SubKriteriaModel = new SubKriteriaModel($koneksi);
        $this->active = 'kriteria';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar SubKriteria',
            'active' => $this->active,
            'items' => $this->SubKriteriaModel->show_with_k($_GET['idk']),
            'content' => 'Views/SubKriteria/index.php',
            'idk' => $_GET['idk'],
        ];

        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Daftar Kriteria',
            'active' => $this->active,
            'idk' => $_GET['idk'],
            'content' => 'Views/SubKriteria/tambah.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function simpan()
    {
        $data = [
            'kriteria_id'  => $_POST['kriteria_id'],
            'nama'  => $_POST['nama'],
        ];
        $this->SubKriteriaModel->add($data);
        header('location: ' . base_url() . 'subkriteria/index?idk=' . $data['kriteria_id']);
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->SubKriteriaModel->delete($id);

        // redirect back
        header('location: ' . base_url() . 'subkriteria/index?idk=' . $_GET['idk']);
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = [
            'title' => 'Edit Daftar SubKriteria',
            'active' => $this->active,
            'item' => $this->SubKriteriaModel->find($id),
            'content' => 'Views/SubKriteria/edit.php',
        ];
        include_once('Views/Layout/index.php');
    }

    public function update()
    {
        $data = [
            'id'    => $_POST['id'],
            'kriteria_id'  => $_POST['kriteria_id'],
            'nama'  => $_POST['nama'],
        ];
        $this->SubKriteriaModel->update($data);
        header('location: ' . base_url() . 'subkriteria/index?idk=' . $data['kriteria_id']);
    }
}
