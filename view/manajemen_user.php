<?php
require_once('../function/helper.php');
require_once('../function/koneksi.php');
$page = 'laporan';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>APS RESERVASI</title>

    <!-- Custom fonts for this template-->
    <?php include "../template/header.php"; ?>

</head>

<body>
    <?php
    include '../template/sidebar.php';
    include '../template/topbar.php';
    // $sidebar = '../template/sidebar.p7hp';
    // $topbar = '../template/topbar.php';
    // if ($_SESSION['fk_role'] !== 'admin') {
    //     // header("location: " . BASE_URL . '/view/dashboard.php?page=user');
    //     // exit();
    // }
    // if (file_exists($sidebar) && file_exists($topbar)) {
    // } else {
    //     echo "404";
    // }
    $mobil = mysqli_query($koneksi, "select count(plat_nomer) from mobil");
    $jumlahMobil = mysqli_fetch_array($mobil)[0];

    $reserv = mysqli_query($koneksi, "select count(id_reserv) from reserv");
    $jumlahreserv = mysqli_fetch_array($reserv)[0];

    $pegawai = mysqli_query($koneksi, "select count(id_nik) from pegawai");
    $jumlahpegawai = mysqli_fetch_array($pegawai)[0];

    $status = mysqli_query($koneksi, "select count(status) from reserv");
    $jumlahstatus = mysqli_fetch_array($status)[0];

    if (!empty($_SESSION['Nik'])) {
       echo "
         <script type='text/javascript'>
                swal({
                    title: 'Informasi',
                    text: 'Login Berhasil',
                    icon: 'success',
                    button: 'OK',
                });
         </script>";
    }
    unset($_SESSION['Nik']);

    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <span style="margin: auto;  width: 27%;"><h2>MANAJEMEN USER</h2></span>
        </div>
      
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
             
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="<?= BASE_URL ?>/view/devisi/devisi.php">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Devisi
                                </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="<?= BASE_URL ?>/view/pegawai/pegawai.php">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Pegawai
                                </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="<?= BASE_URL ?>/view/user/user.php">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Role
                                </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Pending Requests Card Example -->
           
        </div>

    </div>
    <!-- /.container-fluid -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../js/script.js"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>