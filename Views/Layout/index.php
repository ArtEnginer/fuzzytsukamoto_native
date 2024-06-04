<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Codeigniter 4 &amp; App Theme">
    <meta name="author" content="MrFrost">
    <meta name="keywords" content="codeigniter, bootstrap, bootstrap 5, theme, responsive, ui kit, web">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Panel</title>
    <!-- Assets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link id="theme-style" rel="stylesheet" href="<?= base_url() ?>/assets/css/portal.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
</head>

<body class="">
    <div class="container">
        <div class="row card">
            <div class="col-md-12 card-body">
                <h3 class="text-center fw-bold">
                    SPK PENILAIAN KARYAWAN MENGGUNAKAN FUZZY LOGIC TSUKAMOTO
                </h3>
            </div>
            <!-- logo -->
            <div class="col-md-12 card-body">
                <div class="text-center">
                    <img src="<?= base_url() ?>/assets/images/logo.png" alt="logo" class="img-fluid" style="width: 50px;">
                </div>
            </div>
            <div class="col-md-12 card-body ">
                <div class="display-flex">
                    <div class="row justify-content-between align-items-center">
                        <?php include("navbar.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <?php include_once($data['content']); ?>
            </div>
        </div>
    </div>

    <!-- Assets -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js" integrity="sha256-cHVO4dqZfamRhWD7s4iXyaXWVK10odD+qp4xidFzqTI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/app.js"></script>
    <script src="<?= base_url() ?>/assets/js/main.js"></script>
</body>

</html>