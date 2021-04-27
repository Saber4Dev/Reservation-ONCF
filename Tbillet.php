<?php
include_once 'Dataaccess.php';

class Tbillet {
    // 1-methode check credit carte :
      public static function checkcreditcard($nom,$num,$anne,$mois,$crypto)
    {
       $req="SELECT * from Cartebancaire where num_carte='$num' and " . "detenteur ='$nom' and anneeexp='$anne' and moisexp='$mois' and " . "crypto ='$crypto'";
        $cur=Dataaccess::selection($req);
        $nbr=$cur->rowCount();
        return $nbr;
    }
    //2- save billet
    public static function savebillet($codeVoyage,$dateBillet,$email){
      $req="INSERT into billet(codeVoyage,datebillet,email) values('$codeVoyage','$dateBillet','$email');";
      $n=Dataaccess::miseajour($req);
      return $n;
      }
     //method affiche
     public static function showbillet($email){
      $req="SELECT * from billet INNER JOIN voyage ON billet.codeVoyage=voyage.codeVoyage where billet.email = '$email';";
      $cur = Dataaccess::selection($req);
      return $cur;
    }
}
    //method affiche
    /*
    public static function showbillet($email){
      $req="select billet.* from billet join voyageur on billet.email = voyageur.email where billet.email = '$email';";
      $cur = Dataaccess::selection($req);
      return $cur;
    }
    */