<?php
// Include koneksi ke database dan helper
include '../../function/koneksi.php';
include '../../function/helper.php';

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id_reserv = $_GET['id'];

    // Query untuk mengupdate status menjadi "Sudah Di Perbaiki"
    $query = "UPDATE kerusakan SET status = 'sudah diperbaiki' WHERE id = ?";
    
    // Menyiapkan statement untuk menghindari SQL injection
    $stmt = $koneksi->prepare($query);
    
    // Bind parameter (parameter pertama adalah type: 'i' untuk integer)
    $stmt->bind_param("i", $id_reserv);

    // Mengeksekusi statement
    if ($stmt->execute()) {
        // Redirect ke halaman perbaikan.php setelah berhasil update status
        header("Location: ".BASE_URL."/view/perbaikan/perbaikan.php");
        exit;
    } else {
        // Redirect ke halaman perbaikan.php jika terjadi error
        header("Location: ".BASE_URL."/view/perbaikan/perbaikan.php");
        exit;
    }
} else {
    // Jika ID tidak ditemukan dalam URL, redirect dengan pesan error
    header("Location: ".BASE_URL."/view/perbaikan/perbaikan.php");
    exit;
}
?>
