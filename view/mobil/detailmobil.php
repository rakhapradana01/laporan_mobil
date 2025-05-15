<?php
include '../../function/koneksi.php';
include '../../function/helper.php';

$plat = $_GET['id'];
$dataMobil = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM mobil WHERE plat_nomer='$plat'"));

$historiPinjam = mysqli_query($koneksi, "SELECT * FROM reserv WHERE plat_nomer='$plat' ORDER BY WaktuOut DESC");
$historiService = mysqli_query($koneksi, "SELECT * FROM service WHERE plat_nomer='$plat' ORDER BY tanggal_service DESC");
$historiPerbaikan = mysqli_query($koneksi, "SELECT * FROM kelayakan WHERE plat_nomer='$plat' ORDER BY tanggal_service DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Mobil</title>
    <?php include '../../template/header.php'; ?>
</head>

<body>
    <div class="container mt-4">
        <div class="header-print d-print-flex justify-content-between align-items-center mb-3">
            <h3>Detail Mobil - <?= $dataMobil['plat_nomer']; ?></h3>
            <img src="logo2.jpg" alt="Logo" class="logo-print-only">
        </div>

        <hr>
        <table class="table table-bordered">
            <tr>
                <td>Merek</td>
                <td><?= $dataMobil['merek']; ?></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td><?= $dataMobil['tipe_mobil']; ?></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td><?= $dataMobil['warna']; ?></td>
            </tr>
            <tr>
                <td>No Mesin</td>
                <td><?= $dataMobil['noMesin']; ?></td>
            </tr>
            <tr>
                <td>No Rangka</td>
                <td><?= $dataMobil['noRangka']; ?></td>
            </tr>
        </table>

        <h4>Riwayat Peminjaman</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Peminjam</th>
                    <th>Tujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($p = mysqli_fetch_assoc($historiPinjam)) { ?>
                    <tr>
                        <td>
                            <?php
                            $date = new DateTime($p['WaktuOut']);
                            echo $date->format('d-m-Y');  // tanpa detik, format DD-MM-YYYY dan jam:menit
                            ?>
                        </td>
                        <td><?= $p['Pilih_Reserv']; ?></td>
                        <td><?= $p['Tujuan']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h4>Riwayat Service</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis Service</th>
                    <th>Km Berikutnya</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($s = mysqli_fetch_assoc($historiService)) { ?>
                    <tr>
                        <td>
                            <?php
                            $date = new DateTime($s['tanggal_service']);
                            echo $date->format('d-m-Y');  // tanpa detik, format DD-MM-YYYY dan jam:menit
                            ?>
                        </td>
                        <td><?= $s['jenis_service']; ?></td>
                        <td><?= $s['km_berikutnya']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h4>Riwayat Perbaikan</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kerusakan</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($historiPerbaikan)) { ?>
                    <tr>
                        <td>
                            <?php
                            $date = new DateTime($r['tanggal_service']);
                            echo $date->format('d-m-Y'); 
                            ?>
                        </td>

                        <td><?= $r['kerusakan']; ?></td>
                        <td><?= $r['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mb-4">
        <button class="btn btn-success" onclick="window.print();">
            🖨️ Print
        </button>
        <button class="btn btn-danger" onclick="window.history.back()">
            Back
        </button>
    </div>
</body>

</html>
<style>
    .header-print {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    /* Logo hanya muncul saat print */
    img.logo-print-only {
        display: none;
    }

    @media print {
        img.logo-print-only {
            display: block;
            max-width: 150px;
            /* sesuaikan ukuran logo */
            height: auto;
        }

        /* biar flex tetap jalan di print */
        .header-print {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button,
        .btn,
        .text-right {
            display: none !important;
        }

        body {
            margin: 0;
            padding: 20px;
            font-size: 12pt;
        }

        table {
            border-collapse: collapse !important;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000 !important;
            padding: 6px;
        }
    }
</style>
<script>

</script>