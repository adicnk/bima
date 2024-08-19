<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Developing Your Future">
    <meta name="author" content="Dev Inc">

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
                                        <h1 class="h2 text-gray-900 mb-4">Register New User</h1>
                                    </div>
                                    <hr>
                                    <div class="small text-center mb-3">
                                    Usulan Penelitian dan Pengabdian <br/> di STIKEP PPNI Jawa Barat
                                    </div>
                                    <?= view('Myth\Auth\Views\_message_block') ?>
                <hr>             
                <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">                        
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                            name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                        <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
                    </div>

                    <div class="form-group">                        
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary btn-user btn-block"><?=lang('Auth.register')?></button>
                </form>
                <hr>
                <div class="small text-center mb-3">
                    Sudah terdaftar ? <a href="<?= url_to('login') ?>">Login</a>
                </div>
                <p><strong><div class="small text-center text-red">
                    Stikep PPNI Jawa Barat © 2024
                </div></strong></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/admin_assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/admin_assets/js/sb-admin-2.min.js"></script>

</body>
</html>

