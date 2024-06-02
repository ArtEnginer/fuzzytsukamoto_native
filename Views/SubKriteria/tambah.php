<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url() ?>subkriteria/simpan" method="POST">
                    <!-- input kriteria_id hidden -->
                    <input type="hidden" name="kriteria_id" id="kriteria_id" class="form-control" value="<?= $data['idk'] ?>">

                    <div class="form-group">
                        <label for="bobot">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="bobot">Bobot</label>
                        <input type="text" name="bobot" id="bobot" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <a href="<?= base_url() ?>subkriteria/index?idk=<?= $_GET['idk'] ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>