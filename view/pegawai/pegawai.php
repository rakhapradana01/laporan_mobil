<?php
require_once('../../function/helper.php');
include '../../function/koneksi.php';


$page = isset($_GET['page']) ? ($_GET['page']) : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>APS RESERVASI</title>

    <?php include "../../template/header.php"; ?>

</head>

<body>
    <?php
    include '../../template/sidebar.php';
    include '../../template/topbar.php';
    if (isset($_SESSION['tambah']) == 'berhasil tambah') {
       echo "
         <script type='text/javascript'>
                swal({
                    title: 'Informasi',
                    text: 'Data Berhasil Ditambahkan',
                    icon: 'success',
                    button: 'OK',
                });
         </script>";
    } 

    if (isset($_SESSION['edit']) == 'berhasil edit') {
       echo "
         <script type='text/javascript'>
                swal({
                    title: 'Informasi',
                    text: 'Data Berhasil Diupdate',
                    icon: 'success',
                    button: 'OK',
                });
         </script>";
    }

    if (isset($_SESSION['hapus']) == 'hapus') {
       echo "
         <script type='text/javascript'>
                swal({
                    title: 'Informasi',
                    text: 'Data Berhasil Dihapus',
                    icon: 'success',
                    button: 'OK',
                });
         </script>";
    }

    unset($_SESSION['tambah']);
    unset($_SESSION['edit']);
    unset($_SESSION['hapus']);

    ?>
    <div id="content-wrapper" class="d-flex flex-column mt-4 ">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
            <h1 class="h3 mb-4 text-gray-800">Data Pegawai</h1>
            <div class="card">
                <div class="card-body">
                    <a href="<?php BASE_URL ?>addpegawai.php"><button class="btn btn-success">Tambah Pegawai</button></a>
                    <a target="_blank" href="<?= BASE_URL ?>/print/printPegawai.php"><button class="btn btn-info">Print</button></a>
                    <hr>
                    <div class="table-container">
                        <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Devisi</th>
                                    <th>Jabatan</th>
                                    <th>Role</th>
                                    <!-- <th>Password</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($koneksi, "select * from pegawai join user on id_nik=Nik ORDER BY Nama asc");
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <?php
                                        if ($_SESSION['fk_role'] == 'admin') {
                                            echo ' <td>
                                    <a href="updatepegawai.php?id_nik=' . $d["id_nik"] . '"><button class="btn btn-success"><i class="fas fa-fw fa-pen"></i></button></a>
                                    <a data-id="' . $d["id_nik"] . '" data-toggle="modal" data-target="#exampleModal" <button class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                                </td>';
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                        <td><?= $no++; ?></td>
                                        <td><?= $d['id_nik']; ?></td>
                                        <td><?= $d['Nama']; ?></td>
                                        <td><?= $d['fk_devisi']; ?></td>
                                        <td><?= $d['Jabatan']; ?></td>
                                        <td><?= $d['fk_role']; ?></td>
                                        <!-- <td><?= $d['Password']; ?></td> -->
                                    </tr>
                                <?php
                                };
                                ?>
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda ingin menghapus data ini ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" id="hapus">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            // Tangani tombol "Hapus" yang diklik di dalam modal
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var idNik = button.data('id'); // Ambil ID pegawai dari atribut data-id
                var modal = $(this);
                modal.find('.modal-body').html('Apakah Anda yakin ingin menghapus data ini ?');
                // Atur tindakan penghapusan ke URL yang benar
                modal.find('.btn-danger').attr('data-id', idNik);
            });

            $('#exampleModal .btn-danger').click(function() {
                var idNik = $(this).data('id');
                // Lakukan tindakan penghapusan sesuai dengan URL yang benar
                window.location.href = '<?= BASE_URL ?>/process/delete/process_hapuspegawai.php?id_nik=' + idNik;
            });
        });
    </script>
    <?php include "../../template/footer.php"; ?>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

</body>

</html>

</body>

</html>
<style>
    .table-container {
        max-height: 500px;
        /* Adjust the maximum height as needed */
        overflow-y: auto;
    }
</style>