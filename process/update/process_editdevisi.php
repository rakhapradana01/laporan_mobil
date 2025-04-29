<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');
$old_id = $_POST['old_id'];
$id_devisi = $_POST['id_devisi'];
$devisi = $_POST['devisi'];

$query = mysqli_query($koneksi, "update devisi set id_devisi='$id_devisi',devisi='$devisi' WHERE id_devisi='$old_id'");

if ($query) {
    $_SESSION['edit'] = 'berhasil edit';
}

header("location:" . BASE_URL . "/view/devisi/devisi.php");
