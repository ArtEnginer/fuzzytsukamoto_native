<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Edit Penilaian
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">

                <form action="<?= base_url() ?>penilaian/update?id=<?= $data['existing_values']['id'] ?>" method="POST">
                    <div class="mb-3 row">
                        <label for="alternatif_id" class="col-sm-3 col-form-label">Alternatif</label>
                        <div class="col-sm-9">
                            <?php foreach ($data['alternatif'] as $item) : ?>
                                <?php if ($item['id'] == $data['existing_values']['alternatif_id']) : ?>
                                    <input type="hidden" name="alternatif_id" id="alternatif_id" value="<?= $item['id'] ?>">
                                    <input type="text" class="form-control" value="<?= $item['nama'] ?>" readonly>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php
                    $nilai = json_decode($data['existing_values']['nilai'], true);
                    foreach ($data['kriteria'] as $k) : ?>
                        <div class="mb-3 row">
                            <label for="kriteria_id" class="col-sm-3 col-form-label"><?= $k['nama'] ?></label>
                            <div class="col-sm-9">
                                <!-- using range input -->
                                <input type="range" class="form-range" name="nilai[<?= $k['id'] ?>]" id="nilai_<?= $k['id'] ?>" min="1" max="100" value="<?= $nilai[$k['id']] ?>" oninput="updateRangeValue(<?= $k['id'] ?>)">
                                <span id="rangeValue_<?= $k['id'] ?>"><?= $nilai[$k['id']] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="mb-3 row">
                        <label for="periode" class="col-sm-3 col-form-label">Periode</label>
                        <div class="col-sm-3">
                            <input type="month" class="form-control" name="periode" id="periode" value="<?= $data['existing_values']['periode'] ?>">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <a href="<?= base_url() ?>penilaian/index" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk memperbarui nilai range
        function updateRangeValue(id) {
            var range = document.getElementById('nilai_' + id);
            var valueSpan = document.getElementById('rangeValue_' + id);
            valueSpan.innerHTML = range.value;
        }

        // Panggil fungsi updateRangeValue untuk setiap range saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($data['kriteria'] as $k) : ?>
                updateRangeValue(<?= $k['id'] ?>);
            <?php endforeach; ?>
        });
    </script>