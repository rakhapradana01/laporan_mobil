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

    <title>APS RESERVASI </title>

    <?php include "../../template/header.php"; ?>

</head>

<body>
    <?php
    //bikin alert
    // $_SESSION['status'] = "berhasil";
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

    <!-- <select name="filter" id="">
        <option value=""></option>
    </select> -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Data reservasi</h1>
            <div class="card">
                <div class="card-body">
                    <div class="table-container">
                        <table id="myTable" class="display compact" style="width:100%">
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
                                    <th>Waktu OUT</th>
                                    <th>Waktu IN</th>
                                    <th>Km Out</th>
                                    <th>Foto keluar</th>
                                    <th>Km IN</th>
                                    <th>Foto masuk</th>
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
                                    join mobil on reserv.Plat_nomer=mobil.Plat_nomer;");
                                while ($d = mysqli_fetch_array($data)) {

                                ?>
                                    <tr>
                                        <td>
                                            <a href="<?= BASE_URL ?>/view/reservasi/updateReserv.php?id_reserv=<?php echo $d["id_reserv"] ?>"><button class="btn btn-success"><i class="fas fa-fw fa-pen"></i></button></a>
                                            <hr>
                                            <a href="<?= BASE_URL ?>/print/buktiReservasi.php?id_reserv=<?= $d["id_reserv"] ?>"><button class="btn btn-dark"><i class="fas fa-fw fa-download"></i></button></a>
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
                                        <td><?= $d['WaktuOut']; ?></td>
                                        <td><?= $d['WaktuIn'] ?? "-"; ?></td>
                                        <td><?= $d['KmOut']; ?></td>
                                        <td><img style="width: 100px;" src="<?= BASE_URL ?>/img/reserv/<?= $d['fotoout']; ?>" alt=""></td>
                                        <td><?= $d['KmIn']; ?></td>
                                        <td><img style="width: 100px;" src="<?= BASE_URL ?>/img/reserv/<?= $d['fotoin']; ?>" alt=""></td>
                                        <td><?= $d['status']; ?></td>
                                    </tr>
                                <?php
                                };
                                ?>
                            </tbody>
                        </table>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
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
                    modal.find('.modal-body').html('Apakah Anda yakin ingin menghapus pegawai dengan ID Reserv ' + idreserv + '?');
                    // Atur tindakan penghapusan ke URL yang benar
                    modal.find('.btn-primary').attr('data-id', idreserv);
                });

                $('#exampleModal .btn-primary').click(function() {
                    var idreserv = $(this).data('id');
                    // Lakukan tindakan penghapusan sesuai dengan URL yang benar
                    window.location.href = '<?= BASE_URL ?>/process/delete/process_hapusReserv.php?id_reserv=' + idreserv;
                });
            });
        </script>
        <center><a href="updateReserv.php;"></a></center>
        <?= include "../../template/footer.php"; ?>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({

                });
            });
        </script>
</body>

</html>
<style>
    .table-container {
        max-height: 800px;
        /* Adjust the maximum height as needed */
        overflow-y: auto;
    }
</style>