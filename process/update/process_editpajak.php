<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');
$id = $_POST['id'];
$plat_nomer = $_POST['plat_nomer'];
$statuspemba = $_POST['statuspemba'];

$query = mysqli_query($koneksi, "update pajak set plat_nomer='$plat_nomer',statuspemba='$statuspemba' WHERE id='$id'");


if ($query) {
    $_SESSION['edit'] = 'berhasil edit';
}
header("location:" . BASE_URL . "/view/pajak/pajak.php");
