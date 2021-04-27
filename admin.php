<?php
include_once 'Tvoyage.php';
include_once 'Tbillet.php';
include_once 'Tvoyageur.php';
session_start();
if(empty($_SESSION['admin'])){// || empty($_COOKIE['login'] )){
  header('location:index.php');
}


// print_r($voys);
//print_r($users);
//print_r($nb);
if (!empty($_GET['indice']))
{
  $indice = $_GET['indice'];
  $i1 = 3 * ($indice-1);
  $active = $indice;
}

$nb =  Tvoyage::GetNbpages();
$i1 = 0;
$pagenbvoy = Tvoyage::Pagination($i1);
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>ADMIN</title>
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
    
    <div id="section-contact" class="site-section bg-light" style="background: url(images/3.jpg);  background-position: center;background-repeat: no-repeat; background-size: cover;">
      <div class="container-fluid">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Welcome Back Admin</h2>
          </div>
        </div>
        

        <div class="row">
          <div class="col-md-7 mb-5">
            <?php
            if (isset($_GET['codevoy'])) {
              $deleted = Tvoyage::deletevoyage($_GET['codevoy']);
              if ($deleted) {
                echo '<div class="alert alert-success">Voyage Deleted</div>';
              }
              else {
                echo '<div class="alert alert-danger">Faild to delete voyage</div>';
              }
            }
            ?>
            <table id="table" class="table table-bordered bg-white" >
                    <thead>
                        <tr>
                            <th>Code Voyage</th>
                            <th>Ville Depart</th>
                            <th>Heure Depart</th>
                            <th>Ville Arrivee</th>
                            <th>Heure Arrivee</th>
                            <th>Prix</th>
                            <th>Modify</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $voys = Tvoyage::displayvoyage();
                    foreach ($voys as $voy): ?>
                    <tr>
                        <td><?=$voy['codeVoyage']?></td>
                        <td><?=$voy['villeDepart']?></td>
                        <td><?=$voy['heureDepart']?></td>
                        <td><?=$voy['villeDarriee']?></td>
                        <td><?=$voy['heureDarrivee']?></td>
                        <td><?=$voy['prixVoyage']?></td>
                        <td><button data-toggle="modal" data-target="#modifyvoy<?=$voy['codeVoyage']?>" class="btn btn-success text-white">Modify</button></td>
                        <td><a href="?codevoy=<?=$voy['codeVoyage']?>" class="btn btn-success text-white">Delete</a></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
              </table>
              
              <form  method="POST">
            <input type="submit" name="createVoyage" value="Create New Voyage" class="btn btn-success">
            <?php
                if(!empty($_POST["createVoyage"])) { ?>
            <div class="container-fluid bg-light">
            <table class="table table-bordered bg-white" >
                <thead>
                    <tr>
                        <th>Code Voyage</th>
                        <th>Ville Depart</th>
                        <th>Heure Depart</th>
                        <th>Ville Arrivee</th>
                        <th>Heure Arrivee</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text"  name="codevoy" class="form-control"></td>
                    <td><input type="text"  name="villedp" class="form-control"></td>
                    <td><input type="text"  name="heurdp" class="form-control"></td>
                    <td><input type="text" name="villear" class="form-control"></td>
                    <td><input type="text" name="heurar" class="form-control"></td>
                    <td><input type="text" name="prixvoy" class="form-control"></td>
                  </tr>
                </tbody>
            </table>
            <input type="submit" name="actioncreate" value="Create" class="btn btn-primary py-2 px-4 text-white">
            </form> 
            <?php } ?>
            </div>
            <?php 
            if(isset($_POST['actioncreate'])){
              $codevoy=$_POST['codevoy'];
              $villedp=$_POST['villedp'];
              $heurdp=$_POST['heurdp'];
              $villear=$_POST['villear'];
              $heurar=$_POST['heurar'];
              $prixvoy=$_POST['prixvoy'];
              $n = Tvoyage::createvoyage($codevoy,$villedp,$heurdp,$villear,$heurar,$prixvoy);
              echo '<script>location.href="admin.php"</script>';
            }
            $voys = Tvoyage::displayvoyage();
            foreach ($voys as $voy):
            ?>
            <!-- Modal div Modify -->
              <div class="modal" id="modifyvoy<?=$voy['codeVoyage']?>">
                  <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="text-center">Modify a Voyage</h3>
                    </div>
                    <div class="modal-body">
                    <form name="frmChange" class="m-auto" method="post">
                        <div>
                        <label>Code Voyage</label>
                        <input type="text"  name="new_codevoy" class="form-control" value="<?=$voy['codeVoyage']; ?>" readonly>
                        <label>Ville Depart</label>
                        <input type="text"  name="new_villedp" class="form-control" value="<?=$voy['villeDepart']; ?>">
                        <label>Heur Depart</label>
                        <input type="text"  name="new_heurdp" class="form-control" value="<?=$voy['heureDepart']; ?>">
                        <label for="">Ville Arrive</label>
                        <input type="text" name="new_villear" class="form-control" value="<?=$voy['villeDarriee']; ?>">
                        <label for="">Heur Arrive</label>
                        <input type="text" name="new_heurar" class="form-control" value="<?=$voy['heureDarrivee']; ?>">
                        <label for="">Prix</label>
                        <input type="text" name="new_prixvoy" class="form-control" value="<?=$voy['prixVoyage']; ?>"> <br>
                        <input type="submit" name="actionchange<?=$voy['codeVoyage']?>" value="Submit" class="btn btn-primary py-2 px-4 text-white">
                        </div>
                    </form>
                  
                    </div>
                    </div>
                  </div>
              </div>
              <?php
                if (isset($_POST['actionchange'.$voy['codeVoyage']])) {
                  $old_codevoy = $_POST['new_codevoy'];
                  $new_heurdp = $_POST['new_heurdp'];
                  $new_villedp = $_POST['new_villedp'];
                  $new_heurar = $_POST['new_heurar'];
                  $new_villear = $_POST['new_villear'];
                  $new_prixvoy = $_POST['new_prixvoy'];
                  $changed_voy = Tvoyage::modifyvoy($new_heurdp,$new_villedp,$new_heurar,$new_villear,$new_prixvoy,$old_codevoy);
                  if ($changed_voy) {
                    echo "<script>alert('Voyage Changed');location.href='admin.php';</script>";
                  }else { echo '<script>alert("Faild to change"); window.history.back();</script>'; }
                }
                endforeach;
              ?>
            <!-- END MODAL MODIFY -->
            <div class="container mt-2">
              <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <?php 
                    for($i = 1; $i<$nb ; $i++){
                      //if($active == $i){
                        echo "<li class='page-item'><a class='page-link active' href='admin.php?indice=$i'>$i</a></li>";
                      /*}else{
                        echo "<li class='page-item'><a class='page-link' href='admin.php?indice=$i'>$i</a></li>";
                      }*/
                    }
                    ?>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </div>
          <div class="col-md-5">
          <?php
            if (isset($_GET['email'])) {
              $deletedvoyageur = Tvoyageur::deletevoyageur($_GET['email']);
              if ($deletedvoyageur) {
                echo '<div class="alert alert-success">Voyageur Deleted</div>';
                echo '<script>location.href="admin.php"</script>';
              }
              else {
                echo '<div class="alert alert-danger">Faild to delete voyageur</div>';
              }
            }
          ?>
          <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>email</th>
                        <th>Password</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Date De Naissance</th>
                        <th>Telephone</th>
                        <th>Modify</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $users = Tvoyageur::displayusers();
                foreach ($users as $user): ?>
                <tr>
                    <td><?=$user['email']?></td>
                    <td><?=$user['password']?></td>
                    <td><?=$user['nom']?></td>
                    <td><?=$user['prenom']?></td>
                    <td><?=$user['date_naissance']?></td>
                    <td><?=$user['telephone']?></td>
                    <td><button class="btn btn-success">Modify</button></td>
                    <td><a href="?email=<?=$user['email']?>" class="btn btn-success">Delete</a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
          </table>
            <form  method="POST">
            <input type="submit" name="createUser" value="Create New user" class="btn btn-success">
            <?php
                if(!empty($_POST["createUser"])) { ?>
            <div class="container-fluid bg-light">
            <div class="row">
  
            <table class="table">
                <thead>
                    <tr>
                        <th scope="row">email</th>
                        <th scope="row">Password</th>
                        <th scope="row">Prenom</th>
                        <th scope="row">Nom</th>
                        <th scope="row">Date De Naissance</th>
                        <th scope="row">Telephone</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="email" id="email"  name="email" class="form-control"></td>
                    <td><input type="password" name="password" class="form-control"></td>
                    <td><input type="text" name="nom" class="form-control"></td>
                    <td><input type="text" name="prenom" class="form-control"></td>
                    <td><input type="date" name="dn" class="form-control"></td>
                    <td><input type="text" name="tel" class="form-control"></td>
                  </tr>
                </tbody>
            </table>
            <input type="submit" name="actioninscription" value="ajouter un nouvel utilisateur" class="btn btn-primary py-2 px-4 text-white">
            </div>
            </form> 
            <?php } ?>
            </div>
            <?php 
            if(isset($_POST['actioninscription'])){
              $email=$_POST['email'];
              $pass=$_POST['password'];
              $nom=$_POST['nom'];
              $prenom=$_POST['prenom'];
              $dn=$_POST['dn'];
              $telephone=$_POST['tel'];
              $n = Tvoyageur::signup($email, $pass, $nom, $prenom, $dn, $telephone);
              echo '<script>location.href="admin.php"</script>';
            }
            ?>
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
