<?php

require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$platnomer = $_POST['plat_nomer'];
$merek = $_POST['merek'];
$tipe = $_POST['tipe_mobil'];
$warna = $_POST['warna'];
$BBM = $_POST['BBM'];
$noRangka = $_POST['noRangka'];
$noMesin = $_POST['noMesin'];


$sumber = @$_FILES['foto']['tmp_name'];
$target = '../../img/mobil/';
$nama_file = @$_FILES['foto']['name'];
$pindah = move_uploaded_file($sumber, $target . $nama_file);

$tambah = mysqli_query($koneksi, "INSERT INTO mobil(plat_nomer, merek, tipe_mobil, warna, BBM, foto, noMesin, noRangka, jumlah)VALUES(
        '$platnomer', '$merek', '$tipe', '$warna', '$BBM', '" . $nama_file . "', '$noMesin', '$noRangka', 1)");

if ($tambah) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/mobil/mobil.php");
}

    
