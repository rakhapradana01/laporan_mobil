<?php
include '../../function/koneksi.php';
include '../../function/helper.php';

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
    <!-- Custom fonts for this template-->
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
            <h1 class="h3 mb-4 text-gray-800">Data Service</h1>
            <div class="card">
                <div class="card-body">
                    
                    <?php
                    if ($_SESSION['fk_role'] == 'admin') {
                        echo '<td>
                    <div class="table-container">
                        <a href="addservice.php"><button class="btn btn-success">Tambah service</button></a>
                        </td>';
                    } else {
                        echo '';
                    }
                    ?>
                    <hr>
                    <table id="myTable" class="display compact table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <?php
                                if ($_SESSION['fk_role'] == 'admin') {
                                    echo '<th width="150px">Action</th>';
                                } else {
                                    echo '';
                                }
                                ?>
                                <th>No</th>
                                <th>Plat Nomer</th>
                                <th>Merek</th>
                                <th>tipe</th>
                                <th>Warna</th>
                                <th>Jenis service</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($koneksi, "select * from service join mobil on mobil.plat_nomer=service.plat_nomer");
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <tr>
                                    <?php
                                    if ($_SESSION['fk_role'] == 'admin') {
                                        echo ' <td>
                            <a href="updateservice.php?id=' . $d["id"] . '"><button class="btn btn-success btn-sm"><i class="fas fa-fw fa-pen"></i></button></a>
                            <a data-id="' . $d["id"] . '" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
                        </td>';
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['plat_nomer']; ?></td>
                                    <td><?= $d['merek']; ?></td>
                                    <td><?= $d['tipe_mobil']; ?></td>
                                    <td><?= $d['warna']; ?></td>
                                    <td><?= $d['jenis_service']; ?></td>

                                </tr>
                            <?php
                            };
                            ?>
                        </tbody>

                    </table>

                    <!-- modals -->
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
                                    <button type="button" class="btn btn-danger" id="hapus">hapus</button>
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
                var id = button.data('id'); // Ambil ID pegawai dari atribut data-id
                var modal = $(this);
                modal.find('.modal-body').html('Apakah Anda yakin ingin menghapus data ini ?');
                // Atur tindakan penghapusan ke URL yang benar
                modal.find('#hapus').attr('data-id', id);
            });

            $('#hapus').click(function() {
                var id = $(this).data('id');
                // Lakukan tindakan penghapusan sesuai dengan URL yang benar
                window.location.href = '<?= BASE_URL ?>/process/delete/process_hapusservice.php?id=' + id;
            });
        });
    </script>


    <?php include '../../template/footer.php'; ?>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>
<style>
    .table-container {
        max-height: 700px;
        /* Adjust the maximum height as needed */
        overflow-y: auto;
    }
</style>