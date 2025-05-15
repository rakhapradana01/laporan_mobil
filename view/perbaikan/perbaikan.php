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
                            <a href="addperbaikan.php"><button class="btn btn-success">Lapor Perbaikan</button></a>
                            <hr>
                            <div class="table-container">
                                <table id="myTable" class="table table-responsive table-striped table-bordered"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <?php
                                            if ($_SESSION['fk_role'] == 'admin') {
                                                echo '<th width="80px;">AKSI</th>';
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                            <th>No</th>
                                            <th>Nama Pelapor</th>
                                            <th>NIK</th>
                                            <th>Devisi</th>
                                            <th>Plat Nomer</th>
                                            <th>Tujuan Terakhir</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Tanggal Perbaikan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = mysqli_query($koneksi, "
                                        SELECT k.*, Nama as nama_pelapor, Devisi
                                        FROM kerusakan k
                                        JOIN pegawai p ON Nik = id_nik
                                        ORDER BY tgl DESC
                                        ");
                                        while ($d = mysqli_fetch_array($data)) {
                                            ?>
                                            <tr>
                                                    <?php
                                                    if ($_SESSION['fk_role'] == 'admin') {
                                                        // For updating the status
                                                        echo '<td><a href="' . BASE_URL . '/view/perbaikan/update_status_perbaikan.php?id=' . $d["id"] . '" 
                                                    onclick="return confirm(\'Apakah Anda yakin ingin mengubah status menjadi sudah diperbaiki ?\')">
                                                    <button class="btn btn-success btn-sm"><i class="fas fa-fw fa-check"></i></i></button>
                                                    </a>';

                                                        // Optional: For the delete button
                                                        echo '<a href="" data-id="' . $d["id"] . '" data-toggle="modal" data-target="#exampleModal">
                                                    <button class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></button>
                                                    </a></td>';
                                                    } else {
                                                        echo '';
                                                    }

                                                    ?>
                                                <td><?= $no++; ?></td>
                                                <td><?= $d['nama_pelapor']; ?></td>
                                                <td><?= $d['Nik']; ?></td>
                                                <td><?= $d['Devisi']; ?></td>
                                                <td><?= $d['plat_nomer']; ?></td>
                                                <td><?= $d['tujuan_terakhir']; ?></td>
                                                <td><?= $d['deskripsi']; ?></td>
                                                <td><?= $d['status']; ?></td>
                                                <td style="white-space: normal;">
                                                    <?php
                                                    if ($d['tgl']) {
                                                        // Mengambil WaktuOut
                                                        $tgl = $d['tgl'];

                                                        // Mengonversi WaktuOut menjadi format Hari-Bulan-Tahun
                                                        $formatted_date = date("d-m-Y", strtotime($tgl));

                                                        // Jika ada waktu (jam), tampilkan juga
                                                        $date_time = explode(" ", $tgl);
                                                        $date = $date_time[0]; // Tanggal
                                                        $time = isset($date_time[1]) ? $date_time[1] : '';

                                                        // Tampilkan Tanggal dalam format Hari-Bulan-Tahun
                                                        echo "<span style='display:block;'>$formatted_date</span><span>$time</span>";
                                                    } else {
                                                        echo "-"; // Jika tidak ada data WaktuOut
                                                    }
                                                    ?>
                                                </td>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ;
                                        ?>
                                    </tbody>

                                </table>
                                <!-- modals -->
                                <div class="modal fade" id="exampleModal" role="dialog" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda ingin menghapus data ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger" id="hapus">hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        // Tangani tombol "Hapus" yang diklik di dalam modal
                        $('#exampleModal').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget); // Tombol yang memicu modal
                            var id = button.data('id'); // Ambil ID pegawai dari atribut data-id
                            var modal = $(this);
                            modal.find('.modal-body').html('Apakah Anda yakin ingin menghapus data ini ?');
                            // Atur tindakan penghapusan ke URL yang benar
                            modal.find('.btn-danger').attr('data-id', id);
                        });

                        $('#exampleModal .btn-danger').click(function () {
                            var id = $(this).data('id');
                            // Lakukan tindakan penghapusan sesuai dengan URL yang benar
                            window.location.href = '<?= BASE_URL ?>/process/delete/process_hapusPerbaikan.php?id_perbaikan=' + id;
                        });
                    });
                </script>


                <?php include '../../template/footer.php'; ?>
                <script>
                    $(document).ready(function () {
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

    table {
        white-space: nowrap;
    }
</style>