<?php

require_once('../../function/helper.php');
require_once('../../function/koneksi.php');



$platnomer = $_POST['plat_nomer'];
$perbaikan = $_POST['perbaikan'];
$deskripsi = $_POST['deskripsi'];
$status = $_POST['status'];
$tanggal_service = $_POST['tanggal_service'];


$query = mysqli_query($koneksi, "INSERT INTO kelayakan (plat_nomer, tanggal_service, kerusakan, deskripsi, status) 
VALUES ('$platnomer', '$tanggal_service', '$perbaikan', '$deskripsi', '$status')");


if ($query) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/kelayakan/kelayakan.php");

}
