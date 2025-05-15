<?php
require_once('../../function/helper.php');

include '../../function/koneksi.php';


$page = isset($_GET['page']) ? ($_GET['page']) : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah data perbaikan</title>

    <?php include "../../template/header.php"; ?>


    <!-- css -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-primary alert-dismissible fade show" style="z-index: 1;position:absolute;transform: translate(-50%, -50%);  top: 10%;
        left: 50%;" role="alert">
              <span>' . $_SESSION['status'] . '</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    unset($_SESSION['status']);

    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    ?>


    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h1 class="h3 mb-4 text-gray-800">Data Perbaikan</h1>
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= BASE_URL ?>/view/perbaikan/perbaikan.php"><button
                                    class="btn btn-danger">Kembali</button></a>
                            <hr>
                            <form action="<?= BASE_URL ?>/process/add/process_tambahperbaikan.php" method="post">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nik</label>
                                    <select name="id_nik" id="id_nik" class="form-control" required>
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $sql_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));
                                        while ($data_pegawai = mysqli_fetch_array($sql_pegawai)) {
                                            echo '<option value="' . $data_pegawai['id_nik'] . '">' . $data_pegawai['id_nik'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Pelapor</label>
                                    <input type="text" class="form-control" id="nama_pelapor" disabled>
                                    <input type="hidden" name="nama_pelapor" id="nama_pelapor_hidden">
                                    <!-- Hidden field for submission -->
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Devisi</label>
                                    <input type="text" class="form-control" id="devisi" disabled>
                                    <input type="hidden" name="devisi" id="devisi_hidden">
                                    <!-- Hidden field for submission -->
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Plat Nomer</label>
                                    <select name="plat_nomer" id="plat_nomer" class="form-control" required>
                                        <option value="">--Pilih--</option>
                                        <?php
                                        $sql_mobil = mysqli_query($koneksi, "SELECT * FROM mobil") or die(mysqli_error($koneksi));
                                        while ($data_mobil = mysqli_fetch_array($sql_mobil)) {
                                            echo '<option value="' . $data_mobil['plat_nomer'] . '">' . $data_mobil['plat_nomer'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="">Tujuan Terakhir</label>
                                    <input type="text" name="tujuan_terakhir" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Tanggal Pengajuan</label>
                                    <input type="datetime-local" class="form-control" name="tgl" required>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id=""></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">--Pilih--</option>
                                        <option value="pending">Pending</option>
                                        <option value="sudah diperbaiki">Sudah Diperbaiki</option>
                                    </select>
                                </div>

                                <input type="submit" value="Ajukan" class="btn btn-success m-3">
                            </form>

                            <script>
                                document.getElementById('id_nik').addEventListener('change', function () {
                                    var nik = this.value;
                                    if (nik) {
                                        fetch("<?= BASE_URL ?>/view/perbaikan/get_nik_data.php?nik=" + nik)
                                            .then(response => response.json())
                                            .then(data => {
                                                // Populate Nama Pelapor and Devisi fields
                                                document.getElementById('nama_pelapor').value = data.Nama;
                                                document.getElementById('devisi').value = data.fk_devisi;

                                                // Set hidden fields for submission
                                                document.getElementById('nama_pelapor_hidden').value = data.Nama;
                                                document.getElementById('devisi_hidden').value = data.fk_devisi;
                                            })
                                            .catch(error => {
                                                console.error("Error fetching data:", error);
                                            });
                                    }
                                });

                                function logFormData() {
                                    // Get the form values
                                    var nik = document.getElementById('id_nik').value;
                                    var namaPelapor = document.getElementById('nama_pelapor').value;
                                    var devisi = document.getElementById('devisi').value;
                                    var tujuan_terakhir = document.getElementsByName('tujuan_terakhir')[0].value;
                                    var plat_nomer = document.getElementsByName('plat_nomer')[0].value;
                                    var tgl = document.getElementsByName('tgl')[0].value;
                                    var deskripsi = document.getElementsByName('deskripsi')[0].value;
                                    var status = document.getElementsByName('status')[0].value;

                                    // Log to the console
                                    console.log("NIK:", nik);
                                    console.log("Nama Pelapor:", namaPelapor);
                                    console.log("Devisi:", devisi);
                                    console.log("Tujuan Terakhir:", tujuan_terakhir);
                                    console.log("Plat Nomer:", plat_nomer);
                                    console.log("Tanggal Pengajuan:", tgl);
                                    console.log("Deskripsi:", deskripsi);
                                    console.log("Status:", status);

                                    // Optional: Alert the user with the values
                                    alert("Form Data Logged in Console. Check Console for Details.");

                                    // Return true to allow form submission
                                    return true;
                                }
                            </script>

                            <script src="vendor/jquery/jquery.min.js"></script>
                            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                            <script src="js/sb-admin-2.min.js"></script>
                        </div>
                    </div>

</body>

</html>