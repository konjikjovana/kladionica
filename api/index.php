<?php
require 'flight/Flight.php';
require 'jsonindent.php';
require '../Baza.php';


Flight::route('/', function(){
	echo "Kladite se pametno";
});

Flight::register('db', 'Baza', array(''));

Flight::route('GET /podaciOTiketima', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci = $db->vratiTiketeGrafik();

	$niz =  [];

	foreach ($podaci as $item) {
		$niz[] = $item;
	}

	echo indent(json_encode($niz));
});

Flight::route('GET /podaciGrafik', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci = $db->podaciGrafik();

	$niz =  [];

	foreach ($podaci as $item) {
		$niz[] = $item;
	}

	echo indent(json_encode($niz));
});

Flight::route('GET /ishodi', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci = $db->vratiIshode();

	$niz =  [];

	foreach ($podaci as $item) {
		$niz[] = $item;
	}

	echo indent(json_encode($niz));
});

Flight::route('GET /igre', function()
{
	header("Content-Type: application/json; charset=utf-8");
	$db = Flight::db();
	$podaci = $db->vratiIgre();

	$niz =  [];

	foreach ($podaci as $item) {
		$niz[] = $item;
	}

	echo indent(json_encode($niz));
});




Flight::start();
?>
