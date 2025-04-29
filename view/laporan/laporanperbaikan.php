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

    <title>APS RESERVASI </title>

    <?php include "../../template/header.php"; ?>

</head>

<body>
    <?php
    //bikin alert
    // $_SESSION['status'] = "berhasil";
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

    <!-- <select name="filter" id="">
        <option value=""></option>
    </select> -->
    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">LAPORAN FILTER PERBAIKAN </h1>
            <div class="card">
                <div class="card-body">

                    <?php
                    if ($_SESSION['fk_role'] == 'admin') {
                        echo '
                  <form target="_blank" action="' . BASE_URL . '/print/perbaikanByDate.php" method="post">
                    <div class="row">
                        <label for="" class="col-sm-3">Status Perbaikan</label>
                        <label class="col-sm-2 control-label" for="">Dari</label>
                        <label class="col-sm-2 control-label" for="">Sampai</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <select name="status" class="form-control col" id="">
                                <option value="semua">semua</option>
                                <option value="pending">Pending</option>
                                <option value="sudah diperbaiki">Sudah diperbaiki</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" value="' . date('Y-m-d') . '" name="tgl1" class="form-control col">
                        </div>
                        <div class="col-md-2">
                            <input type="date" value="' . date('Y-m-d') . '" name="tgl2" class="form-control col">
                        </div>
                    </div>
                    <input class="btn btn-success" type="submit" value="print">
         </form>';
                    } else {
                        echo '';
                    }
                    ?>
                    </script>
                    <center><a href="updateReserv.php;"></a></center>
                    <?php include '../../template/footer.php'; ?>
</body>

</html>
<style>
    .table-container {
        max-height: 800px;
        /* Adjust the maximum height as needed */
        overflow-y: auto;
    }
</style>