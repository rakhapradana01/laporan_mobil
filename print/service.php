<?php
require_once('../function/helper.php');
require_once('../function/koneksi.php');
require('../fpdf/fpdf.php'); // Include the FPDF library

class PDF extends FPDF
{
    // Header
    function Header()
    {
        // Jarak antara logo dan teks
        $this->Ln(3); // Sesuaikan jarak yang diinginkan
        // Kop surat
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 7, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C');
        $this->Cell(0, 7, 'CABANG  BANJARMASIN', 0, 1, 'C');

        // Ganti font ke normal
        $this->SetFont('Arial', '', 9);

        // Tambahkan alamat PT
        $this->Cell(0, 5, 'Kantor Cabang: Jl. Kasturi 1 No.73, Landasan Ulin Utara, Kec. Liang Anggang, Kota Banjar Baru, Kalimantan Selatan 70724', 0, 1, 'C');
        $this->Ln(3); // Spasi

        // Garis bawah ganda
        $this->SetLineWidth(0.4); // Mengatur ketebalan garis menjadi 2
        $this->Cell(0, 5, '', 'T'); // Baris pertama
        $this->Ln(0); // Spasi antara garis bawah
        $this->Cell(0, 0, '', 'T'); // Baris kedua
        $this->SetLineWidth(0.2); // Mengembalikan ketebalan garis ke 0.2 setelah garis ganda

        // Logo
        $this->Image('logo2.jpg', 8, 13, 40);
        $this->Ln(4); // Spasi

        // Judul
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'DATA SERVICE MOBIL OPERASIONAL', 0, 1, 'C');

        // Tanggal
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Tanggal        : ' . date('d F Y'), 0, 1, 'L');
        $this->Cell(0, 5, 'Dicetak oleh : ' . $_SESSION['nama'], 0, 1, 'L');
        $this->Ln(4); // Spasi
    }

    // Footer
    function Footer()
    {
        // Posisi footer di bagian bawah (1,5 cm dari bawah)
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Create PDF instance with Landscape orientation
$pdf = new PDF('L', 'mm'); // Mengubah 'P' menjadi 'L' untuk Landscape
$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Arial', '', 9);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);  // Tambahkan margin kanan agar tabel lebih rapi

// Add table headers
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(35, 10, 'Plat Nomer', 1, 0, 'C');
$pdf->Cell(30, 10, 'Merek', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tipe', 1, 0, 'C');
$pdf->Cell(30, 10, 'Warna', 1, 0, 'C');
$pdf->Cell(45, 10, 'Jenis Service', 1, 0, 'C');
$pdf->Cell(45, 10, 'Km Service Sekarang', 1, 0, 'C');
$pdf->Cell(45, 10, 'Km Service Berikutnya', 1, 1, 'C'); // Menambahkan baris baru setelah header

// Fetch data and add rows to the PDF
if ($_POST['service'] == 'semua') {
    $sql = 'select * from service join mobil on service.plat_nomer=mobil.plat_nomer';
} else {
    $sql = 'select * from service join mobil on service.plat_nomer=mobil.plat_nomer where jenis_service="' . $_POST['service'] . '"';
}
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $no++, 1, 0, 'C');
        $pdf->Cell(35, 10, $row['plat_nomer'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['merek'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['tipe_mobil'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['warna'], 1, 0, 'C');
        $pdf->Cell(45, 10, $row['jenis_service'], 1, 0, 'C');
        $pdf->Cell(45, 10, $row['km_sekarang'], 1, 0, 'C');
        $pdf->Cell(45, 10, $row['km_berikutnya'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(300, 10, 'Tidak ada data.', 1, 0, 'C');
}

$pdf->SetY(-60);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(450, 4, 'Banjarmasin, ' . date('d F Y'), 0, 1, 'C');
$pdf->Cell(450, 4, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C'); // Mengubah tinggi menjadi 0
$pdf->Cell(450, 4, 'BRANCH MANAJER', 0, 1, 'C'); // Mengubah tinggi menjadi 0
$pdf->Ln(10); // Mengubah spasi 

// Nama dan Jabatan
$pdf->SetY(-30);
$pdf->SetFont('Arial', 'U', 10);
$pdf->Cell(450, 4, 'ALEXANDER DENALOVA', 0, 1, 'C');

// Tanggal Timestamp
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(450, 4, 'Tanggal: ' . date('d F Y'), 0, 1, 'C'); // Menampilkan tanggal timestamp
// Output the PDF
$pdf->Output();
