<?php

/*
* vérification des différentes variables post ( gestion du isset)
*/
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';

if (!$nom) {
  echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Erreur</a>"; // si tout les champs ne sont pas remplis
  exit();
}
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/WEB_Ludotheque_FAC/modele/gestion_bdd.php';
ob_end_flush();

//creation de la requette
$sql = 'SELECT * FROM Jeux WHERE Nom=\''.$nom.'\'';
// on envoie la requête
$req = requete_bdd_select($sql);

if (mysqli_num_rows($req) == 0) {
  echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Jeux non trouvé</a>"; // si tout les champs ne sont pas remplis
  exit();
}
//creation de la requette
$sql = 'DELETE FROM Jeux WHERE Nom=\''.$nom.'\'';
// on envoie la requête
$req = requete_bdd_select($sql);
if ($req == 1) {
  echo "<a  id=\"alert\" class=\"ok alert\" href=\"./index.php\">Jeux Supprimer</a>";
  $sql = 'DELETE FROM Jeux_Ludotheque WHERE Nom=\''.$nom.'\'';
  // on envoie la requête
  $req = requete_bdd_select($sql);
}else {
  echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Erreur</a>";
}
 ?>
