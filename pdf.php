<?php 
include_once "Tbillet.php";
include_once "Tvoyageur.php";
include_once "Tvoyage.php";

require "vendor/autoload.php";
use Spipu\Html2Pdf\Html2Pdf;
session_start();
$email = $_SESSION['slog'];
ob_start();
echo '<h3>Votre Tickets</h3>';

  $showBillet = Tbillet::showbillet($email); 
  while($row = $showBillet->fetch())
  {
    echo "<table border=1>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Numero Billet</th>";
    echo "<th>Code Voyage</th>";
    echo "<th>Date Billet</th>";
    echo "<th>Email Account</th>";
    echo "<th>Prix Voyage</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr><td>{$row['Numbillet']}</td><td>{$row['codeVoyage']}</td><td>{$row['datebillet']}</td><td>{$row['email']}</td><td>{$row['prixVoyage']}</td></tr>";
    echo "</tbody>";
    echo "</table>"; 
  }
  //end contenu
$contenu = ob_get_clean();
$html2pdf = new Html2Pdf('P','A4','fr');
$html2pdf->writeHTML($contenu);
ob_end_clean(); 
$html2pdf->Output('Billet.pdf','I');
header('location:user.php');
?>