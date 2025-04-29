<?php
include '../../function/koneksi.php';
include '../../function/helper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DATA MOBIL</title>


    <?php include "../../template/header.php"; ?>
</head>

<body>
    <?php
    include '../../template/sidebar.php';
    include '../../template/topbar.php';

    $no = 1;
    $id = $_GET['id'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from service join mobil on mobil.plat_nomer=service.plat_nomer where service.id=$id"));

    ?>
   <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Service</h1>
            <div class="card">
                <div class="card-body">
                    <a href="<?= BASE_URL ?>/view/service/service.php"><button class="btn btn-danger">Kembali</button></a>
                    <hr>

            <form action="<?= BASE_URL ?>/process/update/process_editservice.php" method="post">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <div>
                    <div class="mb-3">
                        <label for="" class="form-label">No Plat</label>
                        <br>
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
                        <label for="" class="form-label">Jenis Service</label>
                        <select name="jenis_service" class="form-control <?= $_SESSION['disabled'] ?>" required>
                            <!-- <option value="<?= $data['jenis_service']; ?>"><?= $data['jenis_service']; ?></option> -->
                            <?php
                            if ($data['jenis_service'] == 'Mesin') {
                                echo '<option value="Mesin" selected>Mesin</option>';
                                echo '<option value="Keseluruhan">Keseluruhan</option>';
                            } else {
                                echo '<option value="Mesin">Mesin</option>';
                                echo '<option value="Keseluruhan" selected>Keseluruhan</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-success">
                    </div>
            </div>
            </div>
            </form>
        </div>
        </div>
        </div>
        <?php include '../../template/footer.php'; ?>
    </div>
    </div>




</body>

</html>