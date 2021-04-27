<?php 
include_once 'Tvoyage.php';
include_once 'Tbillet.php';
include_once 'Tvoyageur.php';
session_start();

if (isset($_SESSION['slog']))
{ 
    header("Location: user.php");
} 

elseif (isset($_SESSION['admin']))
{
    header("location: admin.php");
}

/*
if ((empty($_SESSION['slog'])) || empty($_SESSION['admin']) || empty($_COOKIE['login']))
{ 
    header("location: login.php");
}
*/
?>

