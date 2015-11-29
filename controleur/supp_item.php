<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP/modele/gestion_bdd.php';
ob_end_flush();

/*
* vérification des différentes variables post ( gestion du isset)
*/
$nom = special_character(isset($_POST['nom']) ? $_POST['nom'] : '');

if (!$nom) {
  echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Jeux non indiqué</a>"; // si tout les champs ne sont pas remplis
  exit();
}


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
}
 ?>
