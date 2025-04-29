<?php
require_once('../../function/helper.php');
include '../../function/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DATA perbaikan</title>
    <?php include "../../template/header.php"; ?>
</head>

<body>
    <?php
    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    ?>
    <?php
    $no = 1;
    $id = $_GET['id'];
    $d = mysqli_fetch_array(mysqli_query($koneksi, "select * from kerusakan where id='$id'"));

    ?>
   <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Perbaikan</h1>
            <div class="card">
                <div class="card-body">
            <!-- <hr> -->
            <a href="perbaikan.php"><button class="btn btn-danger">Kembali</button></a>
            <hr>
            <form action="<?= BASE_URL ?>/process/update/process_editPerbaikan.php" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Pelapor</label>
                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                    <input type="text" class="form-control" id="" aria-describedby="" disabled value="<?= $d['nama_pelapor'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nik</label>
                    <input type="text" class="form-control" id="" aria-describedby="" disabled value="<?= $d['Nik'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Devisi</label>
                    <input type="text" class="form-control" id="" aria-describedby="" disabled value="<?= $d['Devisi'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Plat Nomer</label>
                    <input type="text" class="form-control" id="" aria-describedby="" disabled value="<?= $d['plat_nomer'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal pengajuan</label>
                    <input type="datetime-local" class="form-control" id="" aria-describedby="" disabled value="<?= $d['tgl'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">deskripsi</label>
                    <br>
                    <textarea class="form-control" name="" id="" disabled><?= $d['deskripsi'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <input type="hidden" class="form-control" id="status" aria-describedby="" value="<?= $d['status']; ?>" name="status" required>
                    <br>
                    <select name="status" id="" class="form-control" <?= $_SESSION['disabled'] ?> required>
                        <option value="<?= $d['status']; ?>"><?= $d['status']; ?></option>
                        <?php
                        $sql_kerusakan = mysqli_query($koneksi, "SELECT DISTINCT status FROM kerusakan") or die(mysqli_error($koneksi));
                        while ($d_kerusakan = mysqli_fetch_array($sql_kerusakan)) {
                            if ($d['status'] != $d_kerusakan['status']) {
                                echo '<option value="' . $d_kerusakan['status'] . '">' . $d_kerusakan['status'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
        <?php include '../../template/footer.php'; ?>
    </div>
</body>

</html>