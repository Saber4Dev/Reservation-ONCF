<?php
include_once 'Tvoyage.php';
include_once 'Tbillet.php';
include_once 'Tvoyageur.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ONCF - HOME</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="css/aos.css?<?php echo time(); ?>">
</head>
<body>
        <!-- ======= Header ======= -->
      <header class="site-navbar py-3 js-site-navbar site-navbar-target" role="banner" id="site-navbar">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-11 col-xl-2 site-logo">
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <h1 class="mb-0"><a href="index.php" class="text-white h2 mb-0">ONCF</a></h1>
            </div>
            <div class="col-12 col-md-10 d-none d-xl-block">
              <nav class="site-navigation position-relative text-right" role="navigation">
                <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                  <li><a href="index.php" class="nav-link active">Home</a></li>
                  <li><a href="Reservation.php" class="nav-link">Reservation</a></li>
                  <li class="has-children">
                    <a href="" class="nav-link">Account</a>
                    <ul class="dropdown">
                      <?php 
                      if (isset($_SESSION['slog'])  || (isset($_SESSION['admin'])) || isset($_COOKIE['login']))
                      { ?>
                      <li><a href="profile.php" class="nav-link">
                      <?php if(isset($_SESSION['slog']))  { echo $_SESSION['slog']; } 
                      if (isset($_SESSION['admin'])) {echo $_SESSION['admin'];} ?></a></li>
                      <li><a href="logout.php" class="nav-link">Log out</a></li>
                      <?php } else{ ?>
                      <li><a href="login.php" class="nav-link">Log in</a></li>
                      <li><a href="signup.php" class="nav-link">Sign In</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>    
          </div>
          </div>
      </header>
<!-- Background-->
  <div class="site-blocks-cover overlay" style="background-image: url(images/TGV.jpg);" data-aos="fade" data-stellar-background-ratio="0.5" id="section-home">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
          <h1 class="text-white font-weight-light text-uppercase font-weight-bold" data-aos="fade-up">ONCF</h1>
          <p class="mb-5" data-aos="fade-up" data-aos-delay="100">for Travaling Fast </p>
          <p data-aos="fade-up" data-aos-delay="200"><a href="reservation.php" class="btn btn-primary py-3 px-5 text-white">Get your Ticket Now !</a></p>
        </div>
      </div>
    </div>
  </div>  
  <!-- Section About -->
  <div class="site-section" id="section-about">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-5 ml-auto mb-5 order-md-2" data-aos="fade-up" data-aos-delay="100">
          <img src="images/about.jpg" alt="Image" class="img-fluid rounded">
        </div>
        <div class="col-md-6 order-md-1" data-aos="fade-up">
          <div class="text-left pb-1 border-primary mb-4">
            <h2 class="text-primary">About Us</h2>
          </div>
          <p>At the heart of Morocco’s modernization</p>
          <p class="mb-5">ONCF is at the center of the country’s modernization. The rapid changes witnessed in the rail sector serve as the perfect illustration. The driving force of this ever-renewed momentum is the ambition to become the reference in terms of transporting and serving citizens.
            This strong wish is supported by substantial investment plans, which have helped triple the number of passengers while increasing freight volume by 30% in 15 years (since 2000).</p>
        </div>
      </div>
    </div>
  </div>
<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-5 mr-auto">
            <h2 class="footer-heading mb-4" ><a href="https://www.oncf.ma/en/Company">About Us</a></h2>
            <p>© 2021 ONCF - ALL RIGHTS RESERVED</p>
          </div>
          <div class="col-md-3">
            <h2 class="footer-heading mb-4">Follow Us</h2>
            <a href="https://www.facebook.com/oncfpageofficielle" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
            <a href="https://twitter.com/ONCFgroup" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
            <a href="https://www.instagram.com/groupe_oncf/" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
            <a href="https://www.youtube.com/user/oncfchaineofficielle" class="pl-3 pr-3"><span class="icon-youtube"></span></a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
        <form action="#" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary text-white" type="button" id="button-addon2">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</footer>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/main.js"></script>
  
</body>
</html>