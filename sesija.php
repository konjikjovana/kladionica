<?php
session_start();

if(!isset($_SESSION['ulogovan'])){
    $_SESSION['ulogovan'] = false;
}

if(!isset($_SESSION['aktivniTiket'])){
    $_SESSION['aktivniTiket'] = [];
}