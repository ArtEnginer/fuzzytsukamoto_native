<?php
include_once 'Models/UserModel.php';

class AuthController
{
    public function __construct()
    {
        $koneksi = new Koneksi();
        $this->userModel = new UserModel($koneksi);
    }

    public function login()
    {

        $data = [
            'title' => 'Login',
        ];

        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->getByUsername($username);

            if ($user !== false && is_array($user)) {  // Ensure $user is valid
                //    cek biasa password tidak di hash
                if ($password == $user['password']) {
                    session_start();
                    $_SESSION['user'] = $user;
                    header('Location: ' . base_url() . 'home/index');
                    exit();
                } else {
                    $data['error'] = 'Password salah';
                }
            } else {
                $data['error'] = 'Username tidak ditemukan';
            }
        }

        include_once('Views/Auth/login.php');
    }


    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . base_url() . 'auth/login');
        exit();
    }
}
