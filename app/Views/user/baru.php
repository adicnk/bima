<?= $this->extend('template/dashboard-user') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">   
        <!-- Penelitian -->
        <div class="col-xl-8 col-md-6 mt-4">
            <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>