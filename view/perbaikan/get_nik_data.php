<?php
require_once('../../function/koneksi.php');

// Get NIK from the request
$nik = $_GET['nik'];

// Query the database to get the corresponding Nama and Devisi
$query = mysqli_query($koneksi, "SELECT Nama, fk_devisi FROM pegawai WHERE id_nik = '$nik'");

if ($query) {
    $data = mysqli_fetch_assoc($query);

    // Return the data as JSON
    echo json_encode($data);
} else {
    // Return error if no data found
    echo json_encode(["error" => "No data found"]);
}
?>
