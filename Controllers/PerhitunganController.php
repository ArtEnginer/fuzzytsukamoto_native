<?php
include_once 'Models/PenilaianModel.php';
include_once 'Models/KriteriaModel.php';
include_once 'Models/SubKriteriaModel.php';
include_once 'Models/AlternatifModel.php';
include_once 'Models/RulesModel.php';

class PerhitunganController
{
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
        $penilaian = $this->penilaianModel->getAll();
        foreach ($penilaian as $nilai) {
            $kriteria = ['kinerja', 'disiplin', 'absen']; // Daftar kriteria yang ada
            $muKriteria = [];

            foreach ($kriteria as $kriteriaName) {
                $muKriteria[$kriteriaName] = $this->hitungKeanggotaan($nilai[$kriteriaName]);
            }

            $fuzzyOutput = $this->aplikasikanRules($muKriteria);
            $crispOutput = $this->defuzzifikasi($fuzzyOutput);

            $kategoriOutput = $this->kategorikanOutput($crispOutput);

            echo "Nilai Akhir Karyawan {$nilai['id_karyawan']} : {$crispOutput} ({$kategoriOutput})\n";
        }
    }

    private function hitungKeanggotaan($nilai)
    {
        $mu = [];
        if ($nilai >= 80) {
            $mu['baik'] = 1;
        } elseif ($nilai >= 70) {
            $mu['baik'] = (80 - $nilai) / 10;
        } else {
            $mu['baik'] = 0;
        }

        if ($nilai > 30 && $nilai < 70) {
            $mu['cukup'] = min(($nilai - 30) / 10, (70 - $nilai) / 10);
        } else {
            $mu['cukup'] = 0;
        }

        if ($nilai <= 30) {
            $mu['kurang'] = 1;
        } elseif ($nilai <= 40) {
            $mu['kurang'] = (40 - $nilai) / 10;
        } else {
            $mu['kurang'] = 0;
        }

        return $mu;
    }

    private function aplikasikanRules($muKriteria)
    {
        $rules = $this->ruleModel->getAll();
        $fuzzyOutput = [];

        foreach ($rules as $rule) {
            $muMin = min(
                $muKriteria['kinerja'][$rule['kinerja']],
                $muKriteria['disiplin'][$rule['disiplin']],
                $muKriteria['absen'][$rule['absen']]
            );

            if (!isset($fuzzyOutput[$rule['output']])) {
                $fuzzyOutput[$rule['output']] = [];
            }
            $fuzzyOutput[$rule['output']][] = $muMin;
        }

        return $fuzzyOutput;
    }

    private function defuzzifikasi($fuzzyOutput)
    {
        $numerator = 0;
        $denominator = 0;

        foreach ($fuzzyOutput as $output => $values) {
            $value = $this->getCrispValue($output);
            foreach ($values as $mu) {
                $numerator += $mu * $value;
                $denominator += $mu;
            }
        }

        return ($denominator == 0) ? 0 : $numerator / $denominator;
    }

    private function getCrispValue($output)
    {
        switch ($output) {
            case 'baik':
                return 80;
            case 'cukup':
                return 55;
            case 'kurang':
                return 30;
            default:
                return 0;
        }
    }

    private function kategorikanOutput($crispOutput)
    {
        if ($crispOutput >= 0 && $crispOutput < 50) {
            return 'Sangat Kurang';
        } elseif ($crispOutput >= 50 && $crispOutput < 70) {
            return 'Kurang';
        } elseif ($crispOutput >= 70 && $crispOutput < 90) {
            return 'Baik';
        } elseif ($crispOutput >= 90 && $crispOutput <= 100) {
            return 'Sangat Baik';
        } else {
            return 'Tidak Terdefinisi';
        }
    }
}
