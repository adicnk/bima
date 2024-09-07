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
            
                <form method="post" action="<?= base_url() ?>/submit/penelitian" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group">                        
                        <div class="accordion mt-2" id="accordion">
                            <div class="card-body">
                                <div class="form-row align-items-right mt-3">
                                    <div class="col-12">
                                        <div class="input-group-prepend">            
                                            <div class="input-group-text"><strong>Judul<br>Penelitian</strong></div>
                                            <textarea class="form-control" name="judulPenelitian" id="judulPenelitian" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row align-items-right mt-3">
                                    <div class="col-2">
                                        <div class="input-group-prepend">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="isFile" id="isFile" onclick="myFile()">
                                                <label class="form-check-label" for="isFile">
                                                    File Upload
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

        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>