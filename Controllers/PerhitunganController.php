<?php
include_once 'Models\PenilaianModel.php';
include_once 'Models\KriteriaModel.php';
include_once 'Models\RulesModel.php';
include_once 'Models\AlternatifModel.php';

class PerhitunganController
{

    private $PenilaianModel;

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
        $this->RulesModel = new RulesModel($koneksi);
        $this->alternatifModel = new AlternatifModel($koneksi);
        $this->active = 'kriteria';
    }

    public function index()
    {
        $id = $_GET['id'];
        $dataNilai = $this->PenilaianModel->show($id);

        $rules = [
            ['K1' => 'Baik', 'K2' => 'Baik', 'K3' => 'Baik', 'Output' => 'Baik'],
            ['K1' => 'Baik', 'K2' => 'Baik', 'K3' => 'Cukup', 'Output' => 'Baik'],
            ['K1' => 'Baik', 'K2' => 'Baik', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Cukup', 'K3' => 'Baik', 'Output' => 'Baik'],
            ['K1' => 'Baik', 'K2' => 'Cukup', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Cukup', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Kurang', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Kurang', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Kurang', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Cukup', 'K2' => 'Baik', 'K3' => 'Baik', 'Output' => 'Baik'],
            ['K1' => 'Cukup', 'K2' => 'Baik', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Baik', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Cukup', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Cukup', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Cukup', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Kurang', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Kurang', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Kurang', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Baik', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Baik', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Baik', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Cukup', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Cukup', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Cukup', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Kurang', 'K3' => 'Baik', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Kurang', 'K3' => 'Cukup', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Kurang', 'K3' => 'Kurang', 'Output' => 'Kurang'],
        ];


        $nilai = json_decode($dataNilai['nilai'], true);


        $kriteria = [
            'K1' => $nilai['1'],
            'K2' => $nilai['2'],
            'K3' => $nilai['3'],
            'Output' => "",
        ];

        $rules_fuzzy = [];
        foreach ($rules as $rule) {
            $rule_fuzzy = [];
            foreach ($rule as $key => $value) {
                $rule_fuzzy[$key] = $value == 'Baik' ? $this->muBaik($kriteria[$key]) : ($value == 'Cukup' ? $this->muCukup($kriteria[$key]) : $this->muKurang($kriteria[$key]));
            }
            $rule_fuzzy['Output'] = $rule['Output'];
            $rules_fuzzy[] = $rule_fuzzy;
        }

        // nilai terendah dari masing masing baris rules_fuzzy
        $nilai_terendah = [];
        foreach ($rules_fuzzy as $rule) {
            $nilai_terendah[] = min($rule['K1'], $rule['K2'], $rule['K3']);
        }

        // tambahkan nilai terendah ke dalam array rules_fuzzy
        foreach ($rules_fuzzy as $key => $rule) {
            $rules_fuzzy[$key]['nilai_terendah'] = $nilai_terendah[$key];
        }

        $nilai_z = [];
        foreach ($rules_fuzzy as $key => $rule) {
            $alpha = $rule['nilai_terendah'];
            if ($rule['Output'] == 'Baik') {
                $z = $this->zBaik($alpha);
            } elseif ($rule['Output'] == 'Cukup') {
                $z = $this->zCukup($alpha);
            } else { // Kurang
                $z = $this->zKurang($alpha);
            }
            $rules_fuzzy[$key]['z'] = $z;
            $rules_fuzzy[$key]['alpha_z'] = $alpha * $z;
        }

        // nilai z kali alpha
        $alpha_z = array_column($rules_fuzzy, 'alpha_z');
        $sum_alpha_z = array_sum($alpha_z);
        $sum_alpha = array_sum($nilai_terendah);
        $z = $sum_alpha_z / $sum_alpha;

        if ($z <= 60) {
            $kategori = 'Kurang';
        } elseif ($z > 60 && $z < 80) {
            $kategori = 'Cukup';
        } else {
            $kategori = 'Baik';
        }

        $data = [
            'title' => 'Perhitungan',
            'active' => $this->active,
            'alternatif' => $this->alternatifModel,
            'penilaian' => $dataNilai,
            'hasil' => $rules_fuzzy,
            'z' => $z,
            'kategori' => $kategori,
            'content' => 'Views/Perhitungan/index.php',
        ];

        include_once('Views/Layout/index.php');
    }

    public function hasil()
    {
        $dataNilai = $this->PenilaianModel->all();
        if (isset($_POST['periode'])) {
            $dataNilai = $this->PenilaianModel->getByPeriode($_POST['periode']);
        }
        $alternatif = $this->alternatifModel->all();

        $rules = [
            ['K1' => 'Baik', 'K2' => 'Baik', 'K3' => 'Baik', 'Output' => 'Baik'],
            ['K1' => 'Baik', 'K2' => 'Baik', 'K3' => 'Cukup', 'Output' => 'Baik'],
            ['K1' => 'Baik', 'K2' => 'Baik', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Cukup', 'K3' => 'Baik', 'Output' => 'Baik'],
            ['K1' => 'Baik', 'K2' => 'Cukup', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Cukup', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Kurang', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Kurang', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Baik', 'K2' => 'Kurang', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Cukup', 'K2' => 'Baik', 'K3' => 'Baik', 'Output' => 'Baik'],
            ['K1' => 'Cukup', 'K2' => 'Baik', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Baik', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Cukup', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Cukup', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Cukup', 'K3' => 'Kurang', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Kurang', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Kurang', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Cukup', 'K2' => 'Kurang', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Baik', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Baik', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Baik', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Cukup', 'K3' => 'Baik', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Cukup', 'K3' => 'Cukup', 'Output' => 'Cukup'],
            ['K1' => 'Kurang', 'K2' => 'Cukup', 'K3' => 'Kurang', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Kurang', 'K3' => 'Baik', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Kurang', 'K3' => 'Cukup', 'Output' => 'Kurang'],
            ['K1' => 'Kurang', 'K2' => 'Kurang', 'K3' => 'Kurang', 'Output' => 'Kurang'],
        ];

        $hasil = [];
        foreach ($dataNilai as $data) {
            $nilai = json_decode($data['nilai'], true);
            $kriteria = [
                'K1' => $nilai['1'],
                'K2' => $nilai['2'],
                'K3' => $nilai['3'],
                'Output' => "",
            ];

            $rules_fuzzy = [];
            foreach ($rules as $rule) {
                $rule_fuzzy = [];
                foreach ($rule as $key => $value) {
                    $rule_fuzzy[$key] = $value == 'Baik' ? $this->muBaik($kriteria[$key]) : ($value == 'Cukup' ? $this->muCukup($kriteria[$key]) : $this->muKurang($kriteria[$key]));
                }
                $rule_fuzzy['Output'] = $rule['Output'];
                $rules_fuzzy[] = $rule_fuzzy;
            }

            // nilai terendah dari masing masing baris rules_fuzzy
            $nilai_terendah = [];
            foreach ($rules_fuzzy as $rule) {
                $nilai_terendah[] = min($rule['K1'], $rule['K2'], $rule['K3']);
            }

            // tambahkan nilai terendah ke dalam array rules_fuzzy
            foreach ($rules_fuzzy as $key => $rule) {
                $rules_fuzzy[$key]['nilai_terendah'] = $nilai_terendah[$key];
            }

            $nilai_z = [];
            foreach ($rules_fuzzy as $key => $rule) {
                $alpha = $rule['nilai_terendah'];
                if ($rule['Output'] == 'Baik') {
                    $z = $this->zBaik($alpha);
                } elseif ($rule['Output'] == 'Cukup') {
                    $z = $this->zCukup($alpha);
                } else { // Kurang
                    $z = $this->zKurang($alpha);
                }
                $rules_fuzzy[$key]['z'] = $z;
                $rules_fuzzy[$key]['alpha_z'] = $alpha * $z;
            }

            // nilai z kali alpha
            $alpha_z = array_column($rules_fuzzy, 'alpha_z');
            $sum_alpha_z = array_sum($alpha_z);
            $sum_alpha = array_sum($nilai_terendah);
            $z = $sum_alpha_z / $sum_alpha;

            if ($z <= 60) {
                $kategori = 'Kurang';
            } elseif ($z > 60 && $z < 80) {
                $kategori = 'Cukup';
            } else {
                $kategori = 'Baik';
            }
            $alternatif = $this->alternatifModel->show($data['alternatif_id']);
            $hasil[] = [
                'id' => $data['id'],
                'nama' => $alternatif['nama'],
                'nilai' => $data['nilai'],
                'z' => $z,
                'kategori' => $kategori,
            ];
        }

        $data = [
            'title' => 'Hasil',
            'active' => $this->active,
            'penilaian' => $hasil,
            'content' => 'Views/Perhitungan/hasil.php',
        ];

        include_once('Views/Layout/index.php');
    }


    public function muKurang($x)
    {
        if ($x <= 30) {
            return 1;
        } elseif ($x > 30 && $x < 40) {
            return (40 - $x) / (40 - 30);
        } else {
            return 0;
        }
    }

    public function muCukup($x)
    {
        if ($x >= 40 && $x <= 70) {
            return 1;
        } elseif ($x > 30 && $x < 40) {
            return ($x - 30) / (40 - 30);
        } elseif ($x > 70 && $x < 80) {
            return (80 - $x) / (80 - 70);
        } else {
            return 0;
        }
    }

    public function muBaik($x)
    {
        if ($x >= 80) {
            return 1;
        } elseif ($x > 70 && $x < 80) {
            return ($x - 70) / (80 - 70);
        } else {
            return 0;
        }
    }

    public function zKurang($alpha)
    {
        if ($alpha >= 1) {
            return 40;
        } elseif ($alpha > 0 && $alpha < 1) {
            return 50 - $alpha * 10;
        } elseif ($alpha == 0) {
            return 50;
        } else {
            return false;
        }
    }

    public function zCukup($alpha)
    {
        if ($alpha >= 1) {
            return 70;
        } elseif ($alpha > 0 && $alpha < 1) {
            if ($alpha <= 0.5) {
                return $alpha * 10 + 50;
            } else {
                return 80 - $alpha * 10;
            }
        } elseif ($alpha == 0) {
            return 80;
        } else {
            return false;
        }
    }

    public function zBaik($alpha)
    {
        if ($alpha >= 1) {
            return 80;
        } elseif ($alpha > 0 && $alpha < 1) {
            return $alpha * 10 + 80;
        } elseif ($alpha == 0) {
            return 80;
        } else {
            return false;
        }
    }
}
