<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

// Retrieve form data
$nik = $_POST['id_nik'];
$tj = $_POST['Tujuan'];
$reserv_pilih = $_POST['status'];
$platnomer = $_POST['plat_nomer'];

// Get car info
$query3 = mysqli_query($koneksi, "SELECT * FROM mobil WHERE plat_nomer='$platnomer'");
$data = mysqli_fetch_assoc($query3);
$jumlah = $data['jumlah'] - 1;

// Handle KmOut and KmIn values
$kmOut = isset($_POST['KmOut']) ? $_POST['KmOut'] : null;
$kmIn = isset($_POST['KmIn']) ? $_POST['KmIn'] : NULL; // Handle missing KmIn

// Handle file uploads for fotoout and fotoin
$sumber_fotoout = isset($_FILES['fotoout']['tmp_name']) ? $_FILES['fotoout']['tmp_name'] : null;
$nama_file_fotoout = isset($_FILES['fotoout']['name']) ? $_FILES['fotoout']['name'] : null;

$sumber_fotoin = isset($_FILES['fotoin']['tmp_name']) ? $_FILES['fotoin']['tmp_name'] : null;
$nama_file_fotoin = isset($_FILES['fotoin']['name']) ? $_FILES['fotoin']['name'] : null;

// Upload fotoout
if ($sumber_fotoout && $nama_file_fotoout) {
    $target_fotoout = '../../img/reserv/';
    move_uploaded_file($sumber_fotoout, $target_fotoout . $nama_file_fotoout);
} else {
    $nama_file_fotoout = ''; // If no file is uploaded, set it to an empty string or NULL
}

// Upload fotoin
if ($sumber_fotoin && $nama_file_fotoin) {
    $target_fotoin = '../../img/reserv/';
    move_uploaded_file($sumber_fotoin, $target_fotoin . $nama_file_fotoin);
} else {
    $nama_file_fotoin = ''; // If no file is uploaded, set it to an empty string or NULL
}

// Handle WaktuOut
$waktuOut = isset($_POST['WaktuOut']) ? $_POST['WaktuOut'] : null; // Handle missing WaktuOut

// Set status
if ($reserv_pilih == "DALAM") {
    $status = "ACC";
} else {
    $status = "PENDING";
}

// Insert reservation data (including fotoin)
$query = mysqli_query($koneksi, "INSERT INTO reserv (nik, tujuan, pilih_reserv, plat_nomer, WaktuOut, KmOut, KmIn, fotoout, fotoin, status) 
VALUES ('$nik', '$tj', '$reserv_pilih', '$platnomer', '$waktuOut', '$kmOut', '$kmIn', '$nama_file_fotoout', '$nama_file_fotoin', '$status')");

// Update car quantity
$query2 = mysqli_query($koneksi, "UPDATE mobil SET jumlah = $jumlah WHERE plat_nomer='$platnomer'");

if ($query) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/reservasi/reservasi.php");
}
?>
