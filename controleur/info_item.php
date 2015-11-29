<?php
  ob_start();
  require_once $_SERVER['DOCUMENT_ROOT'] . '/TP/modele/gestion_bdd.php';
  ob_end_flush();

  $item=$_GET["item"];

  // on crée la requête SQL
  $sql = 'SELECT image,description,date_ajout FROM Jeux WHERE Nom=\''.$item.'\'';
  // on envoie la requête
  $req = requete_bdd_select($sql);
  $item = strtoupper($item);
  // on fait une boucle qui va faire un tour pour chaque enregistrement
  $outp = '';
  while($data = mysqli_fetch_assoc($req)){
      // on affiche les informations de l'enregistrement en cours
      $outp .= "<h3>".$item."</h3><br/>";
      $outp .= "<img border='0' src='".$data['image']."' ALIGN=LEFT>";
      $outp .= "<p> ".$data['description']." </p>";
      $outp .= "<br/>Date d'ajout ".$data['date_ajout']."";
  }
  echo ($outp); // on envoie le résulata à la vue

?>
