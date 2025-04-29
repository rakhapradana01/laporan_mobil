<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$id_nik = $_GET['id_nik'];


$query = mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_nik='$id_nik'");
$query = mysqli_query($koneksi, "DELETE FROM user WHERE Nik='$id_nik'");

if ($query) {
    $_SESSION['hapus'] = 'hapus';
}

header("location:" . BASE_URL . "/view/pegawai/pegawai.php");
