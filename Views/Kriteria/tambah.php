<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url() ?>kriteria/simpan" method="POST">

                    <div class="form-group">
                        <label for="bobot">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
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