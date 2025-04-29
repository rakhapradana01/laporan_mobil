<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$id = $_POST['id'];
$platnomer = $_POST['plat_nomer'];
$merek = $_POST['merek'];
$tipe = $_POST['tipe_mobil'];
$warna = $_POST['warna'];
$BBM = $_POST['BBM'];
$noRangka = $_POST['noRangka'];
$noMesin = $_POST['noMesin'];

$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
if (!empty($_FILES['foto']['name'])) {

    $filepath_info = pathinfo($_FILES['foto']['name']);
    $namaFile = $filepath_info['filename'];
    $x = explode('.', $namaFile);
    $ekstensi = $filepath_info['extension'];

    // File Extension
    $ukuran    = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $dir = "../../img/mobil/";
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            // Iteration starting Value
            $i = 0;
            while (true) {
                // Filename additional text
                $additional_txt = ($i > 0) ? " ({$i})" : "";

                // Temporary new filename
                $tempname = $namaFile . $additional_txt . "." . $ekstensi;
                // Cheching Filename Duplicate
                if (is_file($dir . $tempname)) {
                    // If has duplicate
                    $i++;
                } else {
                    // Renew Filename
                    $namaFile = $tempname;
                    // break the loop
                    break;
                }
            }
            $foto = mysqli_fetch_assoc(mysqli_query($koneksi, "select foto from mobil where plat_nomer='$id'"));
            if (is_file("../../img/mobil/$foto[foto]")) {
                unlink("../../img/mobil/" . $foto['foto']);
            }
            move_uploaded_file($file_tmp, $dir . $namaFile);
            $query = mysqli_query($koneksi, "update mobil set plat_nomer='$platnomer',merek='$merek',tipe_mobil='$tipe',warna='$warna',BBM='$BBM',foto='$namaFile',noRangka='$noRangka',noMesin='$noMesin' where plat_nomer='$id'");
            if ($query) {
                // echo 'FILE BERHASIL DI UPLOAD';
                $_SESSION['edit'] = 'berhasil edit';
            } else {
                $_SESSION['status'] = 'GAGAL MENGUPLOAD GAMBAR';
            }
        } else {
            $_SESSION['status'] = 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
        }
    } else {
        $_SESSION['status'] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    }
} else {
    $query = mysqli_query($koneksi, "update mobil set plat_nomer='$platnomer',merek='$merek',tipe_mobil='$tipe',warna='$warna',BBM='$BBM',noRangka='$noRangka',noMesin='$noMesin' where plat_nomer='$id'");
    $_SESSION['edit'] = 'berhasil edit';
}

header("location:" . BASE_URL . "/view/mobil/mobil.php");
