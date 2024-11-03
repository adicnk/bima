<?= $this->extend('template/dashboard-user') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

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

    <!-- Nested Row within Card Body -->
    <div class="card o-hidden border-0 bg-light">
        <div class="card-block">
            <div class="card-text text-center">
            
                <?php foreach ($data as $dt) : ?>
                <form method="post" action="<?= base_url() ?>/submitedit/pengabdian/<?= $dt['id']?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group">                        
                        <div class="accordion mt-2" id="accordion">
                            <div class="card-body">

                                <div class="form-row align-items-right mt-3"></div>
                                <div class="col-12 h5 mb-3 text-gray-800"><center><strong>Data Pengabdian</strong></center></div>
                                <div class=" form-row align-items-right mt-3"><hr/></div>

                                <div class="form-row align-items-right mt-3">
                                    <div class="col-12">
                                        <div class="input-group-prepend">            
                                            <div class="input-group-text"><strong>Judul<br>Pengabdian</strong></div>
                                            <textarea class="form-control" name="judulPengabdian" id="judulPengabdian" rows="4"><?=$dt['judul']?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row align-items-right mt-3">
                                    <div class="col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><strong>Bidang Fokus</strong></div>
                                            <select class="form-control" name="bidangFokus" id="bidangFokus" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                                <option value="Kemandirian Kesehatan" <?= $dt['bidang_fokus']=="Kemandirian Kesehatan" ? "selected":"" ?>>Kemandirian Kesehatan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row align-items-right mt-3">
                                    <div class="col-8">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><strong>Kelompok Skema</strong></div>
                                            <select class="form-control" name="kelompokSkema" id="kelompokSkema" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                                <option value="Pemberdayaan Berbasis Masyarakat" <?= $dt['skema']=="Pemberdayaan Berbasis Masyarakat" ? "selected" : "" ?>>Pemberdayaan Berbasis Masyarakat</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row align-items-right mt-3">
                                    <div class="col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><strong>Ruang Lingkup</strong></div>
                                            <select class="form-control" name="ruangLingkup" id="ruangLingkup" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                                <option value="Pengabdian Masyarakat Pemula" <?= $dt['ruang_lingkup']=="Pengabdian Masyarakat Pemula" ? "selected" : "" ?>>Pengabdian Masyarakat Pemula</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-row align-items-right mt-3">
                                    <div class="col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><strong>Tahun Usulan</strong></div>
                                            <input type="text" name="tahunUsulan" id="tahunUsulan" class="form-control" placeholder="Masukkan Tahun Usulan ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return placeDateOnly(event);" value="<?= $dt['tahun_usulan']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-row align-items-right mt-3">
                                    <div class="col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><strong>Tahun Pelaksanaan</strong></div>
                                            <input type="text" name="tahunPelaksanaan" id="tahunPelaksanaan" class="form-control" placeholder="Masukkan Tahun Pelaksanaan ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return placeDateOnly(event);" value="<?= $dt['tahun_pelaksanaan'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class=" form-row align-items-right mt-3">
                                    <div class="col-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><strong>Lama Kegiatan</strong></div>
                                            <input type="text" name="lamaKegiatan" id="lamaKegiatan" class="form-control" placeholder="Masukkan Lama Kegiatan ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return placeDateOnly(event);" value="<?= $dt['lama'] ?>">
                                            <div class="input-group-text">bulan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row align-items-right mt-3">
                                    <div class="col-8">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><strong>Rumpun Ilmu Level 2</strong></div>
                                            <select class="form-control" name="rumpunIlmu" id="rumpunIlmu" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                                <option value="Ilmu Keperawatan dan Kebidanan" <?= $dt['rumpun_ilmu']=="Ilmu Keperawatan dan Kebidanan" ? "selcted" : "" ?>>Ilmu Keperawatan dan Kebidanan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row align-items-right mt-3"></div>
                                <hr/>
                                <div class="form-row align-items-right mt-3"></div>
                                <div class="col-12 h5 mb-3 text-gray-800"><center><strong>Upload File</strong></center></div>
                                <div class=" form-row align-items-right mt-3">                        
                                    
                                    <div class="col-2">
                                        <div class="input-group-prepend">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="isFile" id="isFile" onclick="myFile()">
                                                <label class="form-check-label" for="isFile">
                                                    Jika ada file baru
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-row align-items-right mt-3">
                                    <div class="col-7">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="fileUpload" id="fileUpload" disabled>
                                            <label class="custom-file-label" for="fileUpload">Upload File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row align-items-right mt-3"></div>
                    <hr/>
                    <div class="form-row align-items-right mt-3"></div>

                    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">SIMPAN</button>
                    <a href="<?= base_url() ?>/" class="btn btn-lg btn-danger btn-block mt-3">CANCEL</a>

                </form>
                <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>