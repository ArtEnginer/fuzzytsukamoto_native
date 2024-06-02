<?php
include_once 'Models\PenilaianModel.php';
include_once 'Models\KriteriaModel.php';
include_once 'Models\SubKriteriaModel.php';
include_once 'Models\AlternatifModel.php';

class PenilaianController
{

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
        $this->PenilaianModel = new PenilaianModel($koneksi);
        $this->KriteriaModel = new KriteriaModel($koneksi);
        $this->SubKriteriaModel = new SubKriteriaModel($koneksi);
        $this->AlternatifModel = new AlternatifModel($koneksi);
        $this->active = 'penilaian';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Penilaian',
            'active' => $this->active,
            'kriteria' => $this->KriteriaModel->all(),
            'alternatif' => $this->AlternatifModel->all(),
            'penilaian' => $this->PenilaianModel->all(),
            'content' => 'Views/Penilaian/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title'        => 'Tambah Daftar Penilaian',
            'active'       => $this->active,
            'alternatif'   => $this->AlternatifModel->all(),
            'kriteria'     => $this->KriteriaModel->all(),
            'sub_kriteria' => $this->SubKriteriaModel->all(),
            'penilaian'    => $this->PenilaianModel->all(), // tambahkan ini agar tidak error 'undefined index: penilaian
            'content'      => 'Views/Penilaian/tambah.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function simpan()
    {
        $data = [
            'alternatif_id' => $_POST['alternatif_id'],
            'sub_kriteria_id' => json_encode($_POST['sub_kriteria_id']),
        ];

        $this->PenilaianModel->add($data);

        header('location: ' . base_url() . 'Penilaian/index');
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->PenilaianModel->delete($id);

        header('location: ' . base_url() . 'Penilaian/index');
    }

    public function edit()
    {
        $id = $_GET['id'];
        $data = [
            'title'       => 'Edit Daftar Penilaian',
            'active'      => $this->active,
            'existing_values'        => $this->PenilaianModel->show($id),
            'kriteria'    => $this->KriteriaModel->all(),
            'alternatif'  => $this->AlternatifModel->all(),
            'subkriteria' => $this->SubKriteriaModel->all(),
            'content'     => 'Views/Penilaian/edit.php',
        ];
        include_once('Views/Layout/index.php');
    }

    public function update()
    {
        $data = [
            'id' => $_GET['id'], // tambahkan ini agar tidak error 'undefined index: id
            'alternatif_id' => $_POST['alternatif_id'],
            'sub_kriteria_id' => json_encode($_POST['sub_kriteria_id']),
        ];

        $this->PenilaianModel->update($data);

        header('location: ' . base_url() . 'Penilaian/index');
    }
}
