<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="" method="POST">
                    <?php foreach ($data['kriteria'] as $key => $kriteria) : ?>
                        <?php $subkriteria = $data['subkriteria']->find($kriteria['id']); ?>
                        <div class="form-group mt-3">
                            <label for="kriteria<?= $kriteria['id'] ?>"><?= $kriteria['nama'] ?></label>
                            <select name="kriteria<?= $kriteria['id'] ?>" id="kriteria<?= $kriteria['id'] ?>" class="form-control">
                                <option value="">Pilih <?= $kriteria['nama'] ?></option>
                                <?php foreach ($subkriteria as $sub) : ?>
                                    <option value="<?= $sub['id'] ?>"><?= $sub['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group mt-3">
                        <label for="output">Output</label>
                        <!-- select baik,cukup,kurang -->
                        <select name="output" id="output" class="form-control">
                            <option value="">Pilih Output</option>
                            <option value="1">Baik</option>
                            <option value="2">Cukup</option>
                            <option value="3">Kurang</option>
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