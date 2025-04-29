<?php
require_once('../function/helper.php');
require_once('../function/koneksi.php');
// include "config.php";
require('../fpdf/fpdf.php'); // Include the FPDF library

class PDF extends FPDF
{
    // Header
    function Header()
    {
        // Jarak antara logo dan teks
        $this->Ln(10); // Sesuaikan jarak yang diinginkan
        // Kop surat
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 7, 'PT. APLIKANUSA LINTASARTA', 0, 1, 'C');
        $this->Cell(0, 7, 'CABANG KOTA BANJARMASIN', 0, 1, 'C');


        // Ganti font ke normal
        $this->SetFont('Arial', '', 9);

        // Tambahkan alamat PT
        $this->Cell(0, 5, 'Kantor Cabang: Jl. Pramuka No.40C Kota Banjarmasin Kalimantan Selatan', 0, 1, 'C');
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
        $this->Cell(0, 10, 'Laporan Semua Data Barang', 0, 1, 'C');

        // Tanggal
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Tanggal        : ' . date('d F Y'), 0, 1, 'L');
        $this->Cell(0, 5, 'Dicetak oleh : Gusti Yulia ', 0, 1, 'L');
        $this->Ln(7); // Spasi

    }

    // Footer
    function Footer()
    {
        // ...

        // Ttd
        // $this->SetY(-90);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(100, 4, 'Banjarmasin, ' . date('d F Y'), 0, 1, 'C');
        // $this->Cell(100, 4, 'PT. Aplikanusa Lintasarta', 0, 1, 'C'); // Mengubah tinggi menjadi 0
        // $this->Cell(100, 4, 'Jabatan', 0, 1, 'C'); // Mengubah tinggi menjadi 0
        // $this->Ln(10); // Mengubah spasi 

        // // Nama dan Jabatan
        // $this->SetY(-60);
        // $this->SetFont('Arial', 'U', 10);
        // $this->Cell(100, 4, 'Suharitomo', 0, 1, 'C');

        // // Tanggal Timestamp
        // $this->SetFont('Arial', '', 8);
        // $this->Cell(100, 4, 'Tanggal: ' . date('d F Y H:i:s'), 0, 1, 'C'); // Menampilkan tanggal timestamp

        // Halaman
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Create PDF instance
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Arial', '', 10);

// Add table headers
$pdf->Cell(10, 10, 'No', 1);
$pdf->Cell(35, 10, 'Plat nomer', 1);
$pdf->Cell(25, 10, 'deskripsi', 1);
$pdf->Cell(30, 10, 'status', 1);
$pdf->Cell(35, 10, 'tgl', 1);
$pdf->Ln();

// Fetch data and add rows to the PDF
// include 'config.php';
$id = $_GET['id'];
$sql = "select * from perbaikan where id=$id";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {

    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $no++, 1);
        $pdf->Cell(35, 10, $row['plat_nomer'], 1);
        $pdf->Cell(25, 10, $row['deskripsi'], 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Cell(35, 10, $row['tgl'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(180, 10, 'Tidak ada data.', 1, 0, 'C');
}

// Output the PDF
$pdf->Output();
