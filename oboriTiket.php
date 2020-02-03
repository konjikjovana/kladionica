<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();

$tiketID = $_GET['tiketID'];

$uspesno = $baza->promeniStatusTiketa('Pao',$tiketID);

if($uspesno){
    header("Location: administracijaTiketa.php?poruka=Uspesno oboren tiket");
}else{
    header("Location: administracijaTiketa.php?poruka=Doslo je do greske");
}