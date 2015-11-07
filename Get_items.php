<?php
  $q=$_GET["q"];
  // on se connecte à MySQL
  $db = mysqli_connect('localhost', 'root', 'root', "Ludotheque_BD");
  // mysqli_query("SET NAMES UTF8");
  header("Content-Type: application/json; charset=UTF-8");
  // on sélectionne la base

  // on crée la requête SQL
//  $sql = 'SELECT Nom,Ages,Type_jeux FROM Jeux';
$sql = 'SELECT Nom,Ages,Type_jeux,NbJeux,NbJeuxDispos FROM Jeux NATURAL JOIN Jeux_Ludotheque ORDER  by  '.$q.' ';
  // on envoie la requête
  $req = mysqli_query(  $db, $sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysqli_error());

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
  echo($outp);

  // on ferme la connexion à mysql
  mysqli_close($db);

?>
