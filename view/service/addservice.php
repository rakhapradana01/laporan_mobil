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

    <title>DATA service</title>

    <?php include "../../template/header.php"; ?>
</head>

<body>
    <?php
    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    ?>

    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Service</h1>
            <div class="card">
                <div class="card-body">
                    <a href="<?= BASE_URL ?>/view/service/service.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
                    <form action="<?= BASE_URL ?>/process/add/process_tambahservice.php" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Plat Nomer</label>
                            <select name="plat_nomer" id="plat nomer" class="form-control" require>
                                <option value="">--Pilih--</option>
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
                            <label for="" class="form-label">Jenis Service</label>
                            <select name="jenis_service" class="form-control" required>
                                <option value="">--pilih--</option>
                                <option value="Mesin">Mesin</option>
                                <option value="Keseluruhan">Keseluruhan</option>
                            </select>
                        </div>
                        <input type="submit" value="Simpan" class="btn btn-success">
                </div>
            </div>
            </form>
        </div>
        <?php include "../../template/footer.php"; ?>
    </div>
    </div>




</body>

</html>