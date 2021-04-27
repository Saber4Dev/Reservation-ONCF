<?php
include_once "Tbillet.php";
include_once "Tvoyageur.php";
include_once "Tvoyage.php";
/*
require "vendor/autoload.php";
use Spipu\Html2Pdf\Html2Pdf;
*/
session_start();
$num = $_GET['nombrebillet'];
$email = $_SESSION['slog'];


/*
if(!parse_str($queryString,$arr) && !array_key_exists($codeVoyage,$arr) || !array_key_exists("datebillet",$arr) || !array_key_exists("nombrebillet",$arr))
{ header('location:reservation.php'); }
*/
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">  
    <link rel="stylesheet" href="payment_style.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="pull-left">
  <a href="reservation" class="btn">Back</a>
</div>
<form method="POST">
        <div class='col-md-5'style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
          <div class="card-details">
            <h3 class="title">détails de la carte de crédit</h3>
            <div class="row">
              <div class="form-group col-sm-7">
                <label for="card-holder">titulaire de la carte</label>
                <input id="card-holder" type="text" name="deteneur" class="form-control" placeholder="Nom et Prenom" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-5">
                <label for="">date d'expiration</label>
                <div class="input-group expiration-date">
                  <input type="text" class="form-control" name="moisExp" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                  <span class="date-separator">/</span>
                  <input type="text" class="form-control" name="anneExp" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                </div>
              </div>
              <div class="form-group col-sm-8">
                <label for="card-number">Card Number</label>
                <input id="card-number" type="text" name="numcarte" class="form-control" placeholder="XXXXXXXXXXXXXXXX" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-4">
                <label for="cvc">CVC</label>
                <input id="cvc" type="text" class="form-control" name="cvc" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary btn-block" name="actionProcced">Proceed</button>
              </div>
            </div>
        </div>
      </div>
</form>
<?php 
include_once 'Tcartebank.php';
if(isset($_POST['actionProcced']))
{
  $num_carte=$_POST['numcarte'];
  $detenteur=$_POST['deteneur'];
  $anneeExp=$_POST['anneExp'];
  $moisExp=$_POST['moisExp'];
  $crypto=$_POST['cvc'];
  $n=Tcartebank::carte($num_carte,$detenteur,$anneeExp,$moisExp,$crypto);

  if($n)
  {
    for ($i = 1; $i<= $num; $i++) {
      $queryString = $_SERVER['QUERY_STRING'];
      parse_str($queryString,$arr);
      $num = array_values($arr)[1];
      $dateBillet = array_values($arr)[0];
      $codeVoyage = array_keys($arr)[2];
      $Sbillet = Tbillet::savebillet($codeVoyage,$dateBillet,$email);
    }
  $_SESSION['num_carte'] = $num_carte;
  $_SESSION['detenteur'] = $detenteur;
  $_SESSION['anneeExp'] = $anneeExp;
  $_SESSION['moisExp'] = $moisExp;
  $_SESSION['crypto'] = $crypto;
  header('location:pdf.php');
  }
}
?>
</body>
</html>

