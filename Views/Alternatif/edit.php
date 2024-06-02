<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url() ?>alternatif/update" method="POST">
                    <input type="hidden" name="id" value="<?= $data['item']['id'] ?>">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['item']['nama'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="nip">NIP</label>
                        <input type="number" name="nip" id="nip" class="form-control" value="<?= $data['item']['nip'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <a href="<?= base_url() ?>alternatif/index" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>