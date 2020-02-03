<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();

$uplata = $_POST['uplata'];
$korisnikID = $_POST['korisnikID'];

$uspesno = $baza->napraviTiket($uplata,$korisnikID);
if($uspesno){
    $tiketID = $baza->vratiPoslednjiID();

    foreach ($_SESSION['aktivniTiket'] as $item){
        $kvotaID = $item['kvotaID'];
        $baza->sacuvajOdigrano($tiketID,$kvotaID);
    }

    $noviBalans = $_SESSION['balans'] - $uplata;

    $baza->promeniBalans($noviBalans,$korisnikID);

    $_SESSION['aktivniTiket'] = [];
    $_SESSION['balans'] = $noviBalans;

    echo "Tiket uspesno kreiran";
}else{
    echo "Greska pri kreiranju tiketa";
}