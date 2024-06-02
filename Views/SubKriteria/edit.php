<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url() ?>subkriteria/update" method="POST">
                    <input type="hidden" name="kriteria_id" value="<?= $data['item']['kriteria_id'] ?>">
                    <input type="hidden" name="id" value="<?= $data['item']['id'] ?>">

                    <div class="form-group">
                        <label for="bobot">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['item']['nama'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <a href="<?= base_url() ?>subkriteria/index?idk=<?= $data['item']['kriteria_id'] ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>