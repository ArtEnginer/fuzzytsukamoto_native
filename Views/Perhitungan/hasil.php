<?php require_once("Views/Layout/index.php"); ?>
<div class="row">
    <div class="col-md-12">
        <div class="app-card shadow-sm mb-4 border-left-decoration">
            <div class="inner">
                <div class="app-card-header p-4">
                    <div class="app-card-header-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="app-card-title">Masukan Periode Hasil</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="badge bg-success">
                                    Periode
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="app-card-body p-4">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="periode">Periode</label>
                                    <input type="month" class="form-control" name="periode" id="periode" value="<?= $data['periode'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="periode"></label>
                                    <button type="submit" class="btn btn-primary form-control text-white">Proses</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
                            <div class="col-md-6 text-end">
                                <button onclick="printResults()" class="btn btn-secondary">Print</button>
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
                                    <th>Nama</th>
                                    <th>Defuzyfikasi</th>
                                    <th>Kategory</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['penilaian'] as $result) : ?>
                                    <tr>
                                        <td><?= $result['nama'] ?></td>
                                        <td><?= $result['z'] ?></td>
                                        <td><?= $result['kategori'] ?></td>
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

<!-- Print Section -->
<div id="printSection" style="display:none;">
    <div style="text-align: center;">
        <img src="<?= base_url() ?>/assets/images/logo.png" alt="logo" class="img-fluid" style="width: 50px;">
        <h2>LAPORAN HASIL PENILAIAN KARYAWAN</h2>
        <!-- <p>Alamat Perusahaan</p>
        <p>Telepon: xxx-xxx-xxxx | Email: info@perusahaan.com</p> -->
        <hr>
        <H4>PERIODE: <?=
                        // convert date format
                        date('F Y', strtotime($data['periode']))
                        ?></H4>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Defuzyfikasi</th>
                    <th>Kategory</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['penilaian'] as $result) : ?>
                    <tr>
                        <td><?= $result['nama'] ?></td>
                        <td><?= $result['z'] ?></td>
                        <td><?= $result['kategori'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div style="margin-top: 50px;">
        <div style="display: flex; justify-content:end;">
            <div style="text-align: center;">
                <p>Disetujui oleh:</p>
                <br><br><br>
                <p>_________________________</p>
                <p>Nama Atasan</p>
                <p>Jabatan Atasan</p>
            </div>
            <!-- <div style="text-align: center;">
                <p>Dibuat oleh:</p>
                <br><br><br>
                <p>_________________________</p>
                <p>Nama Pembuat</p>
                <p>Jabatan Pembuat</p>
            </div> -->
        </div>
    </div>
</div>

<script>
    function printResults() {
        var printContents = document.getElementById('printSection').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>