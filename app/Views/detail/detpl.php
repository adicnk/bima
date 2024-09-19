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
            <hr/>
            <a href="<?= base_url() ?>/FileController/download/<?= $data['file'] ?>">
                <button name="proposal" type="button" class="btn btn-sm btn-danger me-1"><i class="fa fa-file-pdf" style="font-size: 32px;"></i><br>Download</button>
            </a>
        </div>

        <?php 
            $anggota = $db->query('SELECT * FROM anggota_dosen WHERE dosen_id='.$dosen_id.' AND penelitian_id='.$penelitianID)->getResultArray(); 
            //dd('SELECT * FROM anggota_dosen WHERE dosen_id='.$dosen_id.' AND penelitian_id='.$penelitianID);
            if ($anggota) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Identitas Anggota Dosen                
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="50px">NIDN</th>
                    <th scope="col" width="200px">Nama</th>
                    <th scope="col" width="200px">Institusi</th>
                    <th scope="col" width="100px">Prodi</th>
                    <th scope="col" width="200px">Tugas</th>
                    <th scope="col" width="80px">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;                            
                    foreach ($anggota as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['nidn'] ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['institusi'] ? $data['institusi'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['prodi'] ? $data['prodi'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['tugas'] ? $data['tugas'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-primary text-white small">usulan</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-success text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach; // Loop Data Angota Dosen
            ?>
            </tbody>
        </table>
    </div>
    <?php endif ?>

    <?php 
            $nonDosen = $db->query('SELECT * FROM anggota_non_dosen WHERE dosen_id='.$dosen_id.' AND penelitian_id='.$penelitianID)->getResultArray(); 
            if ($nonDosen) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Identitas Anggota Non Dosen                
            </div>
        </div>    
    <!-- Table Anggota Non Dosen -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="50px">Jenis</th>
                    <th scope="col" width="100px">Identitas</th>
                    <th scope="col" width="200px">Nama</th>
                    <th scope="col" width="200px">Institusi</th>
                    <th scope="col" width="200px">Tugas</th>
                    <th scope="col" width="80px">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach ($nonDosen as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['ktp'] ? $data['ktp'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['institusi'] ? $data['institusi'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td><?= $data['tugas'] ? $data['tugas'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-primary text-white small">usulan</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-success text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php endif ?>

    <?php endforeach; // Loop Data Penelitian ?>

    <?php 
            $substansi = $db->query('SELECT * FROM substansi_luaran WHERE dosen_id='.$dosen_id.' AND penelitian_id='.$penelitianID)->getResultArray(); 
            if ($substansi) :
    ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Substansi dan Luaran
            </div>
        </div>    
       <?php  
          $sql = "SELECT * FROM substansi_luaran WHERE penelitian_id=".$penelitianID." AND (makro_riset IS NOT null OR file_luaran IS NOT null)" ;
          $substansi_x = $db->query($sql)->getResultArray();        
          if ($substansi_x) :
            $idx=1;
            foreach ($substansi_x as $dataSecondary) :
                if ($idx==1):
        ?> 
            <div>        
                <p scope="col" width="50px"><b>Nama Makro Riset :</b>  <?= $dataSecondary['makro_riset'] ?></p>
                <p scope="col" width="200px"><b>Subtansi : <?= $dataSecondary['file_luaran'] ?
                    '<a href="'.base_url().'/FileController/downloadSubstanti/'. $dataSecondary['file_luaran'].'"  
                    class="btn btn-sm btn-danger"><span class="fa fa-file-pdf"></span>Download</a></b></p>' : '-' ?></b>
            </div>
        <?php $idx++; endif; endforeach; endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="120px">Urutan Tahun</th>
                    <th scope="col" width="150px">Kelompok Luaran</th>
                    <th scope="col" width="250px">Jenis Luaran</th>
                    <th scope="col" width="50px">Target</th>
                    <th scope="col" width="200px">Keterangan</th>
                    <th scope="col" width="50px"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach ($substansi as $data) :                        
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td>Tahun ke - <?= $data['urutan_tahun'] ?></td>
                    <td><?= $data['kelompok_luaran'] ? $data['kelompok_luaran'] : '-' ?></td>
                    <td><?= $data['jenis_luaran'] ? $data['jenis_luaran'] : '-' ?></td>
                    <td><?= $data['target_luaran'] ? $data['target_luaran'] : '-' ?></td>
                    <td><?= $data['keterangan'] ? $data['keterangan'] : '-' ?></td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>


    <form method="post" action="<?= base_url() ?>/user/listPenelitian">
        <?= csrf_field() ?>
        <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">Kembali ke List Penelitian</button>
    </form>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>