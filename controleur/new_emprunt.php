<?php
    if(!isset($_SESSION)){
            session_start(); // Ouverture la session si elle n'est pas ouverte
    }
    require('../modele/gestion_bdd.php');

    /*
    * vérification des différentes variables post ( gestion du isset)
    */
    $item_emp = isset($_POST['item']) ? $_POST['item'] : '';
    $date_str = isset($_POST['date']) ? $_POST['date'] : '';
    // $id = isset($_SESSION['id_client']) ? $_SESSION['id_client'] : '';
    $id = $_SESSION['id_client'];

    $date = date( "Y-m-d H:i:s", strtotime($date_str) );
    // die("<a  id=\"alert\" class=\"alert\" href=\"#alert\">" .$date. " </a> </br>"); //debug
    /*
    * Affichage d'erreur si les variables ne correspondent pas à un contenus
    */

    //Vérification de la date
    if(strtotime($date_str) < strtotime('now')) {
      die("<a  id=\"alert\" class=\"alert\" href=\"#alert\">TARDIS en réparation</a> </br>");
    }

    if(!$item_emp && !$date) {
      die("<a  id=\"alert\" class=\"alert\" href=\"#alert\"> Erreur jeux pas définit </a> </br>");
    }
   // verification si le nom d'utilisateur à été renseigné


      $sql="SELECT '$id' FROM Paniers WHERE id='$id' AND Nom='$item_emp'";
      $result = requete_bdd_select($sql);
      // echo $sql;
      // echo "<pre>";
      // print_r($_SESSION);
      // echo "</pre>";

      // Update de la date d'un jeux déjà commandé
      if(mysqli_num_rows($result) == 1){


        $sql="SELECT '$id' FROM Paniers WHERE id='$id' AND Nom='$item_emp' AND creneau='$date' ";
        $result = requete_bdd_select($sql);

        if(mysqli_num_rows($result) == 1){
          die ("<a  id=\"alert\" class=\"alert\" href=\"#\">".$item_emp. " est déja commander</a>");
        }
        $sql="UPDATE Paniers SET creneau='$date' WHERE id='$id' AND Nom='$item_emp'";
        $result = requete_bdd_select($sql);
        if($result){
          exit("ok");
          // die ("<a  id=\"alert\" class=\"alert\" href=\"#\">".$item_emp. " date changée</a>");
        }



      }

      // Vérification que le client n'a pas déjà rempli son panier

      $sql="SELECT * FROM Paniers WHERE id='$id'";
      $result = requete_bdd_select($sql);
      if(mysqli_num_rows($result) >= 3){
        die ("<a  id=\"alert\" class=\"alert\" href=\"#\">5 Jeux max</a>");
      }

      $sql="SELECT '$id' FROM Jeux_Ludotheque  WHERE NbJeuxDispos=0 AND Nom='$item_emp'";
      $result = requete_bdd_select($sql);

      if(mysqli_num_rows($result) == 1){
        die("<a  id=\"alert\" class=\"alert\" href=\"#alert\"> Jeux non disponible </a> </br>");

      }

      // Insertion d'un jeux dans le panier du client
      $sql = "INSERT INTO Paniers (id, Nom, creneau) VALUES ('$id', '$item_emp', '$date')";
      $result = requete_bdd_select($sql);
      if($result){
        // header("Location:user_dashboard.php");
        $sql = "UPDATE Jeux_Ludotheque SET NbJeuxDispos = NbJeuxDispos - 1 WHERE Nom='$item_emp'";
        $result = requete_bdd_select($sql);
        exit("ok");
      }

?>
