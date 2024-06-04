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
        $this->active = 'perhitungan';
    }

    public function index()
    {
        $alternatifs = $this->alternatifModel->all();
        $penilaians = $this->penilaianModel->all();
        $rules = $this->ruleModel->all();
        $kriterias = $this->kriteriaModel->all();
        $subKriterias = $this->subKriteriaModel->all();

        $results = [];

        foreach ($penilaians as $penilaian) {
            $nilai = json_decode($penilaian['nilai'], true);
            $fuzzyValues = [];

            foreach ($kriterias as $kriteria) {
                $subKriteria = array_filter($subKriterias, function ($sk) use ($kriteria) {
                    return $sk['kriteria_id'] == $kriteria['id'];
                });

                foreach ($subKriteria as $sk) {
                    $fuzzyValues[$kriteria['id']][$sk['id']] = $this->fuzzify($nilai[$kriteria['id']], $sk);
                }
            }

            $inferenceResults = $this->infer($fuzzyValues, $rules);
            $defuzzifiedValue = $this->defuzzify($inferenceResults);

            $results[] = [
                'alternatif' => $penilaian['alternatif_id'],
                'nilai' => $defuzzifiedValue,
                'fuzzy' => $fuzzyValues,
                'inference' => $inferenceResults,
            ];
        }
        $data = [
            'title' => 'Perhitungan',
            'active' => $this->active,
            'penilaians' => $penilaians,
            'alternatifs' => $alternatifs,
            'kriterias' => $kriterias,
            'results' => $results,
            'content' => 'Views/perhitungan/index.php'
        ];


        include_once('Views/Layout/index.php');
    }

    private function fuzzify($value, $subKriteria)
    {
        // Menghitung nilai fuzzy berdasarkan sub kriteria
        if ($subKriteria['nama'] == 'Baik') {
            if ($value <= 70) {
                return 0;
            } elseif ($value > 70 && $value <= 80) {
                return (80 - $value) / (80 - 70);
            } else {
                return 1;
            }
        } elseif ($subKriteria['nama'] == 'Cukup') {
            if ($value <= 30 || $value >= 80) {
                return 0;
            } elseif ($value > 30 && $value <= 40) {
                return (40 - $value) / (40 - 30);
            } elseif ($value > 40 && $value <= 70) {
                return 0;
            } else {
                return (80 - $value) / (80 - 70);
            }
        } else {
            if ($value <= 30) {
                return 1;
            } elseif ($value > 30 && $value <= 40) {
                return (40 - $value) / (40 - 30);
            } else {
                return 0;
            }
        }
    }

    private function infer($fuzzyValues, $rules)
    {
        $inferenceResults = [];

        foreach ($rules as $rule) {
            $conditions = json_decode($rule['rule'], true);
            $outputs = [];

            foreach ($conditions as $kriteriaId => $subKriteriaId) {
                $outputs[] = $fuzzyValues[$kriteriaId][$subKriteriaId];
            }

            $inferenceResults[] = [
                'output' => $rule['output'],
                'value' => min($outputs)
            ];
        }

        return $inferenceResults;
    }

    private function defuzzify($inferenceResults)
    {
        $numerator = 0;
        $denominator = 0;

        foreach ($inferenceResults as $result) {
            $value = 0;

            switch ($result['output']) {
                case 'sangat baik':
                    $value = 90;
                    break;
                case 'baik':
                    $value = 75;
                    break;
                case 'cukup':
                    $value = 50;
                    break;
                case 'kurang':
                    $value = 25;
                    break;
                case 'sangat kurang':
                    $value = 10;
                    break;
            }

            $numerator += $result['value'] * $value;
            $denominator += $result['value'];
        }

        return $denominator == 0 ? 0 : $numerator / $denominator;
    }
}
