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
    $id_devisi = $_GET['id_devisi'];
    // print_r($id_devisi);
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from devisi where id_devisi='$id_devisi'"));
    //print_r($data)
    ?>
   <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Devisi</h1>
            <div class="card">
                <div class="card-body">
                    
            <a href="devisi.php"><button class="btn btn-danger">Kembali</button></a>
            <hr>
            <form action="<?= BASE_URL ?>/process/update/process_editdevisi.php" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID Devisi</label>
                    <!-- <input type="hidden" class="form-control" id="" aria-describedby=""  name="thisLink"> -->
                    <input type="hidden" class="form-control" id="" aria-describedby="" name="old_id" value="<?= $data['id_devisi']; ?>" required>
                    <input type="text" class="form-control" id="" aria-describedby="" name="id_devisi" value="<?= $data['id_devisi']; ?>" required>

                    <label for="" class="form-label">Devisi</label>
                    <input type="text" class="form-control" id="" aria-describedby="" name="devisi" value="<?= $data['devisi']; ?>" required>
                </div>
                <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
    </div>
    </div>
    <?php include '../../template/footer.php'; ?>

</body>

</html>