<?php

require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$id_nik = $_POST['id_nik'];
$nama = $_POST['Nama'];
$devisi = $_POST['devisi'];
$jabatan = $_POST['Jabatan'];
$_SESSION['status'] = 'Data Berhasil di input';


$query = mysqli_query($koneksi, "insert into pegawai values('$id_nik','$nama','$devisi','$jabatan')");

$password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
$role = $_POST['role'];
$cekNikUser = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE Nik = '$id_nik'"));
$cekNikPegawai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_nik = '$id_nik'"));
if ($cekNikPegawai == 1 && $cekNikUser == 0) {
    $query2 = mysqli_query($koneksi, "insert into user values('','$id_nik','$password','$role')");
}

if ($query) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/pegawai/pegawai.php");

}

