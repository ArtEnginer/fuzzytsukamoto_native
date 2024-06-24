<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="" method="POST">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h5>Rules</h5>
                                <P class="text-muted">
                                    Logika AND
                                </P>
                            </div>
                            <div class="card-body">
                                <div class="form-group mt-3">
                                    <?php foreach ($data['kriteria'] as $key => $value) : ?>
                                        <?php
                                        // subkriteria
                                        $subkriteria = $data['subkriteria']->show_with_k($value['id']);
                                        ?>
                                        <label for="kriteria<?= $value['id'] ?>"><?= $value['nama'] ?></label>
                                        <select name="kriteria<?= $value['id'] ?>" id="kriteria<?= $value['id'] ?>" class="form-control">
                                            <option value="">Pilih <?= $value['nama'] ?></option>
                                            <?php foreach ($subkriteria as $key => $item) : ?>
                                                <option value="<?= $item['nama'] ?>"><?= $item['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="output">Output</label>
                        <!-- select baik,cukup,kurang -->
                        <select name="output" id="output" class="form-control">
                            <option value="">Pilih Output</option>
                            <option value="baik">Baik</option>
                            <option value="cukup">Cukup</option>
                            <option value="kurang">Kurang</option>
                        </select>
                    </div>


                    <div class="form-group mt-3">
                        <a href="<?= base_url() ?>rules/index" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>