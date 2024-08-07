<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="card">
    <div class="card-header">
        <!-- <?php if ($data['jml_kriteria'] == 3) : ?>
            <p class="text-danger">Nilai kriteria Max Count 3
            </p>
        <?php else : ?>
            <a href="<?= base_url() ?>kriteria/tambah" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i></a>
        <?php endif ?> -->


    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th width="2px">No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
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
                                <a href="<?= base_url() ?>subkriteria/index?idk=<?= $item['id'] ?>" class="btn btn-primary btn-sm text-white">
                                    <i class="fa fa-list ul"></i></a>
                            </td>
                            <td>
                                <a href="<?= base_url() ?>kriteria/edit?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm text-white">
                                    <i class="fa fa-edit"></i></a>
                                </a>
                                <!-- <a href="<?= base_url() ?>kriteria/delete?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm text-white">
                                    <i class="fa fa-trash"></i>
                                </a> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>