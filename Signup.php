<?php
include_once 'Tvoyage.php';
include_once 'Tbillet.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sign in</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/style.css">
    <!-- ======= <link rel="stylesheet" href="css/aos.css"> ======= -->

</head>
<body>
   
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
                  <li><a href="index.php" class="nav-link">Home</a></li>
                  <li><a href="Reservation.php" class="nav-link">Reservation</a></li>
                  <li class="has-children">
                    <a href="" class="nav-link active">Account</a>
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
                      <?php } ?>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>    
          </div>
          </div>
      </header>
<div class="" style="background: url(images/4.jpg);  background-position: center;background-repeat: no-repeat; background-size: cover;">
    <div class="container">
    <div class="row justify-content-center mb-5"></div>
    <div class="row">
      <div class="col-md mb-5">
        <form  method="POST" onsubmit="return checkage()" class="p-5 m-5" style="background-color:rgba(100,100,100,0.8)">
          <h2 class="font-weight-light text-primary">Sign Up</h2>
          <br>
          <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
              <label class="text-white" for="fname">First Name</label>
              <input type="text" id="fname" name="prenom" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="text-white" for="lname">Last Name</label>
              <input type="text" id="lname" name="nom" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-white" for="email">Email</label> 
              <input type="email" name="email" id="email" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-white">Password</label> 
              <input type="password"  name="password" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-white" >Birthday</label> 
              <input type="date" id="idate" name="dn" class="form-control">
            </div>
          </div>
        
          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-white"  name="tele">Telephone</label> 
              <input type="tel" name="tel" id="tel" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" name="actioninscription" value="SignUp" class="btn btn-primary py-2 px-4 text-white">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <?php
    include_once 'Tvoyageur.php';
    if(isset($_POST['actioninscription'])){
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $dn=$_POST['dn'];
        $telephone=$_POST['tel'];
        $n = Tvoyageur::signup($email, $pass, $nom, $prenom, $dn, $telephone);
        echo '<script>location.href="login.php"</script>';
        if($n!=0){
            echo 'Merci de votre inscription !!';
        }
      }
  ?>

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
<script>
  function checkage()
  {
    let datenaissance=document.getElementById('idate').value;
    let datesepare=datenaissance.split('-');
    let annnaissance=datesepare[0];
    let curdate=new Date();
    let curyear=curdate.getFullYear()
    let age=curyear-annnaissance;
     if(age <18)
     {
         alert('mineur !!!');
         return false;
     }
    return true;
  }
</script>
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