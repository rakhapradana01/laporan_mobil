<?php
require_once('../../function/helper.php');

include '../../function/koneksi.php';


$page = isset($_GET['page']) ? ($_GET['page']) : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah data perbaikan</title>

    <?php include "../../template/header.php"; ?>


    <!-- css -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-primary alert-dismissible fade show" style="z-index: 1;position:absolute;transform: translate(-50%, -50%);  top: 10%;
        left: 50%;" role="alert">
              <span>' . $_SESSION['status'] . '</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    unset($_SESSION['status']);

    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    ?>

    
   <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Perbaikan</h1>
            <div class="card">
                <div class="card-body">
                    <a href="<?= BASE_URL ?>/view/perbaikan/perbaikan.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
                    <form action="<?= BASE_URL ?>/process/add/process_tambahperbaikan.php" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Pelapor</label>
                            <input type="hidden" class="form-control" id="" aria-describedby="" name="thisLink">
                            <select name="nama_pelapor" id="nama" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <?php
                                $sql_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));
                                while ($data_pegawai = mysqli_fetch_array($sql_pegawai)) {
                                    echo '<option value="' . $data_pegawai['Nama'] . '">' . $data_pegawai['Nama'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nik</label>
                            <select name="id_nik" id="id_nik" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <?php
                                include 'function/koneksi.php';
                                $sql_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));
                                while ($data_pegawai = mysqli_fetch_array($sql_pegawai)) {
                                    echo '<option value="' . $data_pegawai['id_nik'] . '">' . $data_pegawai['id_nik'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Devisi</label>
                            <select name="devisi" id="devisi" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <?php
                                include 'function/koneksi.php';
                                $sql_devisi = mysqli_query($koneksi, "SELECT * FROM devisi") or die(mysqli_error($koneksi));
                                while ($data_devisi = mysqli_fetch_array($sql_devisi)) {
                                    echo '<option value="' . $data_devisi['id_devisi'] . '">' . $data_devisi['devisi'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Plat Nomer</label>
                            <select name="plat_nomer" id="plat nomer" class="form-control" required>
                                <option value="">--pilih--</option>
                                <?phP
                                $sql_mobil = mysqli_query($koneksi, "SELECT * FROM mobil") or die(mysqli_error($koneksi));
                                while ($data_mobil = mysqli_fetch_array($sql_mobil)) {
                                    echo '<option value="' . $data_mobil['plat_nomer'] . '">' . $data_mobil['plat_nomer'] . '</option>
                                     ';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tujuan terakhir</label>
                            <input type="text" name="tujuan_terakhir" class="form-control" required>
                            <!-- <select name="tujuan_terakhir" id="tujuan_terakhir" class="form-control" require>
                                <option value="">--Pilih--</option>
                                <?php
                                // include 'function/koneksi.php';
                                // $sql = mysqli_query($koneksi, "SELECT * FROM reserv") or die(mysqli_error($koneksi));
                                // while ($data = mysqli_fetch_array($sql)) {
                                //     echo '<option value="' . $data['Tujuan'] . '">' . $data['Tujuan'] . '</option>';
                                // }
                                ?>
                            </select> -->
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal pengajuan</label>
                            <input type="datetime-local" class="form-control" id="" aria-describedby="" name="tgl" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">deskripsi</label>
                            <!-- <input type="text-area" class="form-control" id="" aria-describedby="" name="deskripsi" required> -->
                            <textarea class="form-control" name="deskripsi"  id=""></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="" class="form-control" required>
                                <option value="">--pilih--</option>
                                <option value="pending">pending</option>
                                <option value="sudah diperbaiki">sudah diperbaiki</option>
                            </select>
                        </div>
                </div>
            </div>
            </div>
            </div>
            <input type="submit" value="Ajukan" class="btn btn-success m-3">
            </form>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
    </div>
    </div>




</body>

</html>