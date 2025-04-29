<?php
require_once('../function/helper.php');
require_once('../function/koneksi.php');
// include "config.php";
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Header
    function Header()
    {
        // Jarak antara logo dan teks
        $this->Ln(10); // Sesuaikan jarak yang diinginkan
        // Kop surat
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 7, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C');
        $this->Cell(0, 7, 'CABANG  BANJARMASIN', 0, 1, 'C');


        // Ganti font ke normal
        $this->SetFont('Arial', '', 9);

        // Tambahkan alamat PT
        $this->Cell(0, 5, 'Kantor Cabang: Jl. Kasturi 1 No.73, Landasan Ulin Utara, Kec. Liang Anggang, Kota Banjar Baru, Kalimantan Selatan 70724', 0, 1, 'C');
        $this->Ln(10); // Spasi


        // Garis bawah ganda
        $this->SetLineWidth(0.2); // Mengatur ketebalan garis menjadi 2
        $this->Cell(0, 5, '', 'T'); // Baris pertama
        $this->Ln(1); // Spasi antara garis bawah
        $this->Cell(0, 5, '', 'T'); // Baris kedua
        $this->SetLineWidth(0.2); // Mengembalikan ketebalan garis ke 0.2 setelah garis ganda



        // Logo
        $this->Image('logo2.jpg', 8, 13, 40);
        $this->Ln(4); // Spasi



        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Laporan Peminjaman Mobil Operasional', 0, 1, 'C');

        // Tanggal
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Tanggal        : ' . date('d F Y'), 0, 1, 'L');
        $this->Cell(0, 5, 'Dicetak oleh : ' . $_SESSION['nama'], 0, 1, 'L');
        $this->Ln(7); // Spasi

    }

    // Footer
    function Footer()
    {



        // $this->SetY(-15);
        // $this->SetFont('Arial', 'I', 8);
        // $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Create PDF instance
$pdf = new PDF('L', 'mm', array(400, 200));
$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Arial', '', 10);

// Add table headers
$pdf->Cell(10, 10, 'No', 1);
$pdf->Cell(35, 10, 'Nama Peminjam', 1);
$pdf->Cell(15, 10, 'Nik', 1);
$pdf->Cell(60, 10, 'Devisi', 1);
$pdf->Cell(15, 10, 'Jabatan', 1);
$pdf->Cell(45, 10, 'Tujuan', 1);
$pdf->Cell(20, 10, 'Pilih Reser', 1);
$pdf->Cell(25, 10, 'Plat no', 1);
$pdf->Cell(30, 10, 'Merek', 1);
$pdf->Cell(20, 10, 'Tipe', 1);
$pdf->Cell(20, 10, 'Warna', 1);
$pdf->Cell(30, 10, 'Time-Out', 1);
$pdf->Cell(30, 10, 'Time-In', 1);
$pdf->Cell(15, 10, 'KM-Out', 1);
$pdf->Cell(15, 10, 'KM-In', 1);
// $pdf->Cell(20, 10, 'Status', 1);
$pdf->Ln();

// Fetch data and add rows to the PDF
// include 'config.php';
$sql = 'select 
id_reserv,
Nama_Peminjam,
pegawai.id_nik as Nik,
Devisi,
pegawai.Jabatan as Jabatan,
Tujuan,
Pilih_Reserv,
mobil.plat_nomer as Plat_nomer,
mobil.Merek,
mobil.Tipe_Mobil,
mobil.Warna,
DATE_FORMAT(WaktuOut,"%d-%m-%y %H:%i") as WaktuOut,
DATE_FORMAT(WaktuIn,"%d-%m-%y %H:%i") as WaktuIn,
KmOut,
fotoout,
KmIn, 
fotoin,
status
from reserv 
join pegawai on id_nik=reserv.Nik 
join mobil on reserv.Plat_nomer=mobil.id';
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {

    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $no++, 1);
        $pdf->Cell(35, 10, $row['Nama_Peminjam'], 1);
        $pdf->Cell(15, 10, $row['Nik'], 1);
        $pdf->Cell(60, 10, $row['Devisi'], 1);
        $pdf->Cell(15, 10, $row['Jabatan'], 1);
        $pdf->Cell(45, 10, $row['Tujuan'], 1);
        $pdf->Cell(20, 10, $row['Pilih_Reserv'], 1);
        $pdf->Cell(25, 10, $row['Plat_nomer'], 1);
        $pdf->Cell(30, 10, $row['Merek'], 1);
        $pdf->Cell(20, 10, $row['Tipe_Mobil'], 1);
        $pdf->Cell(20, 10, $row['Warna'], 1);
        $pdf->Cell(30, 10, $row['WaktuOut'], 1);
        $pdf->Cell(30, 10, $row['WaktuIn'], 1);
        $pdf->Cell(15, 10, $row['KmOut'], 1);
        $pdf->Cell(15, 10, $row['KmIn'], 1);
        // $pdf->Cell(20, 10, $row['status'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(180, 10, 'Tidak ada data.', 1, 0, 'C');
}


$pdf->SetY(-60);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(650, 4, 'Banjarmasin, ' . date('d F Y'), 0, 1, 'C');
$pdf->Cell(650, 4, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C'); // Mengubah tinggi menjadi 0
$pdf->Cell(650, 4, 'BRANCH MANAJER', 0, 1, 'C'); // Mengubah tinggi menjadi 0
$pdf->Ln(10); // Mengubah spasi 

// Nama dan Jabatan
$pdf->SetY(-30);
$pdf->SetFont('Arial', 'U', 10);
$pdf->Cell(650, 4, 'ALEXANDER DENALOVA', 0, 1, 'C');

// Tanggal Timestamp
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(650, 4, 'Tanggal: ' . date('d F Y H:i:s'), 0, 1, 'C'); // Menampilkan tanggal timestamp


// Output the PDF
$pdf->Output();
