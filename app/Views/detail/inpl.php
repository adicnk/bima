<?= $this->extend('template/dashboard-user') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">   
    <?php foreach ($data_penelitian as $data) : ?>
        <!-- Penelitian -->
        <div class="col-xl-8 col-md-6 mt-4">
            <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
        </div>
        <div class="col-xl-10 col-md-6 mt-4">
            <h5 class="h6 mb-0 text-gray-800"><?= $data['judul'] ?></h5>
            <hr/>
        </div>
    <?php endforeach ?>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>