<?php
include '../../function/koneksi.php';

if (isset($_GET['plat_nomer'])) {
    $plat_nomer = $_GET['plat_nomer'];

    $query = mysqli_query($koneksi, "SELECT foto FROM mobil WHERE plat_nomer = '$plat_nomer'");
    $data = mysqli_fetch_assoc($query);

    echo json_encode($data);
}
?>
