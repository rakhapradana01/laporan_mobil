<?php
// koneksi database
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$nik = $_POST['id_nik'];
$tj = $_POST['Tujuan'];
$reserv_pilih = $_POST['status'];
$platnomer = $_POST['plat_nomer'];

$query3 = mysqli_query($koneksi, "SELECT * FROM mobil  WHERE plat_nomer='$platnomer'");
$data = mysqli_fetch_assoc($query3);
print_r($data);
$jumlah = $data['jumlah'] - 1;
$waktuOut = $_POST['WaktuOut'];
$kmOut = $_POST['KmOut'];

if ($reserv_pilih == "DALAM") {
    $status = "ACC";
} else {
    $status = "PENDING";
}

$sumber = @$_FILES['fotoout']['tmp_name'];
$target = '../../img/reserv/';
$nama_file = @$_FILES['fotoout']['name'];
$pindah = move_uploaded_file($sumber, $target . $nama_file);

$query = mysqli_query($koneksi, "INSERT INTO reserv (nik, Pilih_reserv, tujuan, plat_nomer, WaktuOut, KmOut, fotoout, fotoin, status, KmIn) 
VALUES ('$nik', '$reserv_pilih', '$tj', '$platnomer', '$waktuOut', '$kmOut', '" . mysqli_real_escape_string($koneksi, $nama_file) . "', '', '$status', '')");

$query2 = mysqli_query($koneksi, "update mobil set jumlah = $jumlah where plat_nomer='$platnomer'");

if ($query) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/pinjam/pinjam.php");
}
