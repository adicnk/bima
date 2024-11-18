<?= $this->extend('template/dashboard-admin') ?>

<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="mt-3">
        <hr>
    </div>

    <!-- Page Heading -->
    <div class="mb-4 d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800"> <?= $title ?></h1>
    </div>

<form method="post" action="">
    <?= csrf_field() ?>
    
    <div class="form-group mt-3">                    
    </div>

    <?php 
        $i=2024-(int)date("Y");
    ?>

    <div class="form-row align-items-right mt-3">
        <div class="col-4">
            <div class="input-group-prepend">
                <div class="input-group-text"><strong>Pilih tahun</strong></div>
                <select class="form-control" name="fileTahun" id="fileTahun" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                    for
                    <option value="Kelompok Perguruan Tinggi Binaan">Kelompok Perguruan Tinggi Binaan</option>
                </select>
            </div>
        </div>
    </div>
</form>

</div>

<!-- /.container-fluid -->

<?= $this->endSection() ?>