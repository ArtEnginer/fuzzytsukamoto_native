<?php
include_once 'Models/UserModel.php';

class UserController
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
        $this->userModel = new UserModel($koneksi);
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar User',
            'active' => 'users',
            'items' => $this->userModel->all(), // Use $this->DatasetModel
            'content' => 'Views/Auth/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah User',
            'active' => 'users',
            'content' => 'Views/Auth/tambah.php',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->add($_POST);
            header('Location: ' . base_url() . 'user/index');
            exit();
        }

        include_once('Views/Layout/index.php');
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit User',
            'active' => 'users',
            'item' => $this->userModel->find($_GET['id']),
            'content' => 'Views/Auth/edit.php',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->update($_POST);
            header('Location: ' . base_url() . 'user/index');
            exit();
        }

        include_once('Views/Layout/index.php');
    }

    public function delete()
    {
        $this->userModel->delete($_GET['id']);
        header('Location: ' . base_url() . 'user/index');
        exit();
    }
}
