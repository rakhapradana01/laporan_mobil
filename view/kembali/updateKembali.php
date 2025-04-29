<?php
include '../../function/koneksi.php';
include '../../function/helper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Reservasi</title>

    <?php include "../../template/header.php"; ?>
</head>

<body>
    <?php
    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    ?>
    <div id="wrapper">
        <?php

        $no = 1;
        $id_reserv = $_GET['id_reserv'];
        $data = mysqli_fetch_array(mysqli_query($koneksi, "
        select 
            id_reserv,
            Nik,
            Tujuan,
            Pilih_Reserv,
            reserv.Plat_nomer as fk_mobil,
            mobil.plat_nomer as plat_nomer,
            WaktuOut,
            WaktuIn,
            KmOut,
            fotoout,
            KmIn,
            fotoin,
            status
        from 
            reserv 
        join 
            mobil on mobil.plat_nomer=reserv.Plat_nomer 
        where id_reserv=$id_reserv"));
        if ($_SESSION['fk_role'] == 'user') {
            $_SESSION['disabled'] = "disabled";
            if (!empty($data['KmIn'])) {
                $_SESSION['disabled2'] = "disabled";
            } else {
                $_SESSION['disabled2'] = "";
            }
        } else {
            $_SESSION['disabled2'] = "";
            $_SESSION['disabled'] = "";
        }
        // print_r($data);
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
                <form action="<?= BASE_URL ?>/process/update/process_EditReserv.php" method="post" enctype="multipart/form-data">
                    <?php
                    if ($_SESSION['fk_role'] == 'admin') {
                        echo '
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <select name="statusPinjam" class="form-control" required>
                                    <option value=' . $data['status'] . '>' . $data['status'] . '</option>
                                    ';
                        if ($data['status'] != 'ACC') {
                            echo '<option value="ACC">ACC</option>';
                        } else {
                            echo '<option value="PENDING">PENDING</option>';
                        }
                        echo '</select>
                            </div>';
                    }
                    ?>
                    <input type="hidden" class="form-control" id="" aria-describedby="" name="id_reserv" value="<?= $data['id_reserv']; ?>" required>
                    <div class="mb-3">
                        <label for="" class="form-label">Nik</label>
                        <input type="text" class="form-control" disabled id="" aria-describedby="" name="Nik" value="<?= $data['Nik']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tujuan</label>
                        <input type="text" class="form-control" <?= $_SESSION['disabled'] ?> id="" aria-describedby="" name="Tujuan" value="<?= $data['Tujuan']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Reservasi yang dipilih</label>
                        <!-- <input type="text" class="form-control" <?= $_SESSION['disabled'] ?> id="" aria-describedby="" name="Pilih_Reserv" value="<?= $data['Pilih_Reserv']; ?>" required> -->
                        <select name="Pilih_Reserv" class="form-control <?= $_SESSION['disabled'] ?>" required>
                            <option value="<?= $data['Pilih_Reserv']; ?>" selected="selected"><?= $data['Pilih_Reserv']; ?></option>
                            <?php
                            if ($data['Pilih_Reserv'] != "Luar") {
                                echo "<option value='Luar'>Luar</option>";
                            } else {
                                echo "<option value='Dalam'>Dalam</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">No Plat</label>
                        <!-- id_mobil_user digunakan untuk mengubah jumlah mobil untuk user -->
                        <input type="hidden" class="form-control" id="Plat_nomer" aria-describedby="" value="<?= $data['plat_nomer']; ?>" name="id_mobil_user" required>
                        <br>
                        <select name="Plat_nomer" id="" class="form-control" <?= $_SESSION['disabled'] ?> required>
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
                        <input type="hidden" class="form-control" <?= $_SESSION['disabled'] ?> id="" aria-describedby="" name="WaktuOut" value="<?= $data['WaktuOut']; ?>">
                        <input type="hidden" class="form-control" <?= $_SESSION['disabled2'] ?> id="" aria-describedby="" name="KmOut" value="<?= $data['KmOut']; ?>">

                    <div class="mb-3">
                        <label for="" class="form-label">Waktu Masuk</label>
                        <input type="datetime-local" class="form-control" <?= $_SESSION['disabled2'] ?> id="" aria-describedby="" name="WaktuIn" value="<?= $data['WaktuIn']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Km Masuk</label>
                        <input type="text" class="form-control" <?= $_SESSION['disabled2'] ?> id="" aria-describedby="" name="KmIn" value="<?= $data['KmIn']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Foto Masuk</label>
                        <input type="file" class="form-control" <?= $_SESSION['disabled2'] ?> id="" aria-describedby="" name="fotoin" value="<?= $data['fotoin']; ?>">
                    </div>
                    <div class="mb-3">
                    </div>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-success m-3">
                    <!-- <a href="<?php // BASE_URL; 
                                    ?>/view/reservasi/reservasi.php"><button type="button" class="btn btn-danger">Kembali</button></a> -->
                    <!-- <button class="btn btn-danger"><a href="<?php // BASE_URL; 
                                                                    ?>/view/reservasi/reservasi.php">Kembali</a></button> -->
                </form>
            </div>
        </div>
    </div>

    <?php include "../../template/footer.php"; ?>
</body>

</html>

                    