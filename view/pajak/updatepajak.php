<?php
include '../../function/koneksi.php';
include '../../function/helper.php';
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

    $no = 1;
    $id = $_GET['id'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from pajak join mobil on mobil.plat_nomer=pajak.plat_nomer where id='$id'"));

    ?>
    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Pajak</h1>
            <div class="card">
                <div class="card-body">
                    <!-- <hr> -->
                    <a href="<?= BASE_URL ?>/view/pajak/pajak.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
            <form action="<?= BASE_URL ?>/process/update/process_editpajak.php" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="" aria-describedby="" name="id" value="<?= $data['id']; ?>" required>
                <div class="mb-3">
                    <label for="" class="form-label">No Plat</label>
                    <!-- id_mobil_user digunakan untuk mengubah jumlah mobil untuk user -->
                    <input type="hidden" class="form-control" id="Plat_nomer" aria-describedby="" value="<?= $data['plat_nomer']; ?>" name="id_mobil_user" required>
                    <br>
                    <select name="plat_nomer" id="" class="form-control" <?= $_SESSION['disabled'] ?> required>
                        <option value="<?= $data['plat_nomer']; ?>"><?= $data['plat_nomer']; ?></option>
                        <?php
                        $sql_mobil = mysqli_query($koneksi, "SELECT DISTINCT plat_nomer FROM mobil WHERE jumlah!=0") or die(mysqli_error($koneksi));
                        while ($data_mobil = mysqli_fetch_array($sql_mobil)) {
                            if ($data['plat_nomer'] != $data_mobil['plat_nomer']) {
                                echo '<option value="' . $data_mobil['plat_nomer'] . '">' . $data_mobil['plat_nomer'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Status pembayaran</label>
                    <select name="statuspemba" class="form-control <?= $_SESSION['disabled'] ?>" required>
                        <!-- <option value="<?= $data['statuspemba']; ?>"><?= $data['statuspemba']; ?></option> -->
                        <?php
                        if ($data['statuspemba'] == 'tahunan') {
                            echo '<option value="tahunan" selected>tahunan</option>';
                            echo '<option value="5 tahun">5 Tahun</option>';
                        } else {
                            echo '<option value="tahunan">tahunan</option>';
                            echo '<option value="5 tahun" selected>5 Tahun</option>';
                        }
                        ?>
                    </select>
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