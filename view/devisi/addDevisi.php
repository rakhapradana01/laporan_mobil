<?php
require_once('../../function/helper.php');
include '../../function/koneksi.php';

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
            <h1 class="h3 mb-4 text-gray-800">Data Devisi</h1>
            <div class="card">
                <div class="card-body">
            <a href="<?php BASE_URL ?>devisi.php"><button class="btn btn-danger">Kembali</button></a>
            <hr>
            <form action="<?= BASE_URL ?>/process/add/process_tambahdevisi.php" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID Devisi</label>
                    <input type="text" class="form-control" id="" aria-describedby="" name="id_devisi" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Devisi</label>
                    <input type="text" class="form-control" id="" aria-describedby="" name="devisi" required>
                </div>
                <input type="submit" value="Simpan" class="btn btn-success">
            </form>
        </div>
        <?php include '../../template/footer.php'; ?>
    </div>
    </div>




</body>

</html>