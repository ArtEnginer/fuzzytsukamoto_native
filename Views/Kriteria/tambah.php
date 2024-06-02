<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url() ?>kriteria/simpan" method="POST">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="bobot">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <label for="attribut">Attribut</label>
                        <select name="attribut" id="attribut" class="form-control">
                            <option value="benefit">Benefit</option>
                            <option value="cost">Cost</option>
                        </select>

                        <div class="form-group">
                            <label for="bobot">Bobot</label>
                            <input type="text" name="bobot" id="bobot" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <a href="<?= base_url() ?>kriteria/index" class="btn btn-secondary btn-sm">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>