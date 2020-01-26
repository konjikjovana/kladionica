<?php
if($_SESSION['ulogovan'] == false){
    include 'guestMeni.php';
}else{
    $tipKorisnika = $_SESSION['tipKorisnika'];
    if($tipKorisnika == 'Kockar'){
        include 'kockarMeni.php';
    }
    if($tipKorisnika == 'Radnik'){
        include 'radnikMeni.php';
    }
}