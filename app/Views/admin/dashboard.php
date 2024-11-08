<?= $this->extend('template/dashboard-admin') ?>
<?= $this->section('content') ?>
<?php $db = \Config\Database::connect(); ?>

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

    <div class="row">
        <!-- Penelitian -->
        <div class="col-2 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Penelitian</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $countPL==""?0:$countPL ?></b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengabdian -->
        <div class="col-2 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pengabdian</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $countPB==""?0:$countPB ?></b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumlah Staff -->
        <div class="col-2 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Penelitian Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $setujuPL==""?0:$setujuPL ?></b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Soal -->
        <div class="col-2 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Penelitian Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $setujuPB==""?0:$setujuPB ?></b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Staff -->
        <div class="col-2 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Penelitian Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $tolakPL==""?0:$tolakPL ?></b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Soal -->
        <div class="col-2 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Penelitian Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><b><?= $tolakPB==""?0:$tolakPB ?></b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Content Row -->
    <div class="row">

        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Daftar Dosen Peneliti
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50px" style="text-align: center">#</th>
                        <th scope="col" width="200px">Nama</th>
                        <th scope="col" width="100px">NIDN</th>
                        <th scope="col" width="150px">Pendidikan</th>
                        <th scope="col" width="200px">Program Studi</th>
                        <th scope="col" width="100px">Total Penelitian</th>
                        <th scope="col" width="100px">Total Pengabdian</th>
                        <th scope="col" width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $index = 1;
                        foreach ($dosen as $data) :
                        ?>
                    <tr>                    
                        <td style="text-align: center"><?= $index ?></td>
                        <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                        <td><?= $data['nidn_nidk'] ? $data['nidn_nidk'] : '-' ?></td>
                        <td><?= $data['pendidikan'] ? $data['pendidikan'] : '-' ?></td>
                        <td><?= $data['program_studi'] ? $data['program_studi'] : '-' ?></td>
                        <td>0</td>
                        <td>0</td>
                        <td>
                        <a href="<?= '/user/plpb/' .$data['id'] ?>" title="View Detail"><img src="<?= base_url() ?>/icon/view.png" /></a>
                    </td>
                    </tr>
                <?php
                    $index++;
                    endforeach;
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<!-- /.container-fluid -->

<?= $this->endSection() ?>