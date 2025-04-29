<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$id_reserv = $_GET['id_reserv'];
// echo $id_reserv;
$foto = mysqli_fetch_assoc(mysqli_query($koneksi, "select id_reserv,fotoout,fotoin,Plat_nomer from reserv where id_reserv='$id_reserv'"));
mysqli_query($koneksi, "update mobil set jumlah=1 where plat_nomer='$foto[Plat_nomer]'");
// print_r($foto);
// print_r(!empty($foto['id_reserv']));
if (!empty($foto['fotoout'])) {
    unlink("../../img/reserv/" . $foto['fotoout']);
    unlink("../../img/reserv/" . $foto['fotoout']);
}
if (!empty($foto['fotoin'])) {
    unlink("../../img/reserv/" . $foto['fotoin']);
    unlink("../../img/reserv/" . $foto['fotoin']);
}
$query = mysqli_query($koneksi, "DELETE FROM reserv WHERE id_reserv='$id_reserv'");
// print_r($foto['fotoout']);
// !isset($foto['fotoout']);
// $query = mysqli_query($koneksi, "DELETE FROM reserv WHERE id_reserv='$id_reserv'");
if ($query) {
    $_SESSION['hapus'] = 'hapus';
    header("location:" . BASE_URL . "/view/reservasi/reservasi.php");
}
