<?php require_once("Views/Layout/index.php"); ?>

<div class="row">
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Matrix Keputusan</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 1</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah matrix keputusan yang digunakan untuk menentukan alternatif terbaik.
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
                                    <?php foreach ($data['kriteria'] as $kriteria) : ?>
                                        <th><?= $kriteria['nama'] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data['matriks_keputusan'] as $nama_alternatif => $matriks_keputusan) : ?>
                                    <?php $alternatif = $this->alternatifModel->find($nama_alternatif); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif['nama'] ?></td>
                                        <?php foreach ($data['kriteria'] as $kriteria) : ?>
                                            <td><?= $matriks_keputusan[$kriteria['id']] ?></td>
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

    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Normalisasi matriks keputusan</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 2</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah normalisasi matriks keputusan yang digunakan untuk menentukan alternatif terbaik.
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
                                    <?php foreach ($data['kriteria'] as $kriteria) : ?>
                                        <th><?= $kriteria['nama'] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data['normalisasi_matriks'] as $nama_alternatif => $normalisasi_matriks) : ?>
                                    <?php $alternatif = $this->alternatifModel->find($nama_alternatif); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif['nama'] ?></td>
                                        <?php foreach ($data['kriteria'] as $kriteria) : ?>
                                            <td><?= $normalisasi_matriks[$kriteria['id']] ?></td>
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

    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Matriks normalisasi terbobot</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 3</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah matriks normalisasi terbobot yang digunakan untuk menentukan alternatif terbaik.
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
                                    <?php foreach ($data['kriteria'] as $kriteria) : ?>
                                        <th><?= $kriteria['nama'] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data['terbobot_matriks'] as $nama_alternatif => $terbobot_matriks) : ?>
                                    <?php $alternatif = $this->alternatifModel->find($nama_alternatif); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif['nama'] ?></td>
                                        <?php foreach ($data['kriteria'] as $kriteria) : ?>
                                            <td><?= $terbobot_matriks[$kriteria['id']] ?></td>
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

    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Skor MOORA</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">Langkah 4</div>
                            </div>
                        </div>
                        <p>
                            Berikut adalah skor MOORA yang digunakan untuk menentukan alternatif terbaik.
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
                                    <th>Skor MOORA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data['skor_moora'] as $nama_alternatif => $skor) : ?>
                                    <?php $alternatif = $this->alternatifModel->find($nama_alternatif); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif['nama'] ?></td>
                                        <td><?= $skor ?></td>
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