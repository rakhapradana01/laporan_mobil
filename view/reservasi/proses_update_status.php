<?php
// Include koneksi ke database
include '../../function/koneksi.php';
include '../../function/helper.php';

// Ambil ID reservasi dari URL
if (isset($_GET['id_reserv'])) {
    $id_reserv = $_GET['id_reserv'];

    // Query untuk mengupdate status menjadi "ACC"
    $query = "UPDATE reserv SET status = 'ACC' WHERE id_reserv = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_reserv);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman reservasi dengan pesan sukses
        header("Location: ".BASE_URL."/view/reservasi/reservasi.php");
        exit;
    } else {
        // Redirect dengan pesan error
        header("Location: ".BASE_URL."/view/reservasi/reservasi.php");
        exit;
    }
} else {
    // Jika ID tidak ditemukan, redirect dengan pesan error
    header("Location: ".BASE_URL."/view/reservasi/reservasi.php");
    exit;
}
?>
