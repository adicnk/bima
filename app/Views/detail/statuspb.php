<?= $this->extend('template/dashboard-admin') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php foreach ($data_pengabdian as $data) : ?>

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
        <?php if ($data['status']==1) { ?>
            <div class="card bg-primary text-white shadow">
        <?php } elseif ($data['status']==null) { ?>
            <div class="card bg-info text-white shadow">
        <?php } else { ?>
            <div class="card bg-danger text-white shadow">
        <?php } ?>
            <div class="card-body">
                Informasi
                <?php if ($data['status']==1) { ?>
                    <div class="text-white-50 small">Pengabdian ini telah disetujui</div>
                    <?php } elseif ($data['status']==null) { ?>
                        <div class="text-white-50 small">Pengabdian ini msih dalam usulan</div>
                    <?php } else { ?>
                        <div class="text-white-50 small">Penbgabdian ini telah ditolak</div>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p>Kelompok Skema : <b><?= $data['skema'] ?></b></p>
                    <p>Ruang Lingkup : <b><?= $data['ruang_lingkup'] ?></b></p>
                    <p>Bidang Fokus : <b><?= $data['bidang_fokus'] ?></b></p>
                </div>
                <div class="col-6">
                    <p>Tahun Usulan : <b><?= $data['tahun_usulan'] ?></b></p>
                    <p>Tahun Pelaksanaan : <b><?= $data['tahun_pelaksanaan'] ?></b></p>
                    <p>Lama Kegiatan : <b><?= $data['lama'] ?> bulan</b></p>
                    <p>Rumpun Ilmu Level 3 : <b><?= $data['rumpun_ilmu'] ?></b></p>
                </div>
            </div>
            <hr/>
            <a href="<?= base_url() ?>/FileController/download/<?= $data['file'] ?>">
                <button name="proposal" type="button" class="btn btn-sm btn-danger me-1"><i class="fa fa-file-pdf" style="font-size: 32px;"></i><br>Download</button>
            </a>
        </div>
        <!-- End DataPengabdian -->

        <?php 
            $anggota = $db->query('SELECT * FROM anggota_dosen_pb WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($anggota) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Anggota Usulan Dosen                
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">#</th>
                        <th scope="col" width="50px">NIDN</th>
                        <th scope="col" width="200px">Nama</th>
                        <th scope="col" width="100px">Peran</th>
                        <th scope="col" width="200px">Rumpun Ilmu</th>
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
                        <td><?= $data['nidn'] ? $data['nidn'] : '-' ?></td>
                        <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                        <td><?= $data['peran'] ? $data['peran'] : '-' ?></td>
                        <td><?= $data['rumpun_ilmu'] ? $data['rumpun_ilmu'] : '-' ?></td>
                        <td><?= $data['prodi'] ? $data['prodi'] : '-' ?></td>
                        <td><?= $data['tugas'] ? $data['tugas'] : '-' ?></td>
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
        <?php endif; ?>
        <!--End Dosen Anggota -->

        <?php 
            $vokasi = $db->query('SELECT * FROM anggota_vokasi WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($vokasi) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Anggota Usulan Dosen Vokasi
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">#</th>
                        <th scope="col" width="50px">NIDN</th>
                        <th scope="col" width="200px">Nama</th>
                        <th scope="col" width="100px">Peran</th>
                        <th scope="col" width="200px">Rumpun Ilmu</th>
                        <th scope="col" width="100px">Prodi</th>
                        <th scope="col" width="200px">Tugas</th>
                        <th scope="col" width="80px">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $index = 1;
                        foreach ($vokasi as $data) :
                        ?>
                    <tr>                    
                        <td style="text-align: center"><?= $index ?></td>
                        <td><?= $data['nidn'] ? $data['nidn'] : '-' ?></td>
                        <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                        <td><?= $data['peran'] ? $data['peran'] : '-' ?></td>
                        <td><?= $data['rumpun_ilmu'] ? $data['rumpun_ilmu'] : '-' ?></td>
                        <td><?= $data['prodi'] ? $data['prodi'] : '-' ?></td>
                        <td><?= $data['tugas'] ? $data['tugas'] : '-' ?></td>
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
        <?php endif; ?>
        <!--End Dosen Vokasi -->

        <?php 
            $mahasiswa = $db->query('SELECT * FROM anggota_mahasiswa WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($mahasiswa) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Anggota Usulan Mahasiswa
            </div>
        </div>
    
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">#</th>
                        <th scope="col" width="50px">NIDN</th>
                        <th scope="col" width="100px">Nama</th>
                        <th scope="col" width="100px">Peran</th>
                        <th scope="col" width="100px">Instansi</th>
                        <th scope="col" width="100px">Prodi</th>
                        <th scope="col" width="80px">Mata Kuliah</th>
                        <th scope="col" width="10px">SKS</th>
                        <th scope="col" width="250px">Tugas</th>
                        <th scope="col" width="50px">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $index = 1;
                        foreach ($mahasiswa as $data) :
                        ?>
                    <tr>                    
                        <td style="text-align: center"><?= $index ?></td>
                        <td><?= $data['nidn'] ? $data['nidn'] : '-' ?></td>
                        <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                        <td><?= $data['peran'] ? $data['peran'] : '-' ?></td>
                        <td><?= $data['instansi'] ? $data['instansi'] : '-' ?></td>
                        <td><?= $data['prodi'] ? $data['prodi'] : '-' ?></td>
                        <td><?= $data['mata_kuliah'] ? $data['mata_kuliah'] : '-' ?></td>
                        <td><?= $data['sks'] ? $data['sks'] : '-' ?></td>
                        <td><?= $data['tugas'] ? $data['tugas'] : '-' ?></td>
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
        <?php endif; ?>
        <!-- End Table Anggota Mahasiswa -->

        <?php 
            $substansi = $db->query('SELECT * FROM substansi_pb WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($substansi) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Substansi
            </div>
        </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="50px" style="text-align: center">#</th>
                    <th scope="col" width="250px">Jenis</th>
                    <th scope="col" width="150px">File</th>
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
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td><?= $data['file_'] ?'<a href="'. 
                    base_url().'/FileController/download/'.$data['file_'].'">
                    <button class="btn btn-sm btn-danger">
                    <i class="fa fa-file-pdf"></i>Download</button></a>' : '-' ?></td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <hr/>
    <?php endif; ?>
    <!-- End Table Substansi -->

        <?php 
            $luaran = $db->query('SELECT * FROM luaran_pb WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($luaran) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Luaran yang Dijanjikan
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped table-fixed">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="50px">Tahun Kegiatan</th>
                    <th scope="col" width="200px">Kelompok</th>
                    <th scope="col" width="200px">Jenis</th>
                    <th scope="col" width="150px">Target</th>
                    <th scope="col" width="40px">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <?php
                        $index = 1;
                        foreach ($luaran as $data) :
                        ?>
                    <tr>                    
                        <td style="text-align: center"><?= $index ?></td>
                        <td><?= $data['tahun'] ? $data['tahun'] : '-' ?></td>
                        <td><?= $data['kelompok'] ? $data['kelompok'] : '-' ?></td>
                        <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                        <td><?= $data['target_'] ? $data['target_'] : '-' ?></td>
                        <td><?= $data['keterangan'] ? wordwrap($data['keterangan'],60,"<br>\n") : '-' ?></td>
                    </tr>
                <?php
                    $index++;
                    endforeach;
                ?>
                </tbody>
        </table>
        </div>
        <?php endif; ?>
    <!-- End Table Luaran -->

        <?php 
            $mitra = $db->query('SELECT * FROM mitra_pb WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($mitra) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Mitra
            </div>
        </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="120px">Nama Mitra</th>
                    <th scope="col" width="150px">Jenis Mitra</th>
                    <th scope="col" width="250px">Kelompok Mitra</th>
                    <th scope="col" width="100px">Dana Tahun 1</th>
                    <th scope="col" width="100px">Dana Tahun 2</th>
                    <th scope="col" width="150px">Dana Tahun 3</th>
                    <th scope="col" width="80px">File</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <?php
                    $index = 1;
                    foreach ($mitra as $data) :                        
                    ?>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['nama'] ? $data['nama'] : '-' ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td><?= $data['kelompok'] ? $data['kelompok'] : '-' ?></td>
                    <td><?= $data['dana_tahun_1'] ? number_format($data['dana_tahun_1']) : '-' ?></td>
                    <td><?= $data['dana_tahun_2'] ? number_format($data['dana_tahun_2']) : '-' ?></td>
                    <td><?= $data['dana_tahun_3'] ? number_format($data['dana_tahun_3']) : '-' ?></td>
                    <td>
                        <?php 
                            $sql = "SELECT * FROM mitra_file_pb WHERE mitra_pb_id=".$data['id'];
                            $query = $db->query($sql)->getResultArray();
                            foreach ($query as $dataFile) :
                        ?>
                        <?= $dataFile['file_mitra'] ? '<a href="'. base_url().'/FileController/download/'.$dataFile['file_mitra'].'">
                        <button class="btn btn-sm btn-danger"><i class="fa fa-file-pdf"></i>
                        Download</button></a>' : '-' ?><br/><br/>
                        <?php endforeach;; ?>
                    </td>                                        
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <!-- End Table Mitra -->    

    <?php 
            $sdgs = $db->query('SELECT * FROM sdgs WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($sdgs) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                SDGs
            </div>
        </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="50px" style="text-align: center">#</th>
                    <th scope="col" width="300px">SDGs Terkait`</th>
                    <th scope="col" width="500px">Uraian Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach ($sdgs as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['sdgs'] ? $data['sdgs'] : '-' ?></td>
                    <td><?= $data['kegiatan'] ? $data['kegiatan'] : '-' ?></td>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <!-- End Table SDGs -->

    <?php 
            $iku = $db->query('SELECT * FROM iku WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($iku) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                IKU
            </div>
        </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="50px" style="text-align: center">#</th>
                    <th scope="col" width="300px">Indikator IKU Terkait`</th>
                    <th scope="col" width="300x">Uraian IKU</th>
                    <th scope="col" width="300px">Uraian Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach ($iku as $data) :
                    ?>
                <tr>                    
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['indikator'] ? $data['indikator'] : '-' ?></td>
                    <td><?= $data['uraian'] ? $data['uraian'] : '-' ?></td>
                    <td><?= $data['kegiatan'] ? $data['kegiatan'] : '-' ?></td>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <!-- End Table IKU -->

        <?php 
            $rab = $db->query("SELECT * FROM rab_pb WHERE dosen_id=".$dosen_id." AND pengabdian_id=".$pengabdianID)->getResultArray(); 
            $rab_detail = $db->query("SELECT * FROM rab_pb r INNER JOIN rab_detail_pb rd ON r.id=rd.rab_id WHERE r.dosen_id=".$dosen_id." AND r.pengabdian_id=".$pengabdianID)->getResultArray(); 
            if ($rab) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                Rencana Anggaran Biaya
            </div>
        </div>
<?php
        foreach ($rab as $qry) :
        $tahun = $qry['tahun'];
    ?>
    Tahun ke - <?= $qry['tahun'] ?>     
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="250px">Kelompok</th>
                    <th scope="col" width="250px">Komponen</th>
                    <th scope="col" width="300px">Item</th>
                    <th scope="col" width="150px">Satuan</th>
                    <th scope="col" width="80px">Harga</th>
                    <th scope="col" width="80px">Volume</th>
                    <th scope="col" width="80px">Total</th>
                    <th scope="col" width="50px">URL HPS</th>
                    <th scope="col" width="50px"></th>
                </tr>
                    <?php 
                        $totalTahun=0;
                        $index = 1;
                        foreach ($rab_detail as $data) :                            
                            if ($data['tahun']==$qry['tahun']) :
                    ?>
            </thead>
                 <tbody>
                    <td style="text-align: center"><?= $index ?></td>

                    <?php                        
                        $query="SELECT * FROM rab_kelompok_pb WHERE id=". $data['rab_kelompok_id']; 
                        $rabDetail = $db->query($query)->getResultArray();
                        foreach ($rabDetail as $rd) :
                    ?>
                    <td><?= $rd['name'] ? $rd['name'] : '-' ?></td>
                    <?php endforeach ?>
                    
                    <?php 
                        $query="SELECT * FROM rab_komponen_pb WHERE id=". $data['rab_komponen_id']; 
                        $rabDetail = $db->query($query)->getResultArray();
                        foreach ($rabDetail as $rd) :
                            ?>
                    <td><?= $rd['name'] ? $rd['name'] : '-' ?></td>
                    <?php endforeach ?>
                    
                    <td><?= $data['item'] ? $data['item'] : '-' ?></td>
                    
                    <?php 
                        $query="SELECT * FROM rab_satuan WHERE id=". $data['rab_satuan_id']; 
                        $rabDetail = $db->query($query)->getResultArray();
                        foreach ($rabDetail as $rd) :
                            ?>
                    <td><?= $rd['name'] ? $rd['name'] : '-' ?></td>
                    <?php endforeach ?>
                    
                    <td><?= $data['harga'] ? number_format($data['harga']) : '-' ?></td>
                    <td><?= $data['volume'] ? number_format($data['volume']) : '-' ?></td>
                    <td><?= $data['total'] ? number_format($data['total']) : '-' ?></td>
                    <td><?= $data['url_'] ? '<a href="'.$data['url_'].'" target="_blank">Lihat</a>' : '-' ?></td>
            <?php $totalTahun=$totalTahun+$data['total']; $index++; endif; 
        endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="mb-3"><b>Total Biaya Tahun ke- <?= $tahun ?> : <?= number_format($totalTahun) ?></b></div>

    <?php           
        endforeach;
    ?>
    <hr/>
    <?php endif; ?>

    <?php 
            $pendukung = $db->query('SELECT * FROM pendukung WHERE dosen_id='.$dosen_id.' AND pengabdian_id='.$pengabdianID)->getResultArray(); 
            if ($pendukung) :
        ?>
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                File Pendukung
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="500px">Jenis</th>
                    <th scope="col" width="500px">File</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <?php
                    $index = 1;
                    foreach ($pendukung as $data) :                        
                    ?>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['jenis'] ? $data['jenis'] : '-' ?></td>
                    <td>
                        <?= $data['file_'] ? '<a href="'. base_url().'/FileController/download/'.$data['file_'].'">
                        <button class="btn btn-sm btn-danger"><i class="fa fa-file-pdf"></i>
                        Download</button></a>' : '-' ?><br/><br/>
                    </td>                                        
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <!-- End Table Pendukung -->    

    <div class="col-6">
            <div class="input-group-prepend">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="usulan" onclick="usulan()" >
                    <label class="form-check-label" for="isFile">
                        <b style="color:red">PERSETUJUAN USULAN PENGABDIAN </b>
                    </label>
                </div>
            </div>
            <div id="yesno" hidden>
                <a href="<?= '/user/pbsetuju/'.$pengabdianID.'/'.$dosen_id ?>" class="btn btn btn-info shadow ml-4 mt-2 mb-4">Klik disini untUk SETUJU</a>                    
                <a href="<?= '/user/pbditolak/'.$pengabdianID.'/'.$dosen_id ?>" class="btn btn btn-danger shadow ml-4 mt-2 mb-4">Klik disini untUk MENOLAK</a>                    
            </div>
        </div>
    </div>
    
    <form method="post" action="<?= base_url() ?>/user/plpb/<?= $dosen_id ?>">
        <?= csrf_field() ?>
        <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">Kembali ke List</button>
    </form>
    <?php endforeach ?>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>