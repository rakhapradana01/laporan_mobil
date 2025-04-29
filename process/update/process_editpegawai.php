<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$id_nik = $_POST['id_nik'];
$nama = $_POST['Nama'];
$devisi = $_POST['devisi'];
$jabatan = $_POST['Jabatan'];

$query = mysqli_query($koneksi, "update pegawai set Nama='$nama',fk_devisi='$devisi',Jabatan='$jabatan' WHERE id_nik='$id_nik'");

// $Password = $_POST ['Password'];
$Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
$role = $_POST['role'];
$query2 = mysqli_query($koneksi, "update user set Password='$Password',fk_role='$role' WHERE Nik='$id_nik'");

if ($query) {
    $_SESSION['edit'] = 'berhasil edit';
}

header("location:" . BASE_URL . "/view/pegawai/pegawai.php");
