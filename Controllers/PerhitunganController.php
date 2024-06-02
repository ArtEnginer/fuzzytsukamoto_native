<?php
include_once 'Models\PenilaianModel.php';
include_once 'Models\KriteriaModel.php';
include_once 'Models\SubKriteriaModel.php';
include_once 'Models\AlternatifModel.php';
class PerhitunganController
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
        $this->penilaianModel = new PenilaianModel($koneksi);
        $this->kriteriaModel = new KriteriaModel($koneksi);
        $this->subKriteriaModel = new SubKriteriaModel($koneksi);
        $this->alternatifModel = new AlternatifModel($koneksi);
    }

    public function index()
    {
        // Retrieve all necessary data
        $this->data['kriteria']    = $this->kriteriaModel->all();
        $subkriteria = $this->subKriteriaModel->all();
        $this->data['subkriteria'] = $this->subKriteriaModel->keyBy($subkriteria, 'id');
        $this->data['alternatif']  = $this->alternatifModel->all();
        $this->data['penilaian']   = $this->penilaianModel->all();

        $matriks_keputusan = [];
        foreach ($this->data['penilaian'] as $penilaian) {
            // Parse the JSON string to get sub-kriteria values
            $sub_kriteria_values = json_decode($penilaian['sub_kriteria_id'], true);

            if (is_array($sub_kriteria_values)) {
                foreach ($sub_kriteria_values as $kriteria_id => $sub_kriteria_id) {
                    // Initialize the decision matrix if not already
                    if (!isset($matriks_keputusan[$penilaian['alternatif_id']])) {
                        $matriks_keputusan[$penilaian['alternatif_id']] = [];
                    }
                    // Store the sub-kriteria value in the decision matrix
                    $matriks_keputusan[$penilaian['alternatif_id']][$kriteria_id] = $sub_kriteria_id;
                }
            }
        }

        // bobot kriteria W
        $bobot_kriteria = [];
        foreach ($this->data['kriteria'] as $kriteria) {
            $bobot_kriteria[$kriteria['id']] = $kriteria['bobot'];
        }

        // Normalisasi matriks keputusan
        $normalisasi_matriks = [];
        foreach ($matriks_keputusan as $alternatif_id => $nilai_kriteria) {
            foreach ($nilai_kriteria as $kriteria_id => $nilai) {
                if (!isset($normalisasi_matriks[$alternatif_id])) {
                    $normalisasi_matriks[$alternatif_id] = [];
                }
                $sum_of_squares = 0;
                foreach ($matriks_keputusan as $nilai_kriteria_lain) {
                    $sum_of_squares += pow($nilai_kriteria_lain[$kriteria_id], 2);
                }
                $normalisasi_matriks[$alternatif_id][$kriteria_id] = $nilai / sqrt($sum_of_squares);
            }
        }

        // Matriks normalisasi terbobot
        $terbobot_matriks = [];
        foreach ($normalisasi_matriks as $alternatif_id => $nilai_kriteria) {
            foreach ($nilai_kriteria as $kriteria_id => $nilai) {
                if (!isset($terbobot_matriks[$alternatif_id])) {
                    $terbobot_matriks[$alternatif_id] = [];
                }
                $terbobot_matriks[$alternatif_id][$kriteria_id] = $nilai * $bobot_kriteria[$kriteria_id];
            }
        }

        // Menghitung skor MOORA untuk setiap alternatif
        $skor_moora = [];
        foreach ($terbobot_matriks as $alternatif_id => $nilai_kriteria) {
            $benefit_sum = 0;
            $cost_sum = 0;
            foreach ($nilai_kriteria as $kriteria_id => $nilai) {
                // Check if the key exists and is not null
                if (isset($this->data['kriteria'][$kriteria_id]) && isset($this->data['kriteria'][$kriteria_id]['attribut'])) {
                    $tipe = $this->data['kriteria'][$kriteria_id]['attribut']; // Assuming 'tipe' is 'benefit' or 'cost'
                    if ($tipe == 'benefit') {
                        $benefit_sum += $nilai;
                    } elseif ($tipe == 'cost') {
                        $cost_sum += $nilai;
                    }
                } else {
                    // Handle the case where the key does not exist or is null
                    // For example, you might want to log an error or set a default value
                    // error_log("Kriteria ID $kriteria_id is undefined in data['kriteria'] or missing 'attribut'");
                }
            }
            $skor_moora[$alternatif_id] = $benefit_sum - $cost_sum;
        }
        // Mengurutkan alternatif berdasarkan skor MOORA
        arsort($skor_moora);

        if (isset($_GET['hasil'])) {
            $data = [
                'alternatif' => $this->data['alternatif'],
                'kriteria' => $this->data['kriteria'],
                'penilaian' => $this->data['penilaian'],
                'subkriteria' => $this->data['subkriteria'],
                'matriks_keputusan' => $matriks_keputusan,
                'bobot_kriteria' => $bobot_kriteria,
                'normalisasi_matriks' => $normalisasi_matriks,
                'terbobot_matriks' => $terbobot_matriks,
                'skor_moora' => $skor_moora,
                'content' => 'Views/Perhitungan/hasil.php',
            ];
        } else {
            $data = [
                'alternatif' => $this->data['alternatif'],
                'kriteria' => $this->data['kriteria'],
                'penilaian' => $this->data['penilaian'],
                'subkriteria' => $this->data['subkriteria'],
                'matriks_keputusan' => $matriks_keputusan,
                'bobot_kriteria' => $bobot_kriteria,
                'normalisasi_matriks' => $normalisasi_matriks,
                'terbobot_matriks' => $terbobot_matriks,
                'skor_moora' => $skor_moora,
                'content' => 'Views/Perhitungan/index.php',
            ];
        }
        include_once('Views/Layout/index.php');
    }
}
