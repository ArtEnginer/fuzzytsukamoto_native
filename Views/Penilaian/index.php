<?php require_once("Views/Layout/index.php"); ?>
<?php
$kriteriaMapping = [];
foreach ($data['kriteria'] as $k) {
    $kriteriaMapping[$k['id']] = $k['nama'];
}

$alternatifMapping = [];
foreach ($data['alternatif'] as $a) {
    $alternatifMapping[$a['id']] = $a['nama'];
}
?>

<?php echo $data['title'] ?>
<div class="card">
    <div class="card-header">
        <a href="<?= base_url() ?>penilaian/tambah" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i></a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th width="2px">No</th>
                        <th>Nama</th>
                        <th>Periode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['penilaian'] as $index => $item) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $alternatifMapping[$item['alternatif_id']]; ?></td>
                            <td><?php echo $item['periode']; ?></td>
                            <td>
                                <a href="<?= base_url() ?>penilaian/edit?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm text-white">
                                    <i class="fa fa-edit text-white"></i></a>
                                <a href="<?= base_url() ?>penilaian/delete?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm text-white">
                                    <i class="fa fa-trash text-white"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>