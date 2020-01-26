<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();
$metoda = $_GET['metoda'];

switch ($metoda){
    case 'aktivniMecevi':
        $meceviNaTiketu = $_SESSION['aktivniTiket'];
        $mecevi = [];
        foreach ($meceviNaTiketu as $item) {
            $mecevi[] = $item['mecID'];
        }
        echo json_encode($baza->vratiAktivneMeceve($mecevi));
        break;
    case 'login':
        $korisnik = $baza->login($_POST['username'],$_POST['password']);
        if($korisnik != null){
            $_SESSION['ulogovan'] = true;
            $_SESSION['tipKorisnika'] = $korisnik->tipKorisnika;
            $_SESSION['korisnikID'] = $korisnik->korisnikID;
            $_SESSION['imePrezime'] = $korisnik->imePrezime;
            $_SESSION['balans'] = $korisnik->balans;
            header("Location: index.php");
        }else{
            header("Location: login.php?poruka=Neuspeno logovanje, proverite password i username");
        }
        break;
    case 'registracija':
        $uspesno = $baza->registruj($_POST['username'],$_POST['password'],$_POST['imeprezime']);
        if($uspesno){
            header("Location: registracija.php?poruka=Uspesno ste se registrovali");
        }else{
            header("Location: registracija.php?poruka=Registracija je neuspesna" );
        }
        break;
}