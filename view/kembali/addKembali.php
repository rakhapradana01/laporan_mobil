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
            <h1 class="h3 mb-4 text-gray-800">Data Kembali</h1>
            <div class="card">
                <div class="card-body">
                    <a href="<?= BASE_URL ?>/view/kembali/kembali.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
                    <form action="<?= BASE_URL ?>/process/add/process_tambahreserv.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="" class="form-label">NIK</label>
                            <select name="id_nik" id="id_nik" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <?php
                                $sql_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));
                                while ($data_pegawai = mysqli_fetch_array($sql_pegawai)) {
                                    echo '<option value="' . $data_pegawai['id_nik'] . '">' . $data_pegawai['id_nik'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" name="Tujuan" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Reservasi yang dipilih</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <option value="Dalam">Dalam</option>
                                <option value="Luar">Luar</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Plat Nomer</label>
                            <select name="plat_nomer" id="plat_nomer" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <?php
                                $sql_mobil = mysqli_query($koneksi, "SELECT * FROM mobil WHERE jumlah != 0") or die(mysqli_error($koneksi));
                                while ($data_mobil = mysqli_fetch_array($sql_mobil)) {
                                    echo '<option value="' . $data_mobil['plat_nomer'] . '">' . $data_mobil['plat_nomer'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Gambar Mobil</label>
                            <img id="car_image" src="" alt="Gambar Mobil" style="display:none; width:300px;">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Waktu Keluar</label>
                            <input type="datetime-local" class="form-control" name="WaktuOut" required>
                        </div>

                        <input type="submit" value="Simpan" class="btn btn-success m-3">
                    </form>
            </div>

    </div>
    <?php include '../../template/footer.php'; ?>
    </div>
    </div>

</body>

<script>
        document.getElementById('plat_nomer').addEventListener('change', function() {
            var plat_nomer = this.value;
            if (plat_nomer !== "") {
                fetch("<?= BASE_URL ?>/view/reservasi/get_car_image.php?plat_nomer=" + plat_nomer)
                    .then(response => response.json())
                    .then(data => {
                        var carImage = document.getElementById('car_image');
                        if (data.foto) {
                            carImage.src = "<?= BASE_URL ?>/img/mobil/" + data.foto;
                            carImage.style.display = 'block';
                        } else {
                            carImage.style.display = 'none';
                        }
                    });
            } else {
                document.getElementById('car_image').style.display = 'none';
            }
        });
    </script>

</html>