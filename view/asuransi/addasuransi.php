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

    <title>APS RESERVASI </title>

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
            <h1 class="h3 mb-4 text-gray-800">Data Asuransi</h1>
            <div class="card">
                <div class="card-body">
                    <a href="asuransi.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
                    <form action="<?= BASE_URL ?>/process/add/process_tambahasuransi.php" method="post">
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
                            <label for="" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" id="" aria-describedby="" name="tgl_awal" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="" aria-describedby="" name="tgl_akhir" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Asuransi</label>
                            <div class="mb-3">
                                <select name="Jenis" class="form-control" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Luar">Luar</option>
                                    <option value="Dalam">Keseluruhan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Foto Bukti</label>
                            <input type="file" class="form-control" name="gambar" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status Pembayaran</label>
                            <div class="mb-3">
                                <select name="statuspem" class="form-control" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
                                </select>
                            </div>
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