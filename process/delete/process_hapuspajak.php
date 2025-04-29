<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM pajak WHERE id='$id'");


if ($query) {
    $_SESSION['hapus'] = 'hapus';
}
header("location:" . BASE_URL . "/view/pajak/pajak.php");
