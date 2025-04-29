<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$plat_nomer = $_POST['plat_nomer'];
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
$Jenis = $_POST['Jenis'];
$statuspem = $_POST['statuspem'];

$sumber = @$_FILES['gambar']['tmp_name'];
$target = '../../img/asuransi/';
$nama_file = @$_FILES['gambar']['name'];
$pindah = move_uploaded_file($sumber, $target . $nama_file);

$tambah = mysqli_query($koneksi, "INSERT INTO asuransi(plat_nomer, tgl_awal, tgl_akhir, Jenis, gambar, statuspem)VALUES(
    '$plat_nomer', '$tgl_awal', '$tgl_akhir', '$Jenis', '" . $nama_file . "', '$statuspem')");


if ($tambah) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/asuransi/asuransi.php");

}
