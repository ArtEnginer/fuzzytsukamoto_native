<?php
include_once 'Models\RulesModel.php';
include_once 'Models\KriteriaModel.php';
include_once 'Models\SubKriteriaModel.php';

class RulesController
{
    private $RulesModel;

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
        $this->RulesModel = new RulesModel($koneksi);
        $this->KriteriaModel = new KriteriaModel($koneksi);
        $this->SubKriteriaModel = new SubKriteriaModel($koneksi);
        $this->active = 'Rules';
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Rules',
            'active' => $this->active,
            'items' => $this->RulesModel->all(),
            'displayRules' => $this,
            'content' => 'Views/Rules/index.php',
        ];
        include_once('Views/Layout/index.php');
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Rules',
            'active' => $this->active,
            'kriteria' => $this->KriteriaModel->all(),
            'subkriteria' => $this->SubKriteriaModel,
            'content' => 'Views/Rules/tambah.php',
        ];


        if ($_POST) {
            $rule = [];
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'kriteria') !== false) {
                    // Mendapatkan ID kriteria dari nama field
                    $kriteriaId = str_replace('kriteria', '', $key);
                    $rule[$kriteriaId] = $value;
                }
            }
            $data = [
                'rule' => json_encode($rule),
                'output' => $_POST['output'],
            ];
            $this->RulesModel->add($data);
            header('Location: ' . base_url() . 'rules/index');
        }

        include_once('Views/Layout/index.php');
    }

    // edit
    public function edit()
    {
        $id = $_GET['id'];
        $ruleData = $this->RulesModel->show($id);
        if (!$ruleData) {
            header('Location: ' . base_url() . 'rules/index');
            exit;
        }

        // Decode the rule's JSON data to retrieve criteria and their subcriteria
        $rule = json_decode($ruleData['rule'], true);

        $data = [
            'title' => 'Edit Rules',
            'active' => $this->active,
            'kriteria' => $this->KriteriaModel->all(),
            'subkriteria' => $this->SubKriteriaModel,
            'ruleData' => $ruleData,
            'rule' => $rule,
            'content' => 'Views/Rules/edit.php',
        ];

        if ($_POST) {
            $updatedRule = [];
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'kriteria') !== false) {
                    // Mendapatkan ID kriteria dari nama field
                    $kriteriaId = str_replace('kriteria', '', $key);
                    $updatedRule[$kriteriaId] = $value;
                }
            }
            $dataToUpdate = [
                'id' => $_POST['id'], // Add the rule's ID to the data to update
                'rule' => json_encode($updatedRule),
                'output' => $_POST['output'],
            ];
            $this->RulesModel->update($dataToUpdate);
            header('Location: ' . base_url() . 'rules/index');
        }

        include_once('Views/Layout/index.php');
    }


    public function delete()
    {
        $id = $_GET['id'];
        $this->RulesModel->delete($id);
        header('Location: ' . base_url() . 'rules/index');
    }

    // Additional function to convert rule JSON to readable format
    public function displayRule($ruleJson)
    {
        $ruleArray = json_decode($ruleJson, true);
        $result = "IF ";

        foreach ($ruleArray as $kriteriaId => $subkriteriaId) {
            $kriteriaName = $this->KriteriaModel->show($kriteriaId)['nama'];
            $subkriteriaName = $this->SubKriteriaModel->find($subkriteriaId)['nama'];
            $result .= "{$kriteriaName} $subkriteriaName AND ";
        }

        $result = rtrim($result, ' AND ') . " THEN";

        return $result;
    }
}
