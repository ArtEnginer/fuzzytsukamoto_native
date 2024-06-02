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
                            <?php
                            // Asumsi $penilaian adalah array yang berisi id alternatif yang sudah ada di data penilaian
                            $penilaian = array_column($data['penilaian'], 'alternatif_id');
                            ?>

                            <select class="form-select" name="alternatif_id" id="alternatif_id">
                                <option value="">Pilih Alternatif</option>
                                <?php foreach ($data['alternatif'] as $item) : ?>
                                    <?php if (!in_array($item['id'], $penilaian)) : ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <?php foreach ($data['kriteria'] as $k) : ?>
                        <div class="mb-3 row">
                            <label for="kriteria_id" class="col-sm-3 col-form-label"><?= $k['nama'] ?></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sub_kriteria_id[<?= $k['id'] ?>]" id="sub_kriteria_id">
                                    <option value="">Pilih Sub Kriteria</option>
                                    <?php foreach ($data['sub_kriteria'] as $item) : ?>
                                        <?php if ($item['kriteria_id'] == $k['id']) : ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endforeach; ?>

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