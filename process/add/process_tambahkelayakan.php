<?php

require_once('../../function/helper.php');
require_once('../../function/koneksi.php');



$platnomer = $_POST['plat_nomer'];
$perbaikan = $_POST['perbaikan'];
$deskripsi = $_POST['deskripsi'];
$status = $_POST['status'];


$query = mysqli_query($koneksi, "INSERT INTO kelayakan (plat_nomer, kerusakan, deskripsi, status) 
VALUES ('$platnomer', '$perbaikan', '$deskripsi', '$status')");


if ($query) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/kelayakan/kelayakan.php");

}
