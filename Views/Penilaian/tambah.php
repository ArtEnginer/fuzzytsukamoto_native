<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url() ?>penilaian/simpan" method="POST">
                    <div class="mb-3 row">
                        <label for="alternatif_id" class="col-sm-3 col-form-label">Alternatif</label>
                        <div class="col-sm-9">

                            <select class="form-select" name="alternatif_id" id="alternatif_id">
                                <option value="">Pilih Alternatif</option>
                                <?php foreach ($data['alternatif'] as $item) : ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <?php foreach ($data['kriteria'] as $k) : ?>
                        <div class="mb-3 row">
                            <label for="kriteria_id" class="col-sm-3 col-form-label"><?= $k['nama'] ?></label>
                            <div class="col-sm-9">
                                <!-- using range input -->
                                <input type="range" class="form-range" name="sub_kriteria_id[<?= $k['id'] ?>]" id="sub_kriteria_id_<?= $k['id'] ?>" min="1" max="100" value="1" oninput="updateRangeValue(<?= $k['id'] ?>)">
                                <span id="rangeValue_<?= $k['id'] ?>">1</span>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="mb-3 row">
                        <label for="periode" class="col-sm-3 col-form-label">Periode</label>
                        <div class="col-sm-3">
                            <input type="month" class="form-control" name="periode" id="periode">
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
</div>
<script>
    function updateRangeValue(id) {
        var range = document.getElementById('sub_kriteria_id_' + id);
        var valueSpan = document.getElementById('rangeValue_' + id);
        valueSpan.innerHTML = range.value;
    }
</script>