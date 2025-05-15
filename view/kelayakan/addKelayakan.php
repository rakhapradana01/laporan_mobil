<?php
include '../../function/koneksi.php';
include '../../function/helper.php';



$page = isset($_GET['page']) ? ($_GET['page']) : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah data perbaikan</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Data Kelayakan</h1>
                    <div class="card">
                        <div class="card-body">
                            <a href="kelayakan.php"><button class="btn btn-danger">Kembali</button></a>
                            <hr>
                            <form action="<?= BASE_URL ?>/process/add/process_tambahkelayakan.php" method="post">
                                <div class="mb-3">
                                    <label for="" class="form-label">Plat Nomer</label>
                                    <select name="plat_nomer" id="plat nomer" class="form-control" required>
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
                                    <label for="tanggal_service" class="form-label">Tanggal Service</label>
                                    <input type="date" class="form-control" name="tanggal_service" id="tanggal_service"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">konsumsi bbm dalam 1 minggu</label>
                                    <input type="text" class="form-control" id="" aria-describedby=""
                                        name="konsumsi_bbm" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">perbaikan dalam 1 minggu</label>
                                    <input type="text" class="form-control" id="" aria-describedby="" name="perbaikan"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="" cols="30" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" id="" class="form-control" required>
                                        <option value="">--pilih--</option>
                                        <option value="layak">layak</option>
                                        <option value="pergantian">pergantian</option>
                                    </select>
                                </div>
                                <input type="submit" value="Ajukan" class="btn btn-success">
                        </div>
                    </div>
                    </form>
                </div>
                <?php include '../../template/footer.php'; ?>
            </div>
        </div>




</body>

</html>