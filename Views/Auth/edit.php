<?php require_once("Views/Layout/index.php"); ?>

<?php echo $data['title'] ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $data['item']['id'] ?>">
                    <div class="form-group mt-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['item']['nama'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="username">username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $data['item']['username'] ?>">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?= $data['item']['email'] ?>">
                    </div>
                    <!-- role -->
                    <div class="form-group">
                        <label for="role">role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="admin" <?= $data['item']['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= $data['item']['role'] == 'user' ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="text" name="password" id="password" class="form-control" value="<?= $data['item']['password'] ?>">
                    </div>

                    <div class="form-group mt-3">
                        <a href="<?= base_url() ?>user/index" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>