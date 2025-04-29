<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');
$id = $_GET['id'];

$foto = mysqli_fetch_assoc(mysqli_query($koneksi, "select foto from mobil where plat_nomer='$id'"));
if (!empty($foto['foto'])) {
    unlink("../../img/mobil/" . $foto['foto']);
}
$query = mysqli_query($koneksi, "DELETE FROM mobil WHERE plat_nomer='$id'");

if ($query) {
    $_SESSION['hapus'] = 'hapus';
}
header("location:" . BASE_URL . "/view/mobil/mobil.php");