<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="card">
    <div class="card-header">
        <!-- <a href="<?= base_url() ?>rules/tambah" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
        </a> -->

        <!-- note nilai rules tidak dapat diubah karena bersifat const -->
        <!-- <p class="text-danger">Nilai Rules tidak dapat diubah karena bersifat const</p> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th width="2px">No</th>
                        <th>K1</th>
                        <th>K2</th>
                        <th>K3</th>
                        <th>Output</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['items'] as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['K1'] ?></td>
                            <td><?= $item['K2'] ?></td>
                            <td><?= $item['K3'] ?></td>
                            <td><?= $item['Output'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>