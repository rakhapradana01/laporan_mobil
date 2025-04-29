<?php
require_once('../function/helper.php');
require_once('../function/koneksi.php');
$page = 'dashboard';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>APS RESERVASI</title>

    <!-- Custom fonts for this template-->
    <?php include "../template/header.php"; ?>

</head>

<body>
    <?php
    include '../template/sidebar.php';
    include '../template/topbar.php';
    // $sidebar = '../template/sidebar.p7hp';
    // $topbar = '../template/topbar.php';
    // if ($_SESSION['fk_role'] !== 'admin') {
    //     // header("location: " . BASE_URL . '/view/dashboard.php?page=user');
    //     // exit();
    // }
    // if (file_exists($sidebar) && file_exists($topbar)) {
    // } else {
    //     echo "404";
    // }
    $mobil = mysqli_query($koneksi, "select count(plat_nomer) from mobil");
    $jumlahMobil = mysqli_fetch_array($mobil)[0];

    $reserv = mysqli_query($koneksi, "select count(id_reserv) from reserv");
    $jumlahreserv = mysqli_fetch_array($reserv)[0];

    $pegawai = mysqli_query($koneksi, "select count(id_nik) from pegawai");
    $jumlahpegawai = mysqli_fetch_array($pegawai)[0];

    $status = mysqli_query($koneksi, "select count(status) from reserv");
    $jumlahstatus = mysqli_fetch_array($status)[0];

    if (!empty($_SESSION['Nik'])) {
       echo "
         <script type='text/javascript'>
                swal({
                    title: 'Informasi',
                    text: 'Login Berhasil',
                    icon: 'success',
                    button: 'OK',
                });
         </script>";
    }
    unset($_SESSION['Nik']);

    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h2>Dashboard</h2>
        </div>
      
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah mobil
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahMobil; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-car fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Reservasi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahreserv; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pegawai
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlahpegawai; ?></div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Status</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahstatus; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        <main>
            <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>History Data Reservasi</h3>
					</div>
					<table>
						<thead>
							<tr>
                                <th>Nomor</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Tujuan</th>
                                <th>Tipe Mobil</th>
                                <th>Waktu In</th>
                                <th>Foto</th>
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
                                        
                                        <td><?= $no++; ?></td>
                                        <td><?= $d['Nama_Peminjam']; ?></td>
                                        <td><?= $d['Nik']; ?></td>
                                        <td><?= $d['Tujuan']; ?></td>
                                        <td><?= $d['Tipe_Mobil']; ?></td>
                                        <td><?= $d['WaktuIn'] ?? "-"; ?></td>
                                        <td><img src="<?= BASE_URL ?>/img/reserv/<?= $d['fotoin']; ?>" alt=""></td>
                                        <td><?= $d['status']; ?></td>
                                    </tr>
                                <?php } ?>
							<tr>
								
						</tbody>
					</table>
				</div>
				
			</div>
        </main>
        </div>


    </div>
    <!-- /.container-fluid -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../js/script.js"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>