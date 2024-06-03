<?php
include_once 'Models/PenilaianModel.php';
include_once 'Models/KriteriaModel.php';
include_once 'Models/SubKriteriaModel.php';
include_once 'Models/AlternatifModel.php';
include_once 'Models/RulesModel.php';

class PerhitunganController
{
    private $penilaianModel;
    private $kriteriaModel;
    private $subKriteriaModel;
    private $alternatifModel;
    private $ruleModel;

    public function __construct()
    {
        $koneksi = new Koneksi();
        $this->penilaianModel = new PenilaianModel($koneksi);
        $this->kriteriaModel = new KriteriaModel($koneksi);
        $this->subKriteriaModel = new SubKriteriaModel($koneksi);
        $this->alternatifModel = new AlternatifModel($koneksi);
        $this->ruleModel = new RulesModel($koneksi);
    }

    public function index()
    {
        $penilaians = $this->penilaianModel->all();
        foreach ($penilaians as $penilaian) {
            $this->calculate($penilaian);
        }
    }

    private function calculate($penilaian)
    {
        $nilai = json_decode($penilaian['nilai'], true);

        // Convert all string values to integers
        foreach ($nilai as $key => $value) {
            $nilai[$key] = (int)$value;
        }

        // Defuzzification using Tsukamoto method
        $results = [];
        $total_alpha = 0;

        foreach ($this->ruleModel->all() as $rule) {
            $rule_input = json_decode($rule['rule'], true);
            $alpha_predicate = [];

            foreach ($rule_input as $key => $value) {
                $alpha = $this->fuzzification($nilai[$key], $key, $value);
                $alpha_predicate[] = $alpha;
                // Debugging: output the fuzzification values
                echo "Fuzzification for Kriteria $key with Sub-Kriteria $value is $alpha\n";
            }

            $alpha = min($alpha_predicate);
            $output_value = $this->convertOutput($rule['output']);
            $results[] = $alpha * $output_value;
            $total_alpha += $alpha;

            // Debugging: output the intermediate results
            echo "Rule: " . json_encode($rule_input) . " - Alpha: $alpha - Output Value: $output_value\n";
        }

        $final_value = array_sum($results) / ($total_alpha ?: 1); // Avoid division by zero

        echo "Penilaian Karyawan ID {$penilaian['alternatif_id']} adalah {$final_value}\n";
    }

    private function fuzzification($nilai, $kriteria_id, $sub_kriteria_id)
    {
        switch ($sub_kriteria_id) {
            case 1: // Baik
                return $this->hitungBaik($nilai);
            case 2: // Cukup
                return $this->hitungCukup($nilai);
            case 3: // Kurang
                return $this->hitungKurang($nilai);
            default:
                return 0;
        }
    }

    private function hitungBaik($nilai)
    {
        if ($nilai <= 70) {
            return 0;
        } elseif ($nilai <= 80) {
            return ($nilai - 70) / 10;
        } else {
            return 1;
        }
    }

    private function hitungCukup($nilai)
    {
        if ($nilai <= 30) {
            return 0;
        } elseif ($nilai <= 40) {
            return ($nilai - 30) / 10;
        } elseif ($nilai <= 70) {
            return 1;
        } elseif ($nilai <= 80) {
            return (80 - $nilai) / 10;
        } else {
            return 0;
        }
    }

    private function hitungKurang($nilai)
    {
        if ($nilai <= 30) {
            return 1;
        } elseif ($nilai <= 40) {
            return (40 - $nilai) / 10;
        } else {
            return 0;
        }
    }

    private function convertOutput($output)
    {
        switch ($output) {
            case 'baik':
                return 80; // Nilai yang Anda inginkan untuk "baik"
            case 'cukup':
                return 60; // Nilai yang Anda inginkan untuk "cukup"
            case 'kurang':
                return 40; // Nilai yang Anda inginkan untuk "kurang"
            default:
                return 0;
        }
    }
}

// Instansiasi objek dan panggil metode index untuk menjalankan perhitungan
$controller = new PerhitunganController();
$controller->index();
