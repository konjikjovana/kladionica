<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();

$dobitak = $_GET['dobitak'];
$korisnikID = $_GET['korisnikID'];
$tiketID = $_GET['tiketID'];

$baza->promeniStatusTiketa('Dobitan',$tiketID);

$trenutniBalans = $baza->vratiTrenutniBalans($korisnikID);
$povecanje = $trenutniBalans + $dobitak;
$uspesno = $baza->promeniBalans($povecanje,$korisnikID);

if($uspesno){
    header("Location: administracijaTiketa.php?poruka=Uspesno izvrsena isplata");
}else{
    header("Location: administracijaTiketa.php?poruka=Doslo je do greske");
}