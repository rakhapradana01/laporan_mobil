<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');
$plat_nomer = $_POST['plat_nomer'];
$id = $_POST['id'];
$jenis_service = $_POST['jenis_service'];

$query = mysqli_query($koneksi, "update service set plat_nomer='$plat_nomer',jenis_service='$jenis_service' WHERE id='$id'");

if ($query) {
    $_SESSION['edit'] = 'berhasil edit';
}
header("location:" . BASE_URL . "/view/service/service.php");
