<?php

require_once('../function/helper.php');
require_once('../function/koneksi.php');


$Nik = $_POST['Nik'];
$Password = $_POST['Password'];

print_r("s");
$query = mysqli_query($koneksi, "SELECT id,Nik,Password,fk_role,pegawai.Nama as Nama FROM user join pegawai on Nik=pegawai.id_nik WHERE Nik = '$Nik'");
// var_dump($query);
if (mysqli_num_rows($query) != 0) {
    print_r("s");
    $row = mysqli_fetch_assoc($query);
    if (!password_verify($Password, $row["Password"])) {
        $_SESSION['status'] = 'password salah';
        header("location: " . BASE_URL);
        exit();
    }
    $_SESSION['nama'] = $row['Nama'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['Nik'] = $row['Nik'];
    $_SESSION['fk_role'] = $row['fk_role'];
    $_SESSION['status'] = 'Login Berhasil';


    if ($row['fk_role'] == 'admin') {
        header("location: " . BASE_URL . '/view/dashboard.php?page=admin');
    } else if ($row['fk_role'] == 'user') {
        header("location: " . BASE_URL . '/view/dashboard.php?page=user');
    }
    header("location: " . BASE_URL . '/view/dashboard.php');
    print_r("s");
} else {
    $_SESSION['status'] = 'nik tidak terdaftar';
    header("location: " . BASE_URL);
}
