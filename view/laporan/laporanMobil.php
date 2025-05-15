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
    unset($_SESSION['status']);
    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    ?>

    <div id="content-wrapper" class="d-flex flex-column mt-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h1 class="h3 mb-4 text-gray-800">LAPORAN FILTER MOBIL</h1>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($_SESSION['fk_role'] == 'admin') {
                                echo '
                                <form target="_blank" action="' . BASE_URL . '/print/filterMobil.php" method="post">
                                    <div class="row">
                                        <label class="col-sm-2">Tipe Mobil</label>
                                        <label class="col-sm-2">Merek Mobil</label>
                                        <label class="col-sm-2">Ketersediaan Mobil</label>
                                        <label class="col-sm-2">Plat Nomer</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select name="tipe" class="form-control col">
                                                <option value="semua">Semua</option>
                                                <option value="MINI BUS">MiniBus</option>
                                                <option value="SEDAN">Sedan</option>
                                                <option value="BUS">Bus</option>
                                                <option value="BOX">Box</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="merek" class="form-control col" required>
                                                <option value="semua">Semua</option>';
                                $sql_merek = mysqli_query($koneksi, "SELECT DISTINCT merek FROM mobil") or die(mysqli_error($koneksi));
                                while ($data = mysqli_fetch_array($sql_merek)) {
                                    echo "<option value='" . $data['merek'] . "'>" . $data['merek'] . "</option>";
                                }
                                echo '
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="sedia" class="form-control col">
                                                <option value="semua">Semua</option>
                                                <option value="ada">Tersedia</option>
                                                <option value="tidak">Tidak Tersedia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="plat_nomer" class="form-control col">
                                                <option value="semua">Semua</option>';
                                $sql_plat = mysqli_query($koneksi, "SELECT DISTINCT plat_nomer FROM mobil") or die(mysqli_error($koneksi));
                                while ($data = mysqli_fetch_array($sql_plat)) {
                                    echo "<option value='" . $data['plat_nomer'] . "'>" . $data['plat_nomer'] . "</option>";
                                }
                                echo '
                                            </select>
                                        </div>
                                    </div>
                                    <input class="btn btn-success mt-3" type="submit" value="Print">
                                </form>';
                            }
                            ?>
                        </div>
                        <hr>
                        </script>
                        <center><a href="updateReserv.php;"></a></center>
                        <?php include '../../template/footer.php'; ?>
</body>

</html>

<style>
    .table-container {
        max-height: 800px;
        overflow-y: auto;
    }
</style>
