<?php include "sesija.php";

$mecevi = $_SESSION['aktivniTiket'];
include 'Baza.php';
$baza = new Baza();

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
                        <h3>Tiket</h3>
                    </div>
                </div>

                <div class="col-12">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th>Mec</th>
                                <th>Ishod</th>
                                <th>Kvota</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $totalKvota = 1;
                            foreach ($mecevi as $mec){
                                $mecId = $mec['mecID'];
                                $kvotaID = $mec['kvotaID'];

                                $mecIzBaze = $baza->vratiMecPoIdu($mecId);
                                $kvotaIzBaze = $baza->vratiKvotePoIdu($kvotaID);
                                $totalKvota = $totalKvota * (double)$kvotaIzBaze->kvota;
                                ?>
                            <tr>
                                <td><?= $mecIzBaze->domacin . " - " . $mecIzBaze->gost ?></td>
                                <td><?= $kvotaIzBaze->ishod?></td>
                                <td><?= $kvotaIzBaze->kvota?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th id="total" colspan="2">Ukupna kvota :</th>
                                <td id="ukupnaKvota"><?= $totalKvota ?></td>
                            </tr>
                            </tfoot>
                        </table>

                </div>
                <div class="col-10">
                    <label for="uplata">Iznos uplate</label>
                    <input type="number" id="uplata" class="form-control" placeholder="Iznos uplate" onkeyup="prikaziIznos()">
                </div>
                <div class="col-2">
                    <label for="dugme">Pritisnite da uplatite</label>
                    <button class="btn-dark btn-lg btn" id="dugme" onclick="uplatiTiket()">Uplati tiket</button>
                </div>
                <div class="col-12">
                    <p id="Iznos"></p>
                </div>
            </div>
            <br><br>
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
<script>
    function prikaziIznos() {
        let ukupnaKvota = $("#ukupnaKvota").text();
        let uplata = $("#uplata").val();
        let iznos = parseFloat(ukupnaKvota) * parseFloat(uplata);
        $("#Iznos").html("Ukupan dobitak je: "+iznos+ " RSD.");
    }
</script>
</body>

</html>