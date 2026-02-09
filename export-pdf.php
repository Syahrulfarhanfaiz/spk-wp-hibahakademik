<?php
session_start();
include('configdb.php');
require_once('tcpdf/tcpdf.php');

class PDF extends TCPDF
{
    public function Header()
    {
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 6, 'PEMERINTAH PROVINSI SUMATERA UTARA', 0, 1, 'C');
        $this->Cell(0, 6, 'DINAS PENDIDIKAN', 0, 1, 'C');
        $this->SetFont('helvetica', 'B', 13);
        $this->Cell(0, 6, 'SMA NEGERI 1 LIMA PULUH', 0, 1, 'C');
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 5, 'Lima Puluh, Kabupaten Batu Bara, Sumatera Utara', 0, 1, 'C');
        $this->Ln(2);
        $this->Line(15, 42, 195, 42);
        $this->Line(15, 43, 195, 43);
        $this->Ln(10);
    }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetMargins(20, 55, 20);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 8, 'LAPORAN HASIL PERANGKINGAN', 0, 1, 'C');
$pdf->Cell(0, 8, 'PENERIMA HIBAH AKADEMIK', 0, 1, 'C');
$pdf->Ln(8);

$pdf->SetFont('helvetica', '', 11);
$pdf->MultiCell(
    0,
    6,
    'Laporan ini disusun sebagai hasil dari proses seleksi penerima Hibah Akademik di SMA Negeri 1 Lima Puluh. '
        . 'Proses penilaian dilakukan menggunakan metode Weighted Product (WP) dengan mempertimbangkan beberapa kriteria '
        . 'yang telah ditetapkan oleh pihak sekolah. Hasil perangkingan ini digunakan sebagai dasar pengambilan keputusan '
        . 'dalam menentukan peserta didik yang paling layak menerima hibah akademik.',
    0,
    'J'
);

$pdf->Ln(6);

function get_alternatif()
{
    include 'configdb.php';
    $q = $mysqli->query("SELECT * FROM alternatif");
    $i = 0;
    while ($row = $q->fetch_assoc()) {
        $alt[$i][0] = $row['k1'];
        $alt[$i][1] = $row['k2'];
        $alt[$i][2] = $row['k3'];
        $alt[$i][3] = $row['k4'];
        $alt[$i][4] = $row['k5'];
        $i++;
    }
    return $alt;
}

function get_alt_name()
{
    include 'configdb.php';
    $q = $mysqli->query("SELECT * FROM alternatif");
    $i = 0;
    while ($row = $q->fetch_assoc()) {
        $alt[$i] = $row['alternatif'];
        $i++;
    }
    return $alt;
}

function get_kepentingan()
{
    include 'configdb.php';
    $q = $mysqli->query("SELECT * FROM kriteria");
    $i = 0;
    while ($row = $q->fetch_assoc()) {
        $kep[$i] = $row['kepentingan'];
        $i++;
    }
    return $kep;
}

function get_costbenefit()
{
    include 'configdb.php';
    $q = $mysqli->query("SELECT * FROM kriteria");
    $i = 0;
    while ($row = $q->fetch_assoc()) {
        $cb[$i] = $row['cost_benefit'];
        $i++;
    }
    return $cb;
}

$alt = get_alternatif();
$alt_name = get_alt_name();
$kep = get_kepentingan();
$cb = get_costbenefit();

$k = count($kep);
$a = count($alt);

$total_kep = array_sum($kep);
for ($i = 0; $i < $k; $i++) {
    $bkep[$i] = $kep[$i] / $total_kep;
    $pangkat[$i] = ($cb[$i] == 'cost') ? -$bkep[$i] : $bkep[$i];
}

for ($i = 0; $i < $a; $i++) {
    $ss[$i] = 1;
    for ($j = 0; $j < $k; $j++) {
        $ss[$i] *= pow($alt[$i][$j], $pangkat[$j]);
    }
}

$total_s = array_sum($ss);
for ($i = 0; $i < $a; $i++) {
    $v[$i] = $ss[$i] / $total_s;
}

arsort($v);

$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(10, 8, 'No', 1, 0, 'C');
$pdf->Cell(90, 8, 'Nama Peserta Didik', 1, 0, 'C');
$pdf->Cell(40, 8, 'Nilai Preferensi', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 11);
$no = 1;
foreach ($v as $i => $nilai) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(90, 8, $alt_name[$i], 1, 0);
    $pdf->Cell(40, 8, round($nilai, 6), 1, 1, 'C');
}

$topIndex = array_key_first($v);
$pdf->Ln(8);
$pdf->SetFont('helvetica', '', 11);
$pdf->MultiCell(
    0,
    6,
    'Berdasarkan hasil perhitungan dan perangkingan yang telah dilakukan, peserta didik atas nama '
        . $alt_name[$topIndex] . ' memperoleh nilai preferensi tertinggi. Dengan demikian, peserta didik tersebut '
        . 'dinyatakan sebagai kandidat yang paling layak untuk menerima Hibah Akademik di SMA Negeri 1 Lima Puluh.',
    0,
    'J'
);

$pdf->Ln(15);
$pdf->Cell(0, 6, 'Lima Puluh, ' . date('d F Y'), 0, 1, 'R');
$pdf->Ln(15);
$pdf->Cell(0, 6, 'Kepala SMA Negeri 1 Lima Puluh', 0, 1, 'R');
$pdf->Ln(20);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(0, 6, '__________________________', 0, 1, 'R');

$pdf->Output('Laporan_Peringkat_Penerima_Hibah_Akademik.pdf', 'I');
