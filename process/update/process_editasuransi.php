<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');
$id = $_POST['id'];
$plat_nomer = $_POST['plat_nomer'];
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
$Jenis = $_POST['Jenis'];
$statuspem = $_POST['statuspem'];

$query = mysqli_query($koneksi, "update asuransi set plat_nomer='$plat_nomer',tgl_awal='$tgl_awal',tgl_akhir='$tgl_akhir',Jenis='$Jenis',statuspem='$statuspem' where id=$id");

if ($query) {
    $_SESSION['edit'] = 'berhasil edit';
}

header("location:" . BASE_URL . "/view/asuransi/asuransi.php");
