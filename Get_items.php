<?php
  require('./modele\gestion_bdd.php');

  $q=$_GET["q"]; // recupération des paramètres (GET)
  $o=$_GET["order"];

  // on crée la requête SQL
  $sql = 'SELECT Nom,Ages,Type_jeux,NbJeux,NbJeuxDispos FROM Jeux NATURAL JOIN Jeux_Ludotheque ORDER  by  '.$q.' '.$o.'';
  // on envoie la requête
  $req = requete_bdd_select($sql);

  $outp = "[";
  // on fait une boucle qui va faire un tour pour chaque enregistrement
  while($data = mysqli_fetch_assoc($req)){
      // on affiche les informations de l'enregistrement en cours
      // $arr = array('Nom' => $data['Nom'], 'Ages' => $data[Ages], 'Type_jeux' => $data['Type_jeux'] );
      // echo json_encode($arr, JSON_UNESCAPED_UNICODE);

      if ($outp != "[") {$outp .= ",";}
      $outp .= '{"Name":"'  . $data['Nom'] . '",';
      $outp .= '"Ages":' . $data['Ages']        . ',';
      $outp .= '"NbJeux":'   . $data['NbJeux']        . ',';
      $outp .= '"NbJeuxDispos":'   . $data['NbJeuxDispos']        . ',';
      $outp .= '"Type":"'. $data['Type_jeux']    . '"}';
  }

  $outp .="]";
  echo($outp); // on envoie un ficher json que le javascript va afficher

?>
