<?php

    require('./modele\gestion_bdd.php');

    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ( ($login != '') && ($password != '')) { // code exécuter si le formulaire est bien rempli

      // on crée la requête SQL
      $sql = "SELECT * FROM members WHERE email='" . $_POST["login"] . "' and password = '". $_POST["password"]."'";
      // on envoie la requête
      $req = requete_bdd_select($sql);
      $data  = mysqli_fetch_assoc($req);

      if (is_array($data)) {
              debut_session($data['id'], $data['users']); // creation d'une session
              header("Location:user_dashboard.php"); // redirection vers user_dashboard.php
              // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
      } else {
              echo "<a  id=\"alert\" class=\"alert client\" href=\"./register.php\">Devenez client</a>";
      }
    } else {
        echo "<a  id=\"alert\" class=\"alert\" href=\"#alert\">Formulaire incomplet</a>";
    }

?>
