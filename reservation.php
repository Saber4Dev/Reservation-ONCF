<?php
include_once 'Tvoyage.php';
include_once 'Tbillet.php';
session_start();
if(empty($_SESSION['slog']))  {   ?> 
<script>window.location='login.php';</script>  
<?php }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reservation</title>

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
                  <li><a href="Reservation.php" class="nav-link active">Reservation</a></li>
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
  <div class="site-blocks-cover overlay" style="background-image: url(images/reserve.jpg);">
    <div class="row justify-content-center mb-5">
      <div class="container">
          <div class='col-md-5' data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
          <div class="p-4 mb-3 bg-white">
          <form method="post">
              <h2>Faites votre voyage</h2>
                    <div class="form-group">
                        <label class="label">Ville Depart</label>
                        <select name="villedepart" class="form-control">
                          <?php
                          $cur1= Tvoyage::chargervd();
                          while ($row = $cur1->fetch()) {
                              echo"<option value='$row[0]'>$row[0]</option>";
                          }
                          $cur1->closeCursor();
                          ?>
                          </select><!--
                        <input type="text" name="villedepart" class="form-control" placeholder="Ville, Station">
                          -->
                    </div>
                    <div class="form-group">
                        <label class="label">Ville Arrivee</label>
                        <select name="villearrivee" class="form-control">
                        <?php
                        $cur2= Tvoyage::chargerva();
                        while ($row = $cur2->fetch()) {
                            echo"<option value='$row[0]'>$row[0]</option>";
                        }
                        $cur2->closeCursor();
                        ?>
                        </select>
                        <!--
                        <input type="text" name="villearrivee" class="form-control" placeholder="Ville,Station">
                        -->
                    </div>
                      <div class="form-group">
                        <label class="label">Choix le Temp</label>
                        
                        <input type="time" name="pickuptime" class="form-control" placeholder="Temp" require>
                      </div>
              <div class="d-flex justify-content-end">
            <div class="form-group">
              <input type="submit" name="reserver" value="Reserve a Ticket" class="btn btn-primary py-3 px-4">
            </div>&nbsp
            <div class="form-group">
              <input type="reset" value="Cancel" id="reset" class="btn btn-primary py-3 px-4">
            </div>
          </div>
          </form>
      </div>
  </div>
</div>
</div>
</div>
<div class="container-fluid bg-light">
<?php
if(!empty($_POST["reserver"])){
  $depart = $_POST["villedepart"];
  $arrivee = $_POST["villearrivee"];
  $pickup = $_POST["pickuptime"];
  $func = Tvoyage::voyageQuery($depart,$arrivee,$pickup);
  if($func->rowCount() == 0){
    echo "<div class='alert alert-danger text-center my-3'>Votre voyage est introuvable!</div>";
  } else{
  ?>
  
  <h1 class="text-center">Votre Voyages</h1>
  <table class="table" style="text-align: center;">
    <thead>
      <tr>
        <th>Code Voyage</th>
        <th>Heure Depart</th>
        <th>Ville Depart</th>
        <th>Heure Arrivee</th>
        <th>Ville Arrivee</th>
        <th>Prix</th>
        <th>Date</th>
        <th>Nomber de billet</th>
        <th>Reserver</th>
      </tr>
    </thead>
      <?php 
      while($row = $func->fetch()){
        $row0 = $row[0];
        
          ?>
    <tbody>
      <tr>
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[4]; ?></td>
        <td><?php echo $row[5]; ?></td>
        <td>
        <form action=<?php echo 'payment.php?';?>method="get">
          <input type="date" name='datebillet'>
          </td>
          <td>
          <input type="number" name="nombrebillet">
          </td><td>
          <input type="submit" name="<?php echo $row0; ?>"  class="btn btn-success" value="Book">
          </form>
        </td>
      </tr>
    </tbody>
    <?php 
          if(isset($_GET[$row0]))
          {
            $num = $_GET['nombrebillet'];
            $row0 = $_GET['code'];
            $date = $_GET['datebillet'];
            $email = $_SESSION['slog'];
            header('location:payment.php?code='.$row0.'&date='.$date.'&num='.$num);
          }
                
    ?>
    <?php  
          }}} 
          
    ?>


    </table>
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
        <form method="">
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