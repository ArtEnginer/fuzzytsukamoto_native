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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="2px">No</th>
                                    <th>Alternatif</th>
                                    <?php foreach ($data['kriterias'] as $kriteria) : ?>
                                        <th><?= $kriteria['nama'] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data['penilaians'] as $penilaian) : ?>
                                    <?php
                                    $nilai = json_decode($penilaian['nilai'], true);
                                    $alternatif = $this->alternatifModel->find($penilaian['alternatif_id']);
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif['nama'] ?></td>
                                        <?php foreach ($nilai as $n) : ?>
                                            <td><?= $n ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
                                <h4 class="app-card-title">Inferensi</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 2</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah hasil inferensi dari nilai karyawan.
                        </p>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="app-card-body">
                        <?php foreach ($results as $result) : ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Alternatif ID: <?= $result['alternatif'] ?></strong>
                                </div>
                                <div class="card-body">
                                    <h5>Hasil Inferensi:</h5>
                                    <ul>
                                        <?php foreach ($result['inference'] as $inference) : ?>
                                            <li><?= $inference['output'] ?>: <?= $inference['value'] ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="app-card-body">
                        <?php foreach ($results as $result) : ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Alternatif ID: <?= $result['alternatif'] ?></strong>
                                </div>
                                <div class="card-body">
                                    <h5>Hasil Defuzzifikasi:</h5>
                                    <p><?= $result['nilai'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>