<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/WEB_Ludotheque_FAC/modele/gestion_bdd.php';
ob_end_flush();

/*
* vérification des différentes variables post ( gestion du isset)
*/
$nom = special_character(isset($_POST['nom']) ? $_POST['nom'] : '');
$age = isset($_POST['agejeu']) ? $_POST['agejeu'] : '';
$type = special_character(isset($_POST['type']) ? $_POST['type'] : '');
$summ = special_character(isset($_POST['summ']) ? $_POST['summ'] : '');
$qt = isset($_POST['qt']) ? $_POST['qt'] : '';
$image = special_character(isset($_POST['image']) ? $_POST['image'] : '');

if (!$nom || !$age || !$type || !$summ || !$qt || !$image) {
  echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Erreur remplir formulaire</a>"; // si tout les champs ne sont pas remplis
  exit();
}




$sql = 'SELECT * FROM Jeux WHERE Nom=\''.$nom.'\'';
// on envoie la requête
$req = requete_bdd_select($sql);

if (mysqli_num_rows($req) == 1) {
  echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Jeux déja présent</a>"; // si tout les champs ne sont pas remplis
  exit();
}


//creation de la requette
$sql = 'INSERT INTO Jeux  VALUES (\''.$nom.'\','.$age.',\''.$type.'\',\''.date( "Y-m-d H:i:s", strtotime('now') ).'\',\''.$image.'\',\''.$summ.'\')';
// on envoie la requête
$req = requete_bdd_select($sql);

if ($req == 1) { //affichage d'un msg d'erreur ou pas
  //creation de la requette
  echo "<a  id=\"alert\" class=\"ok alert\" href=\"./index.php\">Jeux Ajouté</a>";
  $sql = 'INSERT INTO Jeux_Ludotheque  VALUES (\''.$nom.'\','.$qt.','.$qt.')';
  // on envoie la requête
  $req = requete_bdd_select($sql);
}else {
  echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Erreur</a>";
}
 ?>
