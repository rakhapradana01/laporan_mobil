<?php
include '../../function/koneksi.php';
include '../../function/helper.php';
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

    $no = 1;
    $id = $_GET['id'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from asuransi join mobil on mobil.plat_nomer=asuransi.plat_nomer"));

    ?>
    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Asuransi</h1>
            <div class="card">
                <div class="card-body">
                    <!-- <hr> -->
                    <a href="<?= BASE_URL ?>/view/asuransi/asuransi.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
            <form action="<?= BASE_URL ?>/process/update/process_editasuransi.php" method="post">
                <div>
                    <div class="mb-3">
                        <label for="" class="form-label">No Plat</label>
                        <br>
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <select name="plat_nomer" id="" class="form-control" <?= $_SESSION['disabled'] ?> required>
                            <option value="<?= $data['plat_nomer']; ?>"><?= $data['plat_nomer']; ?></option>
                            <?php
                            $sql_mobil = mysqli_query($koneksi, "SELECT DISTINCT plat_nomer FROM mobil") or die(mysqli_error($koneksi));
                            while ($data_mobil = mysqli_fetch_array($sql_mobil)) {
                                if ($data['plat_nomer'] != $data_mobil['plat_nomer']) {
                                    echo '<option value="' . $data_mobil['plat_nomer'] . '">' . $data_mobil['plat_nomer'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="" aria-describedby="" name="tgl_awal" required value="<?= $data['tgl_awal'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="" aria-describedby="" name="tgl_akhir" required value="<?= $data['tgl_awal'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Asuransi</label>
                        <select name="Jenis" class="form-control <?= $_SESSION['disabled'] ?>" required>
                            <?php
                            if ($data['Jenis'] == 'Luar') {
                                echo '<option value="Luar" selected>Luar</option>';
                                echo '<option value="Dalam">Dalam</option>';
                            } else {
                                echo '<option value="Luar">Luar</option>';
                                echo '<option value="Dalam" selected>Dalam</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Status Pembayaran</label>
                        <input type="text" class="form-control" id="" aria-describedby="" name="statuspem" required value="<?= $data['statuspem'] ?>">
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
        </div>
        </div>
        <?php include '../../template/footer.php'; ?>
    </div>
    </div>




</body>

</html>