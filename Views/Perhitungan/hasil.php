<?php require_once("Views/Layout/index.php"); ?>

<div class="row">
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Rekap Penilaian Karyawan Menggunakan FuzzyTsukamoto</h4>
                            </div>
                        </div>
                        <p>
                            Berikut adalah hasil perhitungan menggunakan metode Fuzzy Tsukamoto.
                        </p>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th>Defuzyfikasi</th>
                                    <th>Kategory</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $result) : ?>
                                    <?php $alternatif = $this->alternatifModel->find($result['alternatif']); ?>
                                    <tr>
                                        <td><?= $alternatif['nama'] ?></td>
                                        <td>
                                            <?= $result['nilai'] ?>
                                        </td>
                                        <td>
                                            <?php if ($result['nilai'] >= 0 && $result['nilai'] <= 20) : ?>
                                                Sangat Kurang
                                            <?php elseif ($result['nilai'] > 20 && $result['nilai'] <= 40) : ?>
                                                Kurang
                                            <?php elseif ($result['nilai'] > 40 && $result['nilai'] <= 60) : ?>
                                                Cukup
                                            <?php elseif ($result['nilai'] > 60 && $result['nilai'] <= 80) : ?>
                                                Baik
                                            <?php elseif ($result['nilai'] > 80 && $result['nilai'] <= 100) : ?>
                                                Sangat Baik
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>