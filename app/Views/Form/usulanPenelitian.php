<?= $this->extend('template/daftar') ?>
<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<div class="mt-3">
        <hr>
    </div>
    <!-- Page Heading -->
    <div class="mb-2">
        <h1 class="h3 mb-0 text-gray-800"><center><strong><?= $title; ?></strong></center></h1>         
    </div>

    <div class="mt-3">
        <hr>
    </div>

    <!-- Nested Row within Card Body -->
    <div class="card o-hidden border-0 mt-3 bg-light">
        <div class="card-block mt-3">
        <div class="col-2"></div>
        <div class="col">            
            <div class="card-text text-center">
            
                <form method="post" action="../submit/usulanPenelitian">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">                    
                    <div class=" form-row align-items-right mt-3">                    
                    </div>

                        <div class=" form-row align-items-right mt-2">
                            <div class="col-12 h5 mb-3 text-gray-800"><center><strong>Data Usulan</strong></center></div>

                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Judul Penelitian</strong></div>
                                    <input type="text" name="judulPenelitian" id="judulPenelitian" class="form-control" placeholder="Masukkan Judul Penelitian ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('judulPenelitian')?>">                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Kelompok Skema</strong></div>
                                    <select class="form-control" name="skema" id="skema" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                        <option value=1></option>
                                        <option value=2>Riset Dasar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Ruang Lingkup</strong></div>
                                    <select class="form-control" name="ruangLingkup" id="ruangLingkup" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                    <option value=1></option>
                                        <option value=2>Penelitian Dosen Pemula</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Bidang Fokus</strong></div>
                                    <select class="form-control" name="fokus" id="fokus" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                        <option value=1>Kesehatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Tahun Usulan</strong></div>
                                    <input type="text" name="tahunUsulan" id="tahunUsulan" class="form-control" placeholder="Masukkan Tahun Usulan ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('tahnUsulan')?>">
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Tahun Pelaksanaan</strong></div>
                                    <input type="text" name="tahunPelaksanaan" id="tahunPelaksanaan" class="form-control" placeholder="Masukkan Tahun Pelaksanaan ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('tahunPelaksanaan')?>">
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Lama Kegiatan</strong></div>
                                    <input type="text" name="lamaKegiatan" id="lamaKegiatan" class="form-control" placeholder="Masukkan Lama Kegiatan ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('lamaKegiatan')?>">
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Tema Penelitian</strong></div>
                                    <input type="text" name="tema" id="tema" class="form-control" placeholder="Masukkan Tema Penelitian ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('tema')?>">
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Topik Penelitian</strong></div>
                                    <input type="text" name="topik" id="topik" class="form-control" placeholder="Masukkan Topik Penelitian ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('topik')?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-right mt-3">
                            <div class="col-12">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Rumpun Ilmu Level 3</strong></div>
                                    <select class="form-control" name="rumpunIlmu" id="RumpumIlmu" onfocusin="yellowin(this);" onfocusout="whiteout(this)">
                                        <option value=1></option>
                                        <option value=2>Ilmu Keperawatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Target TKT</strong></div>
                                    <input type="text" name="target" id="target" class="form-control" placeholder="Masukkan Target TKT ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('target')?>">
                                </div>
                            </div>
                        </div>
                        <div class=" form-row align-items-right mt-3">
                            <div class="col-6">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><strong>Profil Sinta Ketua</strong></div>
                                    <input type="text" name="sintaKetua" id="sintaKetua" class="form-control" placeholder="Masukkan Target TKT ....." onfocusin="yellowin(this);" onfocusout="whiteout(this)" onkeypress="return alphaOnly(event);" value="<?= old('target')?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-row align-items-right mt-3"></div>
                        <hr/>
                        <div class="form-row align-items-right mt-3"></div>

                    </div>                
                    <button class="btn btn-lg btn-primary btn-block mt-3 mb-4" type="submit">SIMPAN</button>
                </form>
                <a href="../login/fp" class="btn btn-lg btn-danger btn-block mt-3 mb-4">CANCEL</a>
            </div>

        </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>