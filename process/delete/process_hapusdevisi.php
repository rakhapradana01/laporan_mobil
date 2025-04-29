<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$id_devisi = $_GET['id_devisi'];


$query = mysqli_query($koneksi, "DELETE FROM devisi WHERE id_devisi='$id_devisi'");

if ($query) {
    $_SESSION['hapus'] = 'hapus';
}

header("location:" . BASE_URL . "/view/devisi/devisi.php");
