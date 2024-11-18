<?= $this->extend('template/dashboard-admin') ?>

<?= $this->section('content') ?>

<?php $db = \Config\Database::connect(); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="mt-3">
        <hr>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800"> <?= $title ?></h1>
    </div>
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
                    <th scope="col" width ="50px" style="text-align: center">#</th>
                    <th scope="col" width="200px">Username</th>
                    <th scope="col" width="200px">Email</th>
                    <th scope="col" width="200px" style="text-align: center">Peneliti</th>
                    <th scope="col" ></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $index = 1 + (5 * ($currentPage - 1));
                    foreach ($users as $data) :
                    ?>
                <tr>
                    <td style="text-align: center"><?= $index ?></td>
                    <td><?= $data['username'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td style="text-align: center"><?= $data['dosen_id']==null ? '<img src="'.base_url().'/icon/not_available.png" class="mr-2" />' : '<img src="'.base_url().'/icon/check.png" class="mr-2" />' ?></td>
                    <td>
                        <a href="<?= '/delete/users/' .$data['id'].'/'.$data['dosen_id'] ?>" title="Delete"><img src="<?= base_url() ?>/icon/delete.png" /></a>
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