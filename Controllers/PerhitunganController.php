<?php

function muKurang($x)
{
    if ($x <= 30) {
        return 1;
    } elseif ($x > 30 && $x < 40) {
        return (40 - $x) / (40 - 30);
    } else {
        return 0;
    }
}

function muCukup($x)
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

function muBaik($x)
{
    if ($x >= 80) {
        return 1;
    } elseif ($x > 70 && $x < 80) {
        return ($x - 70) / (80 - 70);
    } else {
        return 0;
    }
}

function zKurang($alpha)
{
    return 50 - 10 * $alpha;
}

function zCukup($alpha)
{
}


function zBaik($alpha)
{
    return 80 + 10 * $alpha;
}



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

$kriteria = [
    'K1' => 72,
    'K2' => 60,
    'K3' => 55,
];

$rules_fuzzy = [];
foreach ($rules as $rule) {
    $rule_fuzzy = [];
    foreach ($rule as $key => $value) {
        $rule_fuzzy[$key] = $value == 'Baik' ? muBaik($kriteria[$key]) : ($value == 'Cukup' ? muCukup($kriteria[$key]) : muKurang($kriteria[$key]));
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


// nilai z masing masing baris rules_fuzzy jika output baik maka gunakan rumus baik
// Calculate z and α-pre * z for each rule
$nilai_z = [];
foreach ($rules_fuzzy as $key => $rule) {
    $alpha = $rule['nilai_terendah'];
    if ($rule['Output'] == 'Baik') {
        $z = zBaik($alpha);
    } elseif ($rule['Output'] == 'Cukup') {
        $z = zCukup($alpha);
    } else { // Kurang
        $z = zKurang($alpha);
    }
    $rules_fuzzy[$key]['z'] = $z;
    $rules_fuzzy[$key]['alpha_z'] = $alpha * $z;
}

// echo jadikan table agar mudah dibaca
echo "<table border='1'>";
echo "<tr>";
echo "<th>K1</th>";
echo "<th>K2</th>";
echo "<th>K3</th>";
echo "<th>Output</th>";
echo "<th>Min</th>";
echo "<th>Z</th>";
echo "</tr>";
foreach ($rules_fuzzy as $rule) {
    echo "<tr>";
    echo "<td>" . $rule['K1'] . "</td>";
    echo "<td>" . $rule['K2'] . "</td>";
    echo "<td>" . $rule['K3'] . "</td>";
    echo "<td>" . $rule['Output'] . "</td>";
    echo "<td>" . $rule['nilai_terendah'] . "</td>";
    echo "<td>" . $rule['z'] . "</td>";
    echo "</tr>";
}
echo "</table>";
