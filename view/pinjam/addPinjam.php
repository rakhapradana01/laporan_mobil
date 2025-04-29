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

    <title>DATA RESERV</title>

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
            <h1 class="h3 mb-4 text-gray-800">Data Pinjam</h1>
            <div class="card">
                <div class="card-body">
                    <a href="<?= BASE_URL ?>/view/pinjam/pinjam.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
                    <form action="<?= BASE_URL ?>/process/add/process_tambahPinjam.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="" class="form-label">NIK</label>
                            <select name="id_nik" id="id_nik" class="form-control" require>
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
                            <label for="" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" id="" aria-describedby="" name="Tujuan" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Reservasi yang dipilih</label>
                            <select name="status" id="status" class="form-control" require>
                                <option value="">--Pilih--</option>
                                <option value="Dalam">Dalam</option>
                                <option value="Luar">Luar</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Plat Nomer</label>
                            <select name="plat_nomer" id="plat nomer" class="form-control" require>
                                <option value="">--Pilih--</option>
                                <?phP
                                $sql_mobil = mysqli_query($koneksi, "SELECT * FROM mobil WHERE jumlah!=0") or die(mysqli_error($koneksi));
                                while ($data_mobil = mysqli_fetch_array($sql_mobil)) {
                                    echo '<option value="' . $data_mobil['plat_nomer'] . '">' . $data_mobil['plat_nomer'] . '</option>
                                     ';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Waktu Keluar</label>
                            <input type="datetime-local" class="form-control" id="" aria-describedby="" name="WaktuOut" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Km Keluar</label>
                            <input type="text" class="form-control" id="" aria-describedby="" name="KmOut" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Foto Keluar</label>
                            <input type="file" class="form-control" id="" aria-describedby="" name="fotoout" required>
                        </div>
                </div>
            </div>
            <input type="submit" value="Simpan" class="btn btn-success m-3">
            </form>
        </div>

    </div>
    <?php include '../../template/footer.php'; ?>
    </div>
    </div>

</body>

</html>