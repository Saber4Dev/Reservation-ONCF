<?php
include_once 'Dataaccess.php';
class Tvoyage {
    // methode 1 charger ville depart :
    public static function chargervd(){
       $req="select distinct(villeDepart) from voyage "; 
       $cur=Dataaccess::selection($req);
       return $cur;
    }
    // methode 2 charger ville d'arrivée :
    public static function chargerva(){
       $req="select distinct(villeDarriee) from voyage "; 
       $cur=Dataaccess::selection($req);
       return $cur;
    }
    public static function voyageQuery($villedp,$villear,$pickup){
       $req = "select * from voyage where villedepart='$villedp' AND villeDarriee='$villear' AND heuredepart >= '$pickup'";
       $cur = Dataaccess::selection($req);
       return $cur;
    }
    //3 methode rechercher par ville:
    public static function trajetParVille($vd,$va){
       $req="select * from voyage where villedepart ='$vd' and villearrivee='$va'"; 
       $cur=Dataaccess::selection($req);
       return $cur;
    }
    //4 methode getprix :
    public static function getprix($cv){
      $req="select prixvoyage from voyage where codevoyage ='$cv'"; 
      $cur=Dataaccess::selection($req);
      $prix=0;
      while ($row = $cur->fetch()) 
         {
           $prix=$row[0];
         }
      $cur->closeCursor();
      return $prix;
    }
    
    public static function displayvoyage(){
      $req = "select * from voyage";
      $cur = Dataaccess::selection($req);
      return $cur->fetchAll();
   }

   //5 method create new elements
   public static function createvoyage($codevoy,$villedp,$heurdp,$villear,$heurar,$prixvoy){
      $req="insert into voyage values('$codevoy','$villedp','$heurdp','$villear','$heurar','$prixvoy')"; 
      $n=Dataaccess::miseajour($req);
      return $n;
   }

   //6 Method Supprimer
   public static function deletevoyage($codevoy){
      if ($codevoy) {
         $req="DELETE FROM `voyage` WHERE voyage.codeVoyage = '{$codevoy}'";
         $n=Dataaccess::miseajour($req);
         return $n;
      }
      else {
         return false;
      }
   }


   public static function modifyvoy($new_heurdp,$new_villedp,$new_heurar,$new_villear,$new_prixvoy,$old_codevoy){
      $req =  "UPDATE voyage SET heureDepart='$new_heurdp',villeDepart='$new_villedp',heureDarrivee='$new_heurar',villeDarriee='$new_villear',prixVoyage='$new_prixvoy' WHERE codeVoyage='$old_codevoy';";
      $n=Dataaccess::miseajour($req);
      return $n;
   
   }
   // 5-Pagination    
   
   public static function GetNbpages(){
      $req = "SELECT count(*) from voyage";
      $cur = Dataaccess::selection($req);
      $nbvoy = 0 ;
      while($row = $cur -> fetch()){
         $nbvoy = $row[0];
      }
      $nbpage = ceil($nbvoy/3);
      return $nbpage;
   }
   public static function Pagination($i1){
      $req="select * from voyage limit  $i1,3";
      $cur= Dataaccess::selection($req);
      return $cur;
   }
   

}
