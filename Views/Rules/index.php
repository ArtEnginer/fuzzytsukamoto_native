<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="card">
    <div class="card-header">
        <a href="<?= base_url() ?>rules/tambah" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th width="2px">No</th>
                        <th>Rule</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data['items'] as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <?php
                                $rule = json_decode($item['rule'], true); // Decodes JSON string into PHP array
                                $rule = array_map(function ($item) {
                                    return $item;
                                }, $rule); // This doesn't change the structure of $rule

                                $rule = array_values($rule); // Re-indexes the array numerically
                                $rule = implode(' AND ', $rule); // Tries to implode the array into a string
                                echo $rule; // Outputs the imploded string
                                ?>
                                Output : <?= $item['output'] ?> <!-- Outputs the 'output' field from $item -->
                            </td>

                            <td>
                                <a href="<?= base_url() ?>rules/edit?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm text-white">
                                    <i class="fa fa-edit"></i></a>
                                </a>
                                <a href="<?= base_url() ?>rules/delete?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm text-white">
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