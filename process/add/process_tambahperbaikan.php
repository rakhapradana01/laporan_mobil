<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

// Sanitize the input data to prevent SQL injection
$Nik = mysqli_real_escape_string($koneksi, $_POST['id_nik']);
$Devisi = mysqli_real_escape_string($koneksi, $_POST['devisi']);
$tujuan_terakhir = mysqli_real_escape_string($koneksi, $_POST['tujuan_terakhir']);
$plat_nomer = mysqli_real_escape_string($koneksi, $_POST['plat_nomer']);
$tgl = mysqli_real_escape_string($koneksi, $_POST['tgl']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

// Fetch nama_pelapor from pegawai table based on Nik
$query_nama_pelapor = mysqli_query($koneksi, "SELECT Nama FROM pegawai WHERE id_nik = '$Nik'");
$data_nama_pelapor = mysqli_fetch_assoc($query_nama_pelapor);
$nama_pelapor = $data_nama_pelapor['Nama'];

// Insert data into kerusakan table
$query2 = mysqli_query($koneksi, "INSERT INTO kerusakan (plat_nomer, nama_pelapor, Nik, Devisi, tujuan_terakhir, tgl, deskripsi, status) 
VALUES ('$plat_nomer', '$nama_pelapor', '$Nik', '$Devisi', '$tujuan_terakhir', '$tgl', '$deskripsi', '$status')");

// Check if insertion was successful
if ($query2) {
    $_SESSION['tambah'] = 'Data berhasil ditambahkan';
    header("Location: " . BASE_URL . "/view/perbaikan/perbaikan.php");
} else {
    $_SESSION['tambah'] = 'Gagal menambahkan data';
    error_log("Error: " . mysqli_error($koneksi)); // Log any error
    header("Location: " . BASE_URL . "/view/perbaikan/perbaikan.php");
}
?>
