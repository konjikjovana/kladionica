<?php
include 'sesija.php';
include 'Baza.php';
$baza = new Baza();

$niz = [];

$poruka = "";

if(isset($_GET['poruka'])){
    $poruka = $_GET['poruka'];
}

$tiketi = $baza->vratiTikete();

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
        'status' => $tiket->statusTiketa,
        'tiketID' => $tiket->tiketID,
        'korisnikID' => $tiket->korisnikID
    ];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smart Bet</title>

    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <header class="header-area">
        <div class="top-header-area d-flex justify-content-between align-items-center">
            <div class="contact-info">
                <a href="#"><span>Phone:</span> +381 62 8720 566 </a>
                <a href="#"><span>Email:</span> konjikjp@gmail.com</a>
            </div>
            <div class="follow-us">
                <span>Follow us</span>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </div>

        <?php include "meni.php"; ?>
    </header>

    <section class="hero-area bg-img bg-overlay-2by5" style="background-image: url(img/pocetna.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h2 style="font-size: 85px;">SmartBet</h2>
                        <p style="font-size: 50px; color: #ffffff">Kladite se pametno</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-courses-area section-padding-100-0" style="background-image: url(img/core-img/texture.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Administracija tiketa</h3>
                        <p><?= $poruka ?></p>
                    </div>
                </div>

                <div class="col-12" >
                    <table class="table table-hover" id="tabela">
                        <thead>
                        <tr>
                            <th>Ukupna kvota</th>
                            <th>Uplata</th>
                            <th>(Moguc) Dobitak</th>
                            <th>Status</th>
                            <th>Isplati</th>
                            <th>Oznaci pad tiketa</th>
                            <th>Odstampaj</th>
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
                                        <span style="color: #000"> <?= $item['status'] ?></span>
                                        <?php
                                    }
                                    ?></td>
                                <td>
                                    <?php
                                    if($item['status'] === 'Tekuci'){
                                        ?>
                                        <a class="btn btn-success" href="isplati.php?tiketID=<?= $item['tiketID'] ?>&dobitak=<?= $item['dobitak'] ?>&korisnikID=<?= $item['korisnikID'] ?>">Isplati</a>
                                        <?php
                                    }else{
                                        echo "/";
                                    }
                                    ?>

                                </td>
                                <td>
                                    <?php
                                    if($item['status'] === 'Tekuci'){
                                        ?>
                                        <a class="btn btn-danger" href="oboriTiket.php?tiketID=<?= $item['tiketID'] ?>">Oznaci kao pao</a>
                                        <?php
                                    }else{
                                        echo "/";
                                    }
                                    ?>

                                </td>
                                <td>
                                    <a class="btn btn-info" href="stampaj.php?tiketID=<?= $item['tiketID'] ?>" target="_blank">Odstampaj tiket</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <div id="chart1" style="width: 900px; height: 500px;"></div>
                </div>
                <div class="col-12">
                    <div id="chart2" style="width: 900px; height: 500px;"></div>
                </div>
            </div>
        </div>
    </section>


    <footer class="footer-area">
        <div class="top-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-logo">
                            <h2 style="color: #ffffff;">SmartBet</h2>
                        </div>
                        <p><a href="#">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SmartBet</p>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/plugins.js"></script>
    <script src="js/active.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabela').DataTable();
        });
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            let niz = [];
            niz.push(['status','broj tiketa']);
            $.ajax({
                url : 'api/podaciOTiketima',
                success: function (podaci) {
                    $.each(podaci,function (i,podatak) {
                        niz.push([podatak.statusTiketa,parseInt(podatak.broj)]);
                    })
                    var data = google.visualization.arrayToDataTable(niz);

                    var options = {
                        title: 'Broj tiketa po statusu',
                        pieHole: 0.4,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('chart1'));
                    chart.draw(data, options);
                }
            });

        }
    </script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {
            let niz = [];
            niz.push(['ishod','broj']);
            $.ajax({
                url : 'api/podaciGrafik',
                success: function (podaci) {
                    $.each(podaci,function (i,podatak) {
                        niz.push([podatak.ishod,parseInt(podatak.broj)]);
                    })
                    var data = google.visualization.arrayToDataTable(niz);

                    var options = {
                        title: 'Broj odigranih ishoda po ishodu',
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('chart2'));
                    chart.draw(data, options);
                }
            });

        }
    </script>
</body>

</html>