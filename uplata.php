<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();

$uplata = $_POST['uplata'];
$korisnikID = $_POST['korisnikID'];

$trenutniBalans = $baza->vratiTrenutniBalans($korisnikID);

$noviBalans = $trenutniBalans + $uplata;

$sacuvano = $baza->promeniBalans($noviBalans,$korisnikID);

if($sacuvano){
    echo "Uplata uspesna";
}else{
    echo "Greska pri uplati";
}