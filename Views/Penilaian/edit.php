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
                    $sub_kriteria_id = json_decode($data['existing_values']['sub_kriteria_id'], true);
                    foreach ($data['kriteria'] as $k) : ?>
                        <div class="mb-3 row">
                            <label for="kriteria_id_<?= $k['id'] ?>" class="col-sm-3 col-form-label"><?= $k['nama'] ?></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sub_kriteria_id[<?= $k['id'] ?>]" id="sub_kriteria_id_<?= $k['id'] ?>">
                                    <option value="">Pilih Sub Kriteria</option>
                                    <?php foreach ($data['subkriteria'] as $item) : ?>
                                        <?php if ($item['kriteria_id'] == $k['id']) : ?>
                                            <option value="<?= $item['id'] ?>" <?= isset($sub_kriteria_id[$k['id']]) && $item['id'] == $sub_kriteria_id[$k['id']] ? 'selected' : '' ?>>
                                                <?= $item['nama'] ?>
                                            </option>
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