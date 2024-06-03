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
                                <input type="hidden" name="id" value="<?= $data['ruleData']['id'] ?>">
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
                                                <option value="<?= $item['id'] ?>" <?php if ($data['rule'][$value['id']] == $item['id']) echo 'selected'; ?>><?= $item['nama'] ?></option>
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
                            <option value="baik" <?php if ($data['ruleData']['output'] == 'baik') echo 'selected'; ?>>Baik</option>
                            <option value="cukup" <?php if ($data['ruleData']['output'] == 'cukup') echo 'selected'; ?>>Cukup</option>
                            <option value="kurang" <?php if ($data['ruleData']['output'] == 'kurang') echo 'selected'; ?>>Kurang</option>
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