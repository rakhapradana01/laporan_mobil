<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$id_devisi = $_POST['id_devisi'];
$devisi = $_POST['devisi'];

$query = mysqli_query($koneksi, "insert into devisi values('$id_devisi','$devisi')
    ");

if ($query) {
    $_SESSION['tambah'] = 'berhasil tambah';
    header("location:" . BASE_URL . "/view/devisi/devisi.php");

}

