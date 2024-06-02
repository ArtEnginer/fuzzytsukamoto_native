<?php require_once("Views/Layout/index.php"); ?>

<div class="row">
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Rekomendasi Siswa Penerima Beasiswa</h4>
                            </div>
                        </div>
                        <p>
                            Berikut adalah hasil perhitungan menggunakan metode MOORA untuk menentukan siswa yang layak menerima beasiswa.
                        </p>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="2px">No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>NILAI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data['skor_moora'] as $nama_alternatif => $skor) : ?>
                                    <?php $alternatif = $this->alternatifModel->find($nama_alternatif); ?>


                                    <?php
                                    // Hitung level kecerahan hijau berdasarkan nomor urut
                                    $brightness = 255 - ($no * 30); // Mengurangi nilai warna hijau seiring dengan peningkatan nomor urut
                                    $brightness = max($brightness, 0); // Pastikan nilai tidak negatif
                                    $bg_color = "background-color: rgb(0, $brightness, 0);"; // Warna hijau dengan kecerahan yang berbeda-beda
                                    ?>
                                    <tr style="<?= $no <= 3 ? $bg_color : '' ?>">
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif['nama'] ?></td>
                                        <td><?= $alternatif['kelas'] ?></td>
                                        <td><?= $alternatif['jenis_kelamin'] ?></td>
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