<?php
include_once 'Dataaccess.php';

class Tvoyageur {
    //1-methode inscription:
    public static function signup($email,$pass,$nom,$prenom,$dn,$telephone){
       $req="insert into voyageur values('$email','$pass','$nom','$prenom','$dn','$telephone')"; 
       $n=Dataaccess::miseajour($req);
       return $n;
    }
     //2-methode authentification:
      
    public static function login($email,$pass){
       $req="select * from voyageur where email='$email' and password='$pass' "; 
       $cur=Dataaccess::selection($req);
       $n=$cur->rowCount();
       return $n;
    }
   
    public static function displayinfo(){
       $req = "select * from voyageur where email = '" . $_SESSION['slog']."'"; 
       $cur = Dataaccess::selection($req);
      // $n=$cur->rowCount();
       return $cur->fetch();
    }
    public static function changepass($post){

      $user = self::displayinfo();
      $old_password = $user['password'];
      $new_password = $post['new_password'];
      $entered_old_password = $post['old_password'];

      if (isset($post['new_password']) && isset($post['old_password']) && strlen($new_password) && strlen($entered_old_password) && strlen($old_password) && $old_password == $entered_old_password ) {

         $req="UPDATE `voyageur` SET `password` = '" . $new_password."' WHERE `voyageur`.`email` = '" . $_SESSION['slog']. "'"; 
         $n=Dataaccess::miseajour($req);
         return $n;
      }
      return false;
      
   }
   public static function displayusers(){
      $req = "select * from voyageur"; 
      $cur = Dataaccess::selection($req);
      return $cur->fetchAll();
   }
   public static function checkAdmin($email,$pass){
      $req = "select * from admin where email='$email' and password='$pass';";
      $cur = Dataaccess::selection($req);
      $n = $cur->rowCount();
      return $n;
   }
   //6 Method Supprimer
   public static function deletevoyageur($email){
      if ($email) {
         $req="delete from voyageur where voyageur.email = '{$email}'";
         $n=Dataaccess::miseajour($req);
         return $n;
      }
      else {
         return false;
      }
   }

}
