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
    <?php

    $no = 1;
    $id = $_GET['id'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select 
    kelayakan.id,
    kelayakan.plat_nomer,
    tipe_mobil,
    merek,
    BBM,
    kerusakan,
    deskripsi,
    status
    from
    kelayakan
    join mobil on mobil.plat_nomer=kelayakan.plat_nomer where kelayakan.id='$id'"));
    //print_r($data)
    ?>
    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Kelayakan</h1>
            <div class="card">
                <div class="card-body">
                    <!-- <hr> -->
                    <a href="<?= BASE_URL ?>/view/kelayakan/kelayakan.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>
                    <form action="<?= BASE_URL ?>/process/update/process_editKelayakan.php" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Plat Nomer</label>
                            <input type="text" class="form-control" id="" aria-describedby="" name="plat_nomer" required value="<?= $data['plat_nomer'] ?>" disabled>
                            <input type="hidden" class="form-control" id="" aria-describedby="" name="id" value="<?= $data['id'] ?>">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">perbaikan dalam 1 minggu</label>
                            <input type="text" class="form-control" id="" aria-describedby="" name="perbaikan" value="<?= $data['kerusakan'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="" cols="30" rows="5"><?= $data['deskripsi'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select name="status" class="form-control <?= $_SESSION['disabled'] ?>" required>
                                <?php
                                if ($data['status'] == 'pergantian') {
                                    echo '<option value="layak">layak</option>';
                                    echo '<option value="pergantian" selected>pergantian</option>';
                                } else {
                                    echo '<option value="layak" selected>layak</option>';
                                    echo '<option value="pergantian">pergantian</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" value="Ajukan" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include '../../template/footer.php'; ?>
    </div>
    </div>




</body>

</html>