<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');



$id_perbaikan = $_GET['id_perbaikan'];


$query = mysqli_query($koneksi, "DELETE FROM kerusakan WHERE id='$id_perbaikan'");

if ($query) {
    $_SESSION['hapus'] = 'hapus';
    header("location:" . BASE_URL . "/view/perbaikan/perbaikan.php");
}

