<?php


  // on crée la requête SQL
  $sql = 'SELECT * FROM Jeux NATURAL JOIN Jeux_Ludotheque ORDER BY date_ajout DESC LIMIT 1';
  // on envoie la requête
  $req = requete_bdd_select($sql);
  // echo $sql;
  // on fait une boucle qui va faire un tour pour chaque enregistrement
  $outp = '';
  while($data = mysqli_fetch_assoc($req)){
      $outp .= "<tr  onclick='displayInfo(\"". $data['Nom']."\")'  ><td>";
      // on affiche les informations de l'enregistrement en cours
      // $arr = array('Nom' => $data['Nom'], 'Ages' => $data[Ages], 'Type_jeux' => $data['Type_jeux'] );
      // echo json_encode($arr, JSON_UNESCAPED_UNICODE);

      $outp .= ''  . $data['Nom'] . '</td>';
      $outp .= '<td>' . $data['Ages']        . '</td>';
      $outp .= '<td>'. $data['Type_jeux']    . '</td>';
      $outp .= '<td>'   . $data['NbJeuxDispos']        . '/';
      $outp .= ''   . $data['NbJeux']        . '</td>';
  }

  $outp .="</td> </tr>";
  echo($outp); // on envoi a la vue
?>
