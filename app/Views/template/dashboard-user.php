<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BP3MI - User</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/admin_assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-text mx-3">
                    <img src="<?= base_url() ?>/favicon.ico" alt="main_logo" style="width:40%">
                    BP3MI
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span> Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseIndex" aria-expanded="true" aria-controls="collapseIndex">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>Input</span>
                </a>
                <div id="collapseIndex" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?= user()->dosen_id ? '' : '<a class="collapse-item" href="'.base_url().'/addDosen" >Profile</a>'; ?>
                        <?= user()->dosen_id ? '<a class="collapse-item" href="'.base_url().'/addPenelitian">Penelitian</a>' : ''; ?>
                        <?= user()->dosen_id ? '<a class="collapse-item" href="'.base_url().'/addPengabdian">Pengabdian</a>' : ''; ?>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


       <?= user()->dosen_id ? '
            <!-- Heading -->
            <div class="sidebar-heading">
                List
            </div>

            <li class="nav-item">
                <a class="nav-link" href="'.base_url().'/listPenelitian">
                    <i class="fas fa-fw fa-flask"></i>
                    <span>Penelitian</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="'.base_url().'/listPengabdian">
                    <i class="fas fa-fw fa-flask"></i>
                    <span>Pengabdian</span></a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">
            ' : '' ?>
            
            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>/logout">
                    <i class="fas fa-fw fa-stop-circle"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <?= $this->renderSection('content'); ?>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>PPNI JABAR &copy; <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/admin_assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/admin_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/admin_assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url() ?>/admin_assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="admin_assets/js/demo/chart-area-demo.js"></script>
    <script src="../admin_assets/js/chart-pie-demo.js"></script> -->

    <script src="<?= base_url() ?>/admin_assets/js/keystroke.js"></script>
    <script src="<?= base_url() ?>/admin_assets/js/file.js"></script>
    <script src="<?= base_url() ?>/admin_assets/js/bs-custom-file-input.js"></script>

</body>

</html>