<?= $this->extend('template/dashboard-user') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php foreach ($data_penelitian as $data) : ?>
    <!-- Content Row -->
    <div class="row">   
        <!-- Penelitian -->
        <div class="col-xl-8 col-md-6 mb-4">
            <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
            <hr/>
        </div>
    </div>
    
    <!-- Content -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $data['judul'] ?></h6>           
        </div>
        <!-- Card Body -->
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Informasi
                <div class="text-white-50 small">Penelitian ini telah disetujui</div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p>Kelompok Skema : <b><?= $data['skema'] ?></b></p>
                    <p>Ruang Lingkup : <b><?= $data['ruang_lingkup'] ?></b></p>
                    <p>Bidang Fokus : <b><?= $data['bidang_fokus'] ?></b></p>
                    <p>Tahun Usulan : <b><?= $data['tahun_usulan'] ?></b></p>
                    <p>Tahun Pelaksanaan : <b><?= $data['tahun_pelaksanaan'] ?></b></p>
                </div>
                <div class="col-6">
                    <p>Lama Kegiatan : <b><?= $data['lama'] ?> bulan</b></p>
                    <p>Tema Penelitian : <b><?= $data['tema'] ?></b></p>
                    <p>Topik Penelitian : <b><?= $data['topik'] ?></b></p>
                    <p>Rumpun Ilmu Level 3 : <b><?= $data['rumpun_ilmu'] ?></b></p>
                    <p>Target TKT : <b><?= $data['target_tkt'] ?></b></p>
                </div>
            </div>
        </div>
        <a href="<?= base_url() ?>/FileController/download/<?= $data['file'] ?>">
            <button name="proposal" type="button" class="btn btn-sm btn-danger me-1"><i class="fa fa-file-pdf" style="font-size: 32px;"></i><br>Download</button>
        </a>
        <form method="post" action="<?= base_url() ?>/user/listPenelitian">
        <?php endforeach ?>
        <?= csrf_field() ?>
    </form>
    <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">Kembali ke List Penelitian</button>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>