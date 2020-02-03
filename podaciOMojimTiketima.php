<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();

$niz = [];

$tiketi = $baza->vratiTiketeZaKorisnika($_SESSION['korisnikID']);

foreach ($tiketi as $tiket){
    $odigrano = $baza->vratiOdigraneUtakmice($tiket->tiketID);
    $ukupnaKvota = 1;
    foreach ($odigrano as $o){
        $ukupnaKvota = $ukupnaKvota * $o->kvota;
    }

    $niz[] = [
        'ukupnaKvota' => $ukupnaKvota,
        'uplata' => $tiket->ulog,
        'dobitak' => $ukupnaKvota * $tiket->ulog,
        'status' => $tiket->statusTiketa
    ];
}

?>

<table class="table table-dark">
    <thead>
    <tr>
        <th>Ukupna kvota</th>
        <th>Uplata</th>
        <th>Moguc dobitak</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach ($niz as $item) {
        ?>
            <tr>
                <td><?= $item['ukupnaKvota'] ?></td>
                <td><?= $item['uplata'] ?> dinara</td>
                <td><?= $item['dobitak'] ?> dinara</td>
                <td><?php
                    if($item['status'] === 'Dobitan'){
                        ?>
                        <span style="color: forestgreen"> <?= $item['status'] ?></span>
                    <?php
                    }

                    if($item['status'] === 'Pao'){
                        ?>
                        <span style="color: darkred"> <?= $item['status'] ?></span>
                        <?php
                    }
                    if($item['status'] === 'Tekuci'){
                        ?>
                        <span style="color: #fff"> <?= $item['status'] ?></span>
                        <?php
                    }
                    ?></td>
            </tr>
    <?php
    }
    ?>

    </tbody>
</table>

