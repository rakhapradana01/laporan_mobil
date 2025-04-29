<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$plat_nomer = $_POST['plat_nomer'];
$jenis_service = $_POST['jenis_service'];

$query = mysqli_query($koneksi, "INSERT INTO service (plat_nomer, jenis_service) 
VALUES ('$plat_nomer', '$jenis_service')");
if ($query) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/service/service.php");
}

