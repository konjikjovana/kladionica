<?php include "sesija.php";

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

    <section class="cool-facts-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <div class="icon">
                            <img src="img/core-img/docs.png" alt="">
                        </div>
                        <h2><span class="counter">3502</span></h2>
                        <h5>Poseta sajtu</h5>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <div class="icon">
                            <img src="img/core-img/star.png" alt="">
                        </div>
                        <h2><span class="counter">97</span></h2>
                        <h5>Dobitni tiketi danas</h5>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="750ms">
                        <div class="icon">
                            <img src="img/core-img/events.png" alt="">
                        </div>
                        <h2><span class="counter">26</span></h2>
                        <h5>Meceva</h5>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="1000ms">
                        <div class="icon">
                            <img src="img/core-img/earth.png" alt="">
                        </div>
                        <h2><span class="counter">20034</span></h2>
                        <h5>Zadovoljnih korisnika</h5>
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
                        <h3>Nas tim</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <img src="img/jovana.jpg" alt="">
                        <div class="course-content">
                            <h4>Jovana Konjik</h4>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Radnik meseca</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">administracija</a>
                            </div>
                            <p>Jovana je radnik meseca nase kladionice, veoma vredna devojka, pricljiva i odgovorna</p>
                        </div>

                        <div class="seat-rating-fee d-flex justify-content-between">
                            <div class="seat-rating h-100 d-flex align-items-center">

                                <div class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i> 4.7
                                </div>
                            </div>
                            <div class="course-fee h-100">
                                <a href="#" class="free">Star</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <img src="img/nikola.jpg" alt="">
                        <div class="course-content">
                            <h4>Nikola Majdanac</h4>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Kockar meseca</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">kladjenje</a>
                            </div>
                            <p>Nas omiljeni kockar, ostvaio nam je novca vise nego Vucic NotrDamu, kladite se suprotno od onoga sto on pise</p>
                        </div>

                        <div class="seat-rating-fee d-flex justify-content-between">
                            <div class="seat-rating h-100 d-flex align-items-center">

                                <div class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i> 4.8
                                </div>
                            </div>
                            <div class="course-fee h-100">
                                <a href="#" class="free">Kockar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="750ms">
                        <img src="img/katarina.jpg" alt="">
                        <div class="course-content">
                            <h4>Katarina Pajcin</h4>
                            <div class="meta d-flex align-items-center">
                                <a href="#">PR kladionice</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">nesto radi</a>
                            </div>
                            <p>Iskreno, niko ne zna sta radi, sa FON-a je, i resava situacije sa losim publicitetom, kojeg nema, dobija platu i eto</p>
                        </div>

                        <div class="seat-rating-fee d-flex justify-content-between">
                            <div class="seat-rating h-100 d-flex align-items-center">

                                <div class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i> 3.5
                                </div>
                            </div>
                            <div class="course-fee h-100">
                                <a href="#" class="free">PR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-area">
        <!-- Top Footer Area -->
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
</body>

</html>