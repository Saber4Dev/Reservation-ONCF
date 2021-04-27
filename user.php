<?php
include_once 'Tvoyage.php';
include_once 'Tbillet.php';
include_once 'Tvoyageur.php';
session_start();
if(empty($_SESSION['slog'])){// || empty($_COOKIE['login'] )){
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>User</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/aos.css">
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
  <!--
    <div class="" style="background: url(images/4.jpg);  background-position: center;background-repeat: no-repeat;background-size: cover;">
        <div class="container">
            <div class="row justify-content-center mb-5"></div>
            <div class="row">

            </div>
        </div>
    </div>
-->

  <div class="modal" id="changepass">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="text-center">Change Password</h3>
        </div>
        <div class="modal-body">
          <form name="frmChange" class="m-auto" method="post">
            <div>
               
                  <label>Current Password</label>
                  <input type="password" name="old_password" class="form-control" /><span id="currentPassword" class="required"></span>
               
                  <label>New Password</label>
                  <input type="password" name="new_password" class="form-control" /><span id="newPassword" class="required"></span>
                <label>Confirm Password</label>
                
                <input type="password" name="confirm_password" class="form-control" /><span id="confirmPassword" class="required"></span>

                <input type="submit" name="submit" value="Submit" class="btn btn-primary py-2 px-4 text-white">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
          <?php
          if (isset($_POST['new_password'])) {
            $changed_password = Tvoyageur::changepass($_POST);
            if ($changed_password) {
              echo '<div class="alert alert-success">Password Changed</div>';
            } else {
              echo '<div class="alert alert-danger">Faild to change password</div>';
            }
          }
          ?>
  <div id="section-contact" class="site-section bg-light" style="background: url(images/3.jpg);  background-position: center;background-repeat: no-repeat; background-size: cover;">
    >
    <div class="container-fluid">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center border-primary">
          <h2 class="font-weight-light text-primary">Welcome To Your Profile</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-7 mb-5">

          
          <form action="#" class="p-5 bg-white">
            <?php
            $n = Tvoyageur::displayinfo();

            //print_r($n);
            ?>
            <div class="row form-group">
              <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">Prenom</label>
                <input type="text" id="fname" name="prenom" class="form-control" value="<?php echo $n['prenom']; ?>">
              </div>
              <div class="col-md-6">
                <label class="text-black" for="lname">Nom</label>
                <input type="text" id="lname" name="nom" class="form-control" value="<?php echo $n['nom']; ?>">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['slog']; ?>" class="form-control">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <button data-toggle="modal" data-target="#changepass" class="btn btn-primary py-2 px-4 text-white">Change Password</button>

              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black">Date De Naissance</label>
                <input type="date" id="idate" name="dn" class="form-control" value="<?php echo $n['date_naissance']; ?>">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" name="tele">Telephone</label>
                <input type="tel" name="tel" id="tel" class="form-control" value="<?php echo $n['telephone']; ?>">
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" value="Modify" class="btn btn-primary py-2 px-4 text-white">
                &nbsp;
                <input type="reset" value="Reset" id="reset" class="btn btn-primary py-2 px-4 text-white">
              </div>
            </div>

          </form>
        </div>
        <?php
        if (isset($_SESSION['num_carte'])) { ?>
          <div class="col-md-5">

            <div class="p-4 mb-3 bg-white">
              <p class="h5 text-black mb-3">Votre Card </p>
              <p class="mb-4"><?php echo $_SESSION['num_carte']; ?></p>

              <p class="mb-0 font-weight-bold">Date Expert</p>
              <p class="mb-4"><?php echo $_SESSION['moisExp'] . "/" . $_SESSION['anneeExp']; ?></p>

              <p class="mb-0 font-weight-bold">CVV</p>
              <p class="mb-0"><?php echo $_SESSION['crypto']; ?></p>

            </div>
          <?php } ?>
          <div class="p-4 mb-3 bg-white">
            <h3 class="h5 text-black mb-3">Votre Tickets</h3>
            <?php $showBillet = Tbillet::showbillet($_SESSION['slog']);
            if ($showBillet) {
              while ($row = $showBillet->fetch()) { ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Numero Billet</th>
                      <th>Code Voyage</th>
                      <th>Date Billet</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $row['0']; ?></td>
                      <td><?php echo $row['1']; ?></td>
                      <td><?php echo $row['2']; ?></td>
                      <td><?php echo $row['3']; ?></td>
                    </tr>
                  </tbody>
                </table>
            <?php }
            } ?>
            <p><a href="reservation.php" class="btn btn-primary px-4 py-2 text-white">Reserve Autre Ticket</a></p>
          </div>

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
              <h2 class="footer-heading mb-4"><a href="https://www.oncf.ma/en/Company">About Us</a></h2>
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