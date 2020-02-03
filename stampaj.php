<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();

$tiketID = $_GET['tiketID'];

$niz = [];

$tiket = $baza->vratiTiket($tiketID);

$odigrano = $baza->vratiOdigraneUtakmice($tiketID);
$ukupnaKvota = 1;
foreach ($odigrano as $o){
    $ukupnaKvota = $ukupnaKvota * $o->kvota;
}

require('pdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(50, 7, "Mec");
$pdf->Cell(30, 7, "Ishod");
$pdf->Cell(40, 7, "Igra");
$pdf->Cell(30, 7, "Kvota");
$pdf->Ln();
$pdf->Cell(450, 7, "----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();

foreach ($odigrano as $p) {
    $pdf->Cell(50, 7, $p->domacin . " " . $p->gost);
    $pdf->Cell(30, 7, $p->ishod);
    $pdf->Cell(40, 7, $p->nazivIgre);
    $pdf->Cell(30, 7, $p->kvota);

    $pdf->Ln();
}

$pdf->Cell(50, 7, "Ukupna kvota:");
$pdf->Cell(30, 7, $ukupnaKvota);
$pdf->Cell(40, 7, "Moguc dobitak");
$pdf->Cell(30, 7, $ukupnaKvota * $tiket->ulog . " dinara");

$pdf->Ln();

$pdf->Cell(120, 7, "Ulog:");
$pdf->Cell(30, 7,  $tiket->ulog. " dinara");

$pdf->Ln();

$pdf->Output();

