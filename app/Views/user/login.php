<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Developing Your Future">
    <meta name="author" content="Dev Inc">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <title>BP3MI | User Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/admin_assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4"> User <?=lang('Auth.loginTitle')?></h1>
                                    </div>
                                    <hr>
                                    <div class="small text-center mb-3">
                                    Usulan Penelitian dan Pengabdian <br/> di STIKEP PPNI Jawa Barat
                                    </div>
                                    <?= view('Myth\Auth\Views\_message_block') ?>
                                    <hr>
                                    <div class="small text-center mb-3">
                                    Tidak punya account? <a href="<?= url_to('register') ?>">Register</a>
                                    </div>                                    
                                    <form method="post" action="<?= url_to('login') ?>" class="user">
                                        <?= csrf_field() ?>
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                                                name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.login') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.password') ?>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="small text-center">
                                        Input Data dan Upload File
                                    </div>
                                    <hr>
                                    <p><strong><div class="small text-center text-red">
                                        Stikep PPNI Jawa Barat © 2024
                                    </div></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/admin_assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/admin_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/admin_assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/admin_assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="admin_assets/js/demo/chart-area-demo.js"></script> -->
    <script src="<?= base_url(); ?>/admin_assets/js/chart-pie-demo.php"></script>


</body>

</html>