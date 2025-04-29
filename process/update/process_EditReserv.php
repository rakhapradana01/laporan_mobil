<?php
// koneksi database
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');

$id_reserv = $_POST['id_reserv'];
// proses update jika role admin
if ($_SESSION['fk_role'] == 'admin') {
    $tj = $_POST['Tujuan'];
    $reserv_pilih = $_POST['Pilih_Reserv'];
    $platnomer = $_POST['Plat_nomer'];
    $waktuOut = $_POST['WaktuOut'];
    $kmOut = $_POST['KmOut'];
    $waktuIn = $_POST['WaktuIn'];
    $kmIn = $_POST['KmIn'];
    $status = $_POST['statusPinjam'];

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    if (!empty($_FILES['fotoin']['name']) && !empty($_FILES['fotoout']['name'])) {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        // $namaFile = $_FILES['fotoin']['name'];
        // Get file's path info
        $filepath_info = pathinfo($_FILES['fotoin']['name']);
        $filepath_info2 = pathinfo($_FILES['fotoout']['name']);
        $namaFile = $filepath_info['filename'];
        $namaFile2 = $filepath_info2['filename'];
        $x = explode('.', $namaFile);
        $x2 = explode('.', $namaFile2);
        // $ekstensi = strtolower(end($x));
        $ekstensi = $filepath_info['extension'];
        $ekstensi2 = $filepath_info2['extension'];

        // File Extension
        $ukuran    = $_FILES['fotoin']['size'];
        $file_tmp = $_FILES['fotoin']['tmp_name'];
        $ukuran2    = $_FILES['fotoout']['size'];
        $file_tmp2 = $_FILES['fotoout']['tmp_name'];
        $dir = "../../img/reserv/";
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070 && $ukuran2 < 1044070) {
                // Iteration starting Value
                $i = 0;

                while (true) {
                    // Filename additional text
                    $additional_txt = ($i > 0) ? " ({$i})" : "";

                    // Temporary new filename
                    $tempname = $namaFile . $additional_txt . "-out." . $ekstensi;
                    $tempname2 = $namaFile2 . $additional_txt . "-in." . $ekstensi;
                    // Cheching Filename Duplicate
                    if (is_file($dir . $tempname) && is_file($dir . $tempname2)) {
                        // If has duplicate
                        $i++;
                    } else {
                        // Renew Filename
                        $namaFile = $tempname;
                        $namaFile2 = $tempname2;
                        // break the loop
                        break;
                    }
                }
                $foto = mysqli_fetch_assoc(mysqli_query($koneksi, "select id_reserv,fotoout,fotoin from reserv where id_reserv='$id_reserv'"));
                if (is_file("../../img/reserv/$foto[fotoout]")) {
                    unlink("../../img/reserv/" . $foto['fotoout']);
                    echo "ehe";
                }
                if (is_file("../../img/reserv/$foto[fotoin]")) {
                    unlink("../../img/reserv/" . $foto['fotoin']);
                    echo "ehe";
                }
                move_uploaded_file($file_tmp, $dir . $namaFile);
                move_uploaded_file($file_tmp2, $dir . $namaFile2);
                $query = mysqli_query($koneksi, "update reserv set Tujuan='$tj',Pilih_Reserv='$reserv_pilih',Plat_nomer='$platnomer',WaktuOut='$waktuOut',WaktuIN='$waktuIn',KmOut='$kmOut',fotoout='$namaFile2',KmIn='$kmIn',fotoin='$namaFile',status='$status' WHERE id_reserv='$id_reserv'");
                if ($query) {
                    // echo 'FILE BERHASIL DI UPLOAD';
                    //tambah mobil ketika data telah reservasi lengkap
                    $query2 = mysqli_query($koneksi, "update mobil set jumlah=1 where plat_nomer='$platnomer'");
                    $_SESSION['edit'] = 'berhasil edit';
                } else {
                    $_SESSION['status'] = 'GAGAL MENGUPLOAD GAMBAR';
                    // echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            } else {
                $_SESSION['status'] = 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
                // echo 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
            }
        } else {
            $_SESSION['status'] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            // echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    } else if (!empty($_FILES['fotoout']['name'])) {
        $filepath_info2 = pathinfo($_FILES['fotoout']['name']);
        $namaFile2 = $filepath_info2['filename'];
        $x2 = explode('.', $namaFile2);
        $ekstensi2 = $filepath_info2['extension'];

        // File Extension
        $ukuran2    = $_FILES['fotoout']['size'];
        $file_tmp2 = $_FILES['fotoout']['tmp_name'];
        $dir = "../../img/reserv/";
        if (in_array($ekstensi2, $ekstensi_diperbolehkan) === true) {
            if ($ukuran2 < 1044070) {
                // Iteration starting Value
                $i = 0;

                while (true) {
                    // Filename additional text
                    $additional_txt = ($i > 0) ? " ({$i})" : "";

                    // Temporary new filename
                    $tempname2 = $namaFile2 . $additional_txt . "-out." . $ekstensi2;
                    // Cheching Filename Duplicate
                    if (is_file($dir . $tempname2)) {
                        // If has duplicate
                        $i++;
                    } else {
                        // Renew Filename
                        $namaFile2 = $tempname2;
                        // break the loop
                        break;
                    }
                }
                $foto = mysqli_fetch_assoc(mysqli_query($koneksi, "select id_reserv,fotoout from reserv where id_reserv='$id_reserv'"));
                if (is_file("../../img/reserv/$foto[fotoout]")) {
                    unlink("../../img/reserv/" . $foto['fotoout']);
                    echo "ehe";
                }
                move_uploaded_file($file_tmp2, $dir . $namaFile2);
                $query = mysqli_query($koneksi, "update reserv set Tujuan='$tj',Pilih_Reserv='$reserv_pilih',Plat_nomer='$platnomer',,WaktuOut='$waktuOut',WaktuIN='$waktuIn',KmOut='$kmOut',fotoout='$namaFile2',KmIn='$kmIn',status='$status' WHERE id_reserv='$id_reserv'");
                if ($query) {
                    // echo 'FILE BERHASIL DI UPLOAD';
                    //tambah mobil ketika data telah reservasi lengkap
                    // $query2 = mysqli_query($koneksi, "update mobil set jumlah=1 where plat_nomer=$id_mobil");
                    $_SESSION['edit'] = 'berhasil edit';
                } else {
                    $_SESSION['status'] = 'GAGAL MENGUPLOAD GAMBAR';
                    // echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            } else {
                $_SESSION['status'] = 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
                // echo 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
            }
        } else {
            $_SESSION['status'] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            // echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    } else if (!empty($_FILES['fotoin']['name'])) {
        $filepath_info = pathinfo($_FILES['fotoin']['name']);
        $namaFile = $filepath_info['filename'];
        $x = explode('.', $namaFile);
        // $ekstensi = strtolower(end($x));
        $ekstensi = $filepath_info['extension'];

        // File Extension
        $ukuran    = $_FILES['fotoin']['size'];
        $file_tmp = $_FILES['fotoin']['tmp_name'];
        $dir = "../../img/reserv/";
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                // Iteration starting Value
                $i = 0;

                while (true) {
                    // Filename additional text
                    $additional_txt = ($i > 0) ? " ({$i})" : "";

                    // Temporary new filename
                    $tempname = $namaFile . $additional_txt . "-in." . $ekstensi;
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
                $foto = mysqli_fetch_assoc(mysqli_query($koneksi, "select id_reserv,fotoin from reserv where id_reserv='$id_reserv'"));
                if (is_file("../../img/reserv/$foto[fotoin]")) {
                    unlink("../../img/reserv/" . $foto['fotoin']);
                    echo "ehe";
                }
                move_uploaded_file($file_tmp, $dir . $namaFile);
                $query = mysqli_query($koneksi, "update reserv set Tujuan='$tj',Pilih_Reserv='$reserv_pilih',Plat_nomer='$platnomer',WaktuOut='$waktuOut',WaktuIN='$waktuIn',KmOut='$kmOut',KmIn='$kmIn',fotoin='$namaFile',status='$status' WHERE id_reserv='$id_reserv'");
                if ($query) {
                    // echo 'FILE BERHASIL DI UPLOAD';
                    //tambah mobil ketika data telah reservasi lengkap
                    $query2 = mysqli_query($koneksi, "update mobil set jumlah=1 where plat_nomer='$platnomer'");
                    $_SESSION['edit'] = 'berhasil edit';
                } else {
                    $_SESSION['status'] = 'GAGAL MENGUPLOAD GAMBAR';
                    // echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            } else {
                $_SESSION['status'] = 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
                // echo 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
            }
        } else {
            $_SESSION['status'] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            // echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    } else {
        $query = mysqli_query($koneksi, "update reserv set Tujuan='$tj',Pilih_Reserv='$reserv_pilih',plat_nomer='$platnomer',WaktuOut='$waktuOut',WaktuIn='$waktuIn',KmOut='$kmOut',KmIn='$kmIn',status='$status' WHERE id_reserv='$id_reserv'");
        $_SESSION['edit'] = 'berhasil edit';
        // print_r($_POST);
    }
    header("location:" . BASE_URL . "/view/kembali/kembali.php");
    // print_r($_SESSION['status']);
} else {
    //proses update jika role=user
    $waktuIn = $_POST['WaktuIn'];
    $kmIn = $_POST['KmIn'];
    $id_mobil = $_POST['id_mobil_user'];
    // $_SESSION['status'] = 'update Berhasil 2';
    if (!empty($_FILES['fotoin']['name'])) {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        // $namaFile = $_FILES['fotoin']['name'];
        // Get file's path info
        $filepath_info = pathinfo($_FILES['fotoin']['name']);
        $namaFile = $filepath_info['filename'];
        $x = explode('.', $namaFile);
        // $ekstensi = strtolower(end($x));
        $ekstensi = $filepath_info['extension'];

        // File Extension
        $ukuran    = $_FILES['fotoin']['size'];
        $file_tmp = $_FILES['fotoin']['tmp_name'];
        $dir = "../../img/reserv/";
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

                move_uploaded_file($file_tmp, $dir . $namaFile);
                $query = mysqli_query($koneksi, "update reserv set WaktuIn='$waktuIn',KmIn='$kmIn',fotoin='$namaFile' WHERE id_reserv='$id_reserv'");
                if ($query) {
                    //tambah mobil ketika data telah reservasi lengkap
                    $query2 = mysqli_query($koneksi, "update mobil set jumlah=1 where plat_nomer='$platnomer'");
                    // echo 'FILE BERHASIL DI UPLOAD';
                    $_SESSION['edit'] = 'berhasil edit';
                } else {
                    $_SESSION['status'] = 'GAGAL MENGUPLOAD GAMBAR';
                    // echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            } else {
                $_SESSION['status'] = 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
                // echo 'UKURAN FILE TERLALU BESAR ATAU NAMA FILE SUDAH DIGUNAKAN';
            }
        } else {
            $_SESSION['status'] = 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            // echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    } else {
        // $query = mysqli_query($koneksi, "update reserv set WaktuIN='$waktuIn',KmIn='$kmIn' WHERE id_reserv='$id_reserv'");
        $_SESSION['edit'] = 'berhasil edit';
    }
    print_r($_SESSION['status']);
    // header("location:" . BASE_URL . "reservasi.php");
}
