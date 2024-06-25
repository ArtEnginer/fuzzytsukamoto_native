<?php require_once("Views/Layout/index.php"); ?>


<div class="row">
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Nilai Karyawan</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 1</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah nilai karyawan yang telah diinputkan.
                        </p>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="app-card-body">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <?= $data['alternatif']->find($data['penilaian']['alternatif_id'])['nama'] ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php $nilai = json_decode($data['penilaian']['nilai']);
                                foreach ($nilai as $key => $value) : ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Kriteria <?= $key ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?= $value ?></p>
                                        </div>
                                    </div>
                                <?php endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- inferensi, defuzifiaksi -->
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Rules</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 2</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah hasil Rules Fuzzy dari nilai karyawan.
                        </p>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="app-card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>K1</th>
                                    <th>K2</th>
                                    <th>K3</th>
                                    <th>Output</th>
                                    <th>𝜶 − 𝒑𝒓e</th>
                                    <th>Z</th>
                                    <th>𝜶 − 𝒑𝒓𝒆 ∗ Z</th>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data['hasil'] as $hasil) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $hasil['K1'] ?></td>
                                        <td><?= $hasil['K2'] ?></td>
                                        <td><?= $hasil['K3'] ?></td>
                                        <td><?= $hasil['Output'] ?></td>
                                        <td><?= $hasil['nilai_terendah'] ?></td>
                                        <td><?= $hasil['z'] ?></td>
                                        <td><?= $hasil['alpha_z'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- defuzzifikasi -->
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Defuzzifikasi</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 3</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah hasil defuzzifikasi dari hasil inferensi.
                        </p>
                        <code>𝑍 =∑(𝑎_𝑝𝑖 ∗ 𝑧𝑖)/∑ 𝑎_𝑝re</code>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="app-card-body">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Hasil
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Hasil Defuzzifikasi</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $data['z'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Kategori</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $data['kategori'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>