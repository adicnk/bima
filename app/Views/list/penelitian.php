<?= $this->extend('template/dashboard-user') ?>

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
        <h1 class="h3 mb-0 text-gray-800"> <?= $title.' dari '.$dsn['nama'] ?></h1>
    </div>
    <?php endforeach ?>

    <div>
        <div class="row">
            <div class="col"></div>
            <div class="col-4">
                <form action="\user\listPenelitian" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Judul ....." name="keyword">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">#</th>
                    <th scope="col" width="400px">Judul</th>
                    <th scope="col" width="200px">Bidang Fokus</th>
                    <th scope="col" width="80px" style="text-align: center">Tahun Pelaksanaan</th>
                    <th scope="col" width="80px" style="text-align: center">Status Usulan</th>
                    <th scope="col" width="150px" style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1 + (5 * ($currentPage - 1));
                    foreach ($data_penelitian as $data) :
                    ?>
                <tr>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['judul'] ?></td>
                    <td><?= $data['bidang_fokus'] ? $data['bidang_fokus'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center"><?= $data['tahun_pelaksanaan'] ? $data['tahun_pelaksanaan'] : '<img src="../../icon/not_available.png" class="mr-2" />' ?></td>
                    <td style="text-align: center">
                        <?php switch ($data['status']) {
                                case null: echo '<div class="bg-primary text-white small">usulan baru</div>';                                  
                                    break;
                                case 0: echo '<div class="bg-danger text-white small">ditolak</div>';
                                    break;
                                case 1: echo '<div class="bg-success text-white small">disetujui</div>';
                                    break;                                
                        } ?>
                    </td>            
                    <td>
                        <a href="/edit/user/<?// $usr['idx'] . '?url=mahasiswa' ?>" title="Edit Data Penelitian"><img src=" ../../icon/edit.png" class="mr-2" /></a>
                        <a href="/delete/admin/<?// $usr['idx'] . '?url=mahasiswa' ?>" title="Add Support Data"><img src="../../icon/data.png" /></a>
                        <a href="/delete/admin/<?// $usr['idx'] . '?url=mahasiswa' ?>" title="View Detail"><img src="../../icon/view.png" /></a>
                    </td>
                </tr>
            <?php
                $index++;
                endforeach;
            ?>
            </tbody>
        </table>
    </div>

    <?= $pager->links('user', 'custom_pagination') ?>

</div>

<!-- /.container-fluid -->

<?= $this->endSection() ?>