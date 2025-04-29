<?php
include '../../function/koneksi.php';
include '../../function/helper.php';
$page = 'mobil';

$page = isset($_GET['page']) ? ($_GET['page']) : false;
?>
<!DOCTYPE html>
<html lang="en">
    <style>
        body {margin:2em;}
        td:last-child {text-align:center;}
    </style>

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
            <h1 class="h3 mb-4 text-gray-800">Data Kembali</h1>
            <div class="card">
                <div class="card-body">
                    
                    <table id="myTable"  class="table table-responsive table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                                <tr>
                                    <th>AKSI</th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nik</th>
                                    <th>Devisi</th>
                                    <th>Jabatan</th>
                                    <th>Tujuan</th>
                                    <th>Pilih_Reser</th>
                                    <th>Plat_Nomer</th>
                                    <th>Merek</th>
                                    <th>Tipe</th>
                                    <th>Warna</th>
                                    <th>Waktu IN</th>
                                    <th>Km IN</th>
                                    <th>Foto Masuk</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = mysqli_query($koneksi, "
                                select 
                                    id_reserv,
                                    pegawai.Nama as Nama_Peminjam,
                                    pegawai.id_nik as Nik,
                                    pegawai.fk_devisi as devisi,
                                    pegawai.Jabatan as Jabatan,
                                    Tujuan,
                                    Pilih_Reserv,
                                    reserv.Plat_nomer as Plat_nomer,
                                    mobil.Merek,
                                    mobil.Tipe_Mobil,
                                    mobil.warna as warna,
                                    WaktuOut,
                                    WaktuIn,
                                    KmOut,
                                    fotoout,
                                    KmIn, 
                                    fotoin,
                                    status
                                    from reserv 
                                    join pegawai on id_nik=reserv.Nik 
                                    join mobil on reserv.Plat_nomer=mobil.Plat_nomer order by id_reserv desc;");
                                while ($d = mysqli_fetch_array($data)) {

                                ?>
                                    <tr>
                                        <td>
                                            <a href="<?= BASE_URL ?>/view/kembali/updateKembali.php?id_reserv=<?php echo $d["id_reserv"] ?>"><button class="btn btn-success"><i class="fas fa-fw fa-backward"></i></button></a>
                                            <hr>
                                            <a target="_blank" href="<?= BASE_URL ?>/print/buktiKembali.php?id_reserv=<?= $d["id_reserv"] ?>"><button class="btn btn-dark"><i class="fas fa-fw fa-download"></i></button></a>
                                            <hr>
                                            <?php
                                            if ($_SESSION['fk_role'] == 'admin') {
                                                echo '
                                        <a href="' . BASE_URL . '/process/delete/process_hapusReserv.php?id_reserv=' . $d["id_reserv"] . '" data-id="' . $d["id_reserv"] . '" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></a></td>';
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>
                                        <td><?= $no++; ?></td>
                                        <td><?= $d['Nama_Peminjam']; ?></td>
                                        <td><?= $d['Nik']; ?></td>
                                        <td><?= $d['devisi']; ?></td>
                                        <td><?= $d['Jabatan']; ?></td>
                                        <td><?= $d['Tujuan']; ?></td>
                                        <td><?= $d['Pilih_Reserv']; ?></td>
                                        <td><?= $d['Plat_nomer']; ?></td>
                                        <td><?= $d['Merek']; ?></td>
                                        <td><?= $d['Tipe_Mobil']; ?></td>
                                        <td><?= $d['warna']; ?></td>
                                        <td><?= $d['WaktuIn'] ?? "-"; ?></td>
                                        <td><?= $d['KmIn']; ?></td>
                                        <td><img style="width: 100px;" src="<?= BASE_URL ?>/img/reserv/<?= $d['fotoin']; ?>" alt=""></td>
                                        <td><?= $d['status']; ?></td>
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
    </div>
    <script>
        $(document).ready(function() {
            // Tangani tombol "Hapus" yang diklik di dalam modal
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var idreserv = button.data('id'); // Ambil ID pegawai dari atribut data-id
                var modal = $(this);
                modal.find('.modal-body').html('Apakah Anda yakin ingin menghapus data ini ?');
                // Atur tindakan penghapusan ke URL yang benar
                modal.find('#hapus').attr('data-id', idreserv);
            });

            $('#hapus').click(function() {
                
                var idreserv = $(this).data('id');
                // Lakukan tindakan penghapusan sesuai dengan URL yang benar
                window.location.href = '<?= BASE_URL ?>/process/delete/process_hapusReserv.php?id_reserv=' + idreserv;
                
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