<?php
include_once 'Dataaccess.php';

class Tcartebank {
    //1-methode  ajoute
    public static function carte($num_carte,$detenteur,$anneeExp,$moisExp,$crypto)
    {
        $req="insert into cartebancaire values('$num_carte','$detenteur','$anneeExp','$moisExp','$crypto');";
        $n=Dataaccess::miseajour($req);
        return $n;
    }

    //2-method affiche
    public static function displaycarte(){
        $req = "select * from voyageur";
        $cur = Dataaccess::selection($req);
        return $cur->fetchAll();
    }
}