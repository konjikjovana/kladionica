<?php
include "sesija.php";
$_SESSION['aktivniTiket'][] =[
    'mecID' => $_GET['mecID'],
    'kvotaID' => $_GET['kvotaID']
];

header("Location: noviTiket.php");