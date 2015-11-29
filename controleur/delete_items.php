<?php

if(!isset($_SESSION)){
        session_start(); // Ouverture la session si elle n'est pas ouverte
}
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/WEB_Ludotheque_FAC/modele/gestion_bdd.php';
ob_end_flush();


$idR=$_GET["idR"]; // recupération des paramètres (GET)
$id=$_GET["id"];
$Nom=$_GET["Nom"];

if($_SESSION["id_client"] == $id){

  // on crée la requête SQL
  $sql = 'DELETE FROM `Paniers` WHERE id_reservation='.$idR.'';

  // on envoie la requête
  $req = requete_bdd_select($sql);

  if ($req) {
    // on crée la requête SQL
    $sql = 'UPDATE `Jeux_Ludotheque` SET NbJeuxDispos=NbJeuxDispos+1 WHERE Nom=\''.$Nom.'\'';

    // on envoie la requête
    $req = requete_bdd_select($sql);
  }

}

header("Location:../index.php");

 ?>
