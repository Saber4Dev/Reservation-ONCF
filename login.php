<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/aos.css">
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
                    <li><a href="index.php" class="nav-link">Home</a></li>
                    <li><a href="Reservation.php" class="nav-link">Reservation</a></li>
                    <li class="has-children">
                      <a href="" class="nav-link active">Account</a>
                      <ul class="dropdown">
                        <li><a href="signup.php" class="nav-link">Sign In</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>    
            </div>
            </div>
        </header>
  <!-- Background-->
  <div class="site-blocks-cover overlay" style="background-image: url(images/2.jpg);" id="section-home">
  <div class="container">
  <div class="row justify-content-center ">
  
        <div class="col-md-12 text-white" data-aos="fade-up" style="margin-top: 150px;">
            <form  method="POST" class="form-signin">
              <div class="text-center mb-4">
                <img class="mb-4" src="images/avatar.png" alt="" width="100" height="100">
                <h1 class="h3 mb-3 font-weight-normal">Log in</h1>
                <p>Connect to your Account</p>
              </div>

              <div class="form-label-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" name="email" class="form-control"  placeholder="Email address" required autofocus>
               
              </div>

              <div class="form-label-group">
                <label for="inputPassword">Password</label>  
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                
              </div>

              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" name="remember" id="remember"/> Remember me
                </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="actionauth">Connect</button>
            </form>
        </div>
      </div>

    <?php
        include_once 'Tvoyageur.php';
          if(isset($_POST['actionauth']))
          {
            $email=$_POST['email'];
            $pass=$_POST['password'];
            $n=Tvoyageur::login($email,$pass);
            $adm = Tvoyageur::checkAdmin($email,$pass);
            if($n != 0)
            {
              session_start();
              $_SESSION['slog']=$email;
              header("Location:reservation.php");
            }
            elseif($adm != 0)
            {
              session_start();
              $_SESSION['admin']=$email;
              header("location: admin.php");
            }else //if(($n = 0) && ($adm = 0)){
            {
              echo '<script>alert("Password or Email is incorrect details"); window.history.back();</script>';
            }
            if(!empty($_POST['remember'])) 
                {
                  $expire = time()+3600 *24 * 30; //<-Hour // time() + 60*60*24*3; // 3 days from now
                  $name = 'login';
                  //setcookie('email', $email, $hour);
                  setcookie($name, $email, $expire);
                  setcookie('password', $pass, $expire);
                  setcookie('active', 1, $hour);
                  $_COOKIE['login']= $email;
                  //$_COOKIE['password'] = $pass;
                  //header("Location:reservation.php");
                  
                  /*
                  function logged_in_user() 
                {
                  if(isset($_SESSION['email']) && isset($_COOKIE['login'])) {
                   $_SESSION['slog'] = $_COOKIE['login'];
                    header("Location:profile.php"); 
                  }
                  return (isset($_SESSION['slog'])) && isset($_COOKIE['login']);
                }
                */
              }
            }
      ?>
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