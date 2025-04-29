<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$page = isset($_GET['page']) ? ($_GET['page']) : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>APS RESERVASI</title>

    <?php include "../../template/header.php"; ?>

</head>

<body>
    <?php
    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" style="z-index: 1;position:absolute;transform: translate(-50%, -50%);  top: 10%;
         left: 50%;" role="alert">
               <span>' . $_SESSION['status'] . '</span>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>';
    }
    unset($_SESSION['status']);

    ?>
    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">LAPORAN FILTER PEGAWAI </h1>
            <div class="card">
                <div class="card-body">
                    <!-- <hr>
                    <a href="<?php BASE_URL ?>addpegawai.php"><button class="btn btn-success">Tambah Pegawai</button></a> -->
                    <!-- <a href="print/printPegawai.php"><button class="btn btn-info">Print</button></a> -->
                    <form target="_blank" action="<?= BASE_URL ?>/print/filterPegawai.php" method="post">

                        <div class="row">
                            <label for="" class="form-label col-md-3">Devisi</label>
                            <label for="" class="form-label col-md-3">Jabatan</label>
                            <label class="col-md-3 control-label" for="">Role</label>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <select name="devisi" id="devisi" class="form-control col-md-12" required>
                                    <option value="semua">semua</option>
                                    <?php
                                    $sql_devisi = mysqli_query($koneksi, "SELECT * FROM devisi") or die(mysqli_error($koneksi));
                                    while ($data_devisi = mysqli_fetch_array($sql_devisi)) {
                                        echo '<option value="' . $data_devisi['id_devisi'] . '">' . $data_devisi['devisi'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="Jabatan" id="Jabatan" class="form-control" required>
                                    <option value="semua">semua</option>
                                    <option value="Staff">Staff</option>
                                    <option value="SPV">SPV</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="role" id="role" class="form-control" required>
                                    <option value="semua">semua</option>
                                    <?php
                                    include 'function/koneksi.php';
                                    $sql_role = mysqli_query($koneksi, "SELECT * FROM role") or die(mysqli_error($koneksi));
                                    while ($data_role = mysqli_fetch_array($sql_role)) {
                                        echo '<option value="' . $data_role['id_role'] . '">' . $data_role['role'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input class="btn btn-success mt-3" type="submit" value="print">
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include '../../template/footer.php'; ?>
</body>

</html>