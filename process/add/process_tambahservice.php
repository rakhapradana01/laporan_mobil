<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$plat_nomer = $_POST['plat_nomer'];
$tanggal_service = $_POST['tanggal_service'];
$jenis_service = $_POST['jenis_service'];
$km_sekarang = $_POST['km_sekarang'];

// Tentukan km_berikutnya berdasarkan jenis service
if ($jenis_service == 'Mesin') {
    $km_berikutnya = $km_sekarang + 5000; // Jika mesin, service lagi setelah 5.000 km
} elseif ($jenis_service == 'Keseluruhan') {
    $km_berikutnya = $km_sekarang + 10000; // Jika keseluruhan, service lagi setelah 10.000 km
} else {
    $km_berikutnya = 0;
}

// Menambahkan data service ke tabel service
$query = mysqli_query($koneksi, "INSERT INTO service (plat_nomer,tanggal_service, jenis_service, km_sekarang, km_berikutnya) 
VALUES ('$plat_nomer','$tanggal_service', '$jenis_service', '$km_sekarang', '$km_berikutnya')");

if ($query) {
    // Redirect ke halaman service dengan pesan notifikasi
    $message = "Mobil dengan Plat Nomor $plat_nomer melakukan service $jenis_service dan harus service lagi setelah $km_berikutnya km.";
    header("Location: " . BASE_URL . "/view/service/service.php?notification=" . urlencode($message));
    exit(); // Pastikan script dihentikan setelah header untuk menghindari output lebih lanjut
}
?>
