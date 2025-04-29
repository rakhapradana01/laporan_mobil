<?php

require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$plat_nomer = $_POST['plat_nomer'];
$statuspemba = $_POST['statuspemba'];

$sumber = @$_FILES['foto']['tmp_name'];
$target = '../../img/pajak/';
$nama_file = @$_FILES['foto']['name'];
$pindah = move_uploaded_file($sumber, $target . $nama_file);

$tambah = mysqli_query($koneksi, "INSERT INTO pajak(plat_nomer, statuspemba, foto)VALUES
('$plat_nomer', '$statuspemba', '" . $nama_file . "')");

if ($tambah) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/pajak/pajak.php");

}