<?= $this->extend('template/dashboard-user') ?>
<?= $this->section('content') ?>
<?php $db = \Config\Database::connect(); ?>

<?php foreach ($dosen as $dsn) { ?>
    <?php //dd($dosen) ?>;

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="mt-3">
        <hr>
    </div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800"><strong><?= $title; ?></strong></h1>
    </div>

    <div class="mt-3">
        <hr>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Penelitian -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Penelitian</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $plCount==""?0:$plCount ?></b></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flask fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengabdian -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Pengabdian</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $pbCount==""?0:$pbCount ?></b></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Staff -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Artikel Jurnal Internasional</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $dsn['artikel_internasional']==""?0:$dsn['artikel_internasional'] ?></b></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Soal -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Buku yang sudah dipublikasikan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $dsn['buku'] ==""?0:$dsn['buku'] ?></b></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data User -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p>Nama : <b><?= $dsn['nama'] ?></b></p>
                    <p>NIDN / NIDK :<b><?= $dsn['nidn_nidk'] ?></b></p>
                    <p>Klaster : <b><?= $dsn['klaster'] ?></b></p>
                    <p>Program Studi : <b><?= $dsn['program_studi'] ?></b></p>
                    <p>Jenjang Pendidikan : <b><?= $dsn['pendidikan'] ?></b></p>
                    <p>Jabatan Akademik : <b><?= $dsn['jabatan'] ?></b></p>
                </div>
                <div class="col-6">
                    <p>Alamat : <b><?= $dsn['alamat'] ?></b></p>
                    <p>Tempat Tanggal Lahir : <b><?= $dsn['tempat_lahir'].", ". $dsn['tanggal_lahir'] ?></b></p>
                    <p>No. KTP : <b><?= $dsn['ktp'] ?></b></p>
                    <p>No. Telepon : <b><?= $dsn['telp']==""?"-":$dsn['telp']?></b></p>
                    <p>No. Handphone : <b><?= $dsn['hp']==""?"-":$dsn['hp']?></b></p>
                    <p>Alamat Surel :  <b><?= user()->email ?></b></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile User -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Profile User</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p>Sinta Score Overall : <b><?= $dsn['overall']==""?"-":$dsn['overall']?></b></p>
                    <P>Sinta Score 3 Year : <b><?= $dsn['3_year']==""?"-":$dsn['3_year']?></b></P>
                </div>
                <div class="col-6">
                    <p>HKI : <b><?= $dsn['hki']==""?"-":$dsn['hki']?></b></p>
                    <p>Scopus H-Index : <b><?= $dsn['h_index']==""?"-":$dsn['h_index'] ?></b></p>                    
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>