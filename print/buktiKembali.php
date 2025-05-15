<?php
require_once('../function/helper.php');
require_once('../function/koneksi.php');
require('../fpdf/fpdf.php');
class PDF extends FPDF{

    function Header()
    {
        // Logo
        $this->Image('logo2.jpg', 10, 8, 25);

        // Header Title
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 7, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C');
        $this->Cell(0, 7, 'CABANG BANJARMASIN', 0, 1, 'C');

        // Alamat
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, 'Jl. Kasturi 1 No.73, Landasan Ulin Utara, Liang Anggang, Banjar Baru, Kalimantan Selatan 70724', 0, 1, 'C');

        // Garis ganda
        $this->Ln(2);
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->SetLineWidth(0.1);
        $this->Line(10, $this->GetY() + 1, 200, $this->GetY() + 1);
        $this->Ln(5);

        // Judul Surat
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 8, 'SURAT BUKTI PENGEMBALIAN MOBIL OPERASIONAL DI LUAR JAM OPERASIONAL', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-20);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, 'Dicetak oleh: ' . $_SESSION['nama'], 0, 1, 'L');
        $this->Cell(0, 5, 'Tanggal cetak: ' . date('d F Y H:i:s'), 0, 0, 'L');
    }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();

// Ambil data dari database
$id_reserv = $_GET['id_reserv'];
$sql = "SELECT 
    reserv.id_reserv,
    pegawai.Nama AS Nama_Peminjam,
    pegawai.id_nik AS Nik,
    pegawai.fk_devisi AS Devisi,
    pegawai.Jabatan AS Jabatan,
    reserv.Tujuan,
    reserv.Pilih_Reserv,
    mobil.plat_nomer AS plat_nomer,
    mobil.Merek AS merek,
    mobil.tipe_mobil AS tipe_mobil,
    mobil.Warna AS warna,
    DATE_FORMAT(reserv.WaktuOut,'%d-%m-%Y %H:%i') AS WaktuOut,
    DATE_FORMAT(reserv.WaktuIn,'%d-%m-%Y %H:%i') AS WaktuIn,
    reserv.KmOut,
    reserv.fotoout,
    reserv.KmIn, 
    reserv.fotoin
    FROM reserv
    JOIN pegawai ON reserv.Nik = pegawai.id_nik
    JOIN mobil ON reserv.Plat_nomer = mobil.plat_nomer
    WHERE id_reserv = '$id_reserv'";
    
$result = $koneksi->query($sql)->fetch_assoc();

$pdf->SetFont('Arial', '', 10);

// Informasi peminjam
$fields = [
    'Nama' => $result['Nama_Peminjam'],
    'NIK' => $result['Nik'],
    'Devisi' => $result['Devisi'],
    'Jabatan' => $result['Jabatan'],
    'Tujuan' => $result['Tujuan'],
    'No. Plat' => $result['plat_nomer'],
    'Merek' => $result['merek'],
    'Tipe Mobil' => $result['tipe_mobil'],
    'Warna' => $result['warna'],
    'Waktu Keluar' => $result['WaktuOut'],
    'Waktu Masuk' => $result['WaktuIn'],
    'KM Keluar' => $result['KmOut'],
    'KM Masuk' => $result['KmIn']
];

foreach ($fields as $label => $value) {
    $pdf->Cell(50, 7, $label, 0, 0);
    $pdf->Cell(5, 7, ':', 0, 0);
    $pdf->Cell(120, 7, $value, 0, 1);
}

$pdf->Ln(10);
$pdf->MultiCell(0, 7, 'Dengan ini menyatakan bahwa yang bersangkutan melakukan peminjaman kendaraan operasional di luar jam kerja perusahaan, dengan tujuan dan informasi di atas. Surat ini dibuat sebagai bukti resmi peminjaman kendaraan dan wajib diserahkan kepada pihak berwenang saat diperlukan.');

$pdf->Ln(15);

// Tanda tangan
$tanggal = date('d F Y');
$pdf->Cell(120); $pdf->Cell(60, 7, 'Banjarmasin, ' . $tanggal, 0, 1, 'C');
$pdf->Cell(120); $pdf->Cell(60, 7, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C');
$pdf->Cell(120); $pdf->Cell(60, 7, 'BRANCH MANAGER', 0, 1, 'C');
$pdf->Ln(20);
$pdf->SetFont('Arial', 'U', 10);
$pdf->Cell(120); $pdf->Cell(60, 7, 'ALEXANDER DENALOVA', 0, 1, 'C');

$pdf->Output();
