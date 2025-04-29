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



        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Surat Peminjaman Mobil Operasional Diluar Jam Operasional', 0, 1, 'C');
        $this->Cell(0, 1, '', 0, 1, 'l');

        // Tanggal
        // $this->SetFont('Arial', '', 10);
        // $this->Cell(0, 1, '', 0, 1, 'l');
        // $this->Cell(0, 7, 'Laporan Ini Berisikan Data Pegawai Yang Meminjam Mobil Operasional Di Luar Jam Operasional Perusahaan', 0, 1, 'C');
        // $this->Ln(4); // Spasi
    }

    // Footer
    function Footer()
    {
        // // Ttd
        // $this->SetY(-70);
        // $this->SetFont('Arial', 'B', 10);
        // $this->Cell(500, 4, 'Banjarmasin, ' . date('d F Y'), 0, 1, 'C');
        // $this->Cell(500, 4, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C'); // Mengubah tinggi menjadi 0
        // $this->Cell(500, 4, 'BRANCH MANAGER', 0, 1, 'C'); // Mengubah tinggi menjadi 0
        // $this->Ln(10); // Mengubah spasi 

        // // Nama dan Jabatan
        // $this->SetY(-40);
        // $this->SetFont('Arial', 'U', 10);
        // $this->Cell(500, 4, 'ALEXANDER DENALOVA', 0, 1, 'C');

        // // Tanggal Timestamp
        // $this->SetFont('Arial', '', 8);
        // $this->Cell(500, 4, 'Tanggal: ' . date('d F Y H:i:s'), 0, 1, 'C'); // Menampilkan tanggal timestamp
        // $this->SetY(-15);
        // $this->SetFont('Arial', 'I', 8);
        // $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
        $this->Cell(0, 5, 'Tanggal        : ' . date('d F Y'), 0, 1, 'L');
        $this->Cell(0, 5, 'Dicetak oleh : ' . $_SESSION['nama'], 0, 1, 'L');
        $this->Ln(4); // Spasi
    }
}

// Create PDF instance
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$sql = 'select 
id_reserv,
    pegawai.Nama as Nama_Peminjam,
    pegawai.id_nik as Nik,
    pegawai.fk_devisi as Devisi,
    pegawai.Jabatan as Jabatan,
    Tujuan,
    Pilih_Reserv,
    mobil.plat_nomer as plat_nomer,
    mobil.Merek as merek,
    mobil.tipe_mobil as tipe_mobil,
    mobil.Warna as warna,
DATE_FORMAT(WaktuOut,"%d-%m-%y %H:%i") as WaktuOut,
DATE_FORMAT(WaktuIn,"%d-%m-%y %H:%i") as WaktuIn,
KmOut,
fotoout,
KmIn, 
fotoin,
status
from reserv 
join pegawai on id_nik=reserv.Nik 
join mobil on reserv.Plat_nomer=mobil.plat_nomer
where id_reserv=' . $_GET['id_reserv'];
$result = $koneksi->query($sql)->fetch_assoc();
// Add content to the PDF
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(155, 10, 'Nama            :  ' . $result['Nama_Peminjam'], 0, 1, '');
$pdf->Cell(155, 10, 'Nik                :  ' . $result['Nik'], 0, 1, '');
$pdf->Cell(155, 10, 'Devisi           :  ' . $result['Devisi'], 0, 1, '');
$pdf->Cell(155, 10, 'Jabatan         :  ' . $result['Jabatan'], 0, 1, '');
$pdf->Cell(155, 10, 'Tujuan           :  ' . $result['Tujuan'], 0, 1, '');
$pdf->Cell(155, 10, 'NO.Plat         :  ' . $result['plat_nomer'], 0, 1, '');
$pdf->Cell(155, 10, 'Merek            :  ' . $result['merek'], 0, 1, '');
$pdf->Cell(155, 10, 'Tipe               :  ' . $result['tipe_mobil'], 0, 1, '');
$pdf->Cell(155, 10, 'Warna            :  ' . $result['warna'], 0, 1, '');
$pdf->Cell(155, 10, 'Waktu Keluar  :  ' . $result['WaktuOut'], 0, 1, '');
$pdf->Cell(155, 10, 'Waktu Masuk  :  ' . $result['WaktuIn'], 0, 1, '');
$pdf->Cell(155, 10, 'KM keluar        :  ' . $result['KmOut'], 0, 1, '');
$pdf->Cell(155, 10, 'KM masuk        :  ' . $result['KmIn'], 0, 1, '');
// $pdf->Cell(155, 10, 'status          :  ' . $result['status'], 0, 1, '');
$pdf->SetY(-40);
$pdf->Cell(0, 5, 'Tanggal        : ' . date('d F Y'), 0, 1, 'L');
$pdf->Cell(0, 5, 'Dicetak oleh : ' . $_SESSION['nama'], 0, 1, 'L');
$pdf->SetY(-80);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(320, 4, 'Banjarmasin, ' . date('d F Y'), 0, 1, 'C');
$pdf->Cell(320, 4, 'PT. ANGKASA PURA SUPPORT', 0, 1, 'C'); // Mengubah tinggi menjadi 0
$pdf->Cell(320, 4, 'BRANCH MANAJER', 0, 1, 'C'); // Mengubah tinggi menjadi 0
$pdf->Ln(10); // Mengubah spasi 

// Nama dan Jabatan
$pdf->SetY(-40);
$pdf->SetFont('Arial', 'U', 10);
$pdf->Cell(320, 4, 'ALEXANDER DENALOVA', 0, 1, 'C');

// Tanggal Timestamp
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(320, 4, 'Tanggal: ' . date('d F Y H:i:s'), 0, 1, 'C'); // Menampilkan tanggal timestamp


// Output the PDF
$pdf->Output();
