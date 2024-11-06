<?= $this->extend('template/dashboard-admin') ?>

<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="mt-3">
        <hr>
    </div>

    <!-- Page Heading -->
    <?php foreach ($dosen as $dsn) : ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800"> <?= $title.$dsn['nama'] ?></h1>
    </div>

    <div class="card bg-info text-white shadow">
        <div class="card-body">
            PENELITIAN
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="600px">Judul</th>
                    <th scope="col" width="250px" style="text-align: center">Bidang Fokus</th>
                    <th scope="col" width="80px" style="text-align: center">Tahun Pelaksanaan</th>
                    <th scope="col" width="80px" style="text-align: center">Status</th>
                    <th scope="col" width="150px" style="text-align: center"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach ($data_penelitian as $data) :
                    ?>
                <tr>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['judul'] ?></td>
                    <td style="text-align: center"><?= $data['bidang_fokus'] ? $data['bidang_fokus'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center"><?= $data['tahun_pelaksanaan'] ? $data['tahun_pelaksanaan'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-info text-white small">usulan</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-primary text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>
                    <td>
                        <a href="<?= '/user/statuspl/' .$data['id'].'/'.$dsn['dosen_id'] ?>" title="View Detail"><img src="<?= base_url() ?>/icon/view.png" /></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>

    <div class="card bg-info text-white shadow">
        <div class="card-body">
            PENGABDIAN
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="600px">Judul</th>
                    <th scope="col" width="250px" style="text-align: center">Bidang Fokus</th>
                    <th scope="col" width="80px" style="text-align: center">Tahun Pelaksanaan</th>
                    <th scope="col" width="80px" style="text-align: center">Status</th>
                    <th scope="col" width="150px" style="text-align: center"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1;
                    foreach ($data_pengabdian as $data) :
                    ?>
                <tr>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['judul'] ?></td>
                    <td style="text-align: center"><?= $data['bidang_fokus'] ? $data['bidang_fokus'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center"><?= $data['tahun_pelaksanaan'] ? $data['tahun_pelaksanaan'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-info text-white small">usulan</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-primary text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>
                    <td>
                        <a href="<?= '/user/statuspb/' .$data['id'].'/'.$data['dosen_id'] ?>" title="View Detail"><img src="<?= base_url() ?>/icon/view.png" /></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <?php endforeach ?>

</div>

<!-- /.container-fluid -->

<?= $this->endSection() ?>