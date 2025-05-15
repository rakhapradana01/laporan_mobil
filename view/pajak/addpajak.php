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

    <title>APS RESERVASI</title>

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
            <h1 class="h3 mb-4 text-gray-800">Data Pajak</h1>
            <div class="card">
                <div class="card-body">
                    <a href="pajak.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
                    <form action="<?= BASE_URL ?>/process/add/process_tambahpajak.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="" class="form-label">Plat Nomer</label>
                            <select name="plat_nomer" class="form-control" require>
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
                            <label for="" class="form-label">Status pembayaran</label>
                            <select name="statuspemba" class="form-control" required>
                                <option value="">--pilih--</option>
                                <option value="tahunan">tahunan</option>
                                <option value="5 tahun">5 Tahun</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="" aria-describedby="" name="foto" >
                        </div>
                        <input type="submit" value="Simpan" class="btn btn-success">
                </div>
            </div>
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