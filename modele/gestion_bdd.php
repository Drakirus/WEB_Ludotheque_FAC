<?php
function requete_bdd_select($sql){

  // on se connecte à MySQL
  $db = mysqli_connect('localhost', 'root', 'root', "Ludotheque_BD");
  mysqli_set_charset($db, "utf8");
  // mysqli_query("SET NAMES UTF8");
  // on sélectionne la base

  // on envoie la requête
  $req = mysqli_query(  $db, $sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysqli_error($db));

  // on ferme la connexion à mysql
  mysqli_close($db);

  return $req;
}

function debut_session($id, $nom) {
        session_start();
        $_SESSION['id_client'] = $id;
        $_SESSION['nom_client'] = $nom;
        $_SESSION['marker'] = true;
}


//gestion des caractères spéciaux
function special_character($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}

 ?>
