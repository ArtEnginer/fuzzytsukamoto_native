<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="card">
    <div class="card-header">
        <!-- button back -->
        <a href="<?= base_url() ?>kriteria/index" class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left"></i>
        </a>
        <a href="<?= base_url() ?>subkriteria/tambah?idk=<?= $data['idk'] ?>" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
        </a>


    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th width="2px">No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['items'] as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td>
                                <a href="<?= base_url() ?>subkriteria/edit?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm text-white">
                                    <i class="fa fa-edit"></i></a>
                                </a>
                                <a href="<?= base_url() ?>subkriteria/delete?id=<?= $item['id'] ?>&idk=<?= $item['kriteria_id'] ?>" class="btn btn-danger btn-sm text-white">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>