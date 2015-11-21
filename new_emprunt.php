<?php
    if(!isset($_SESSION)){
            session_start(); // Ouverture la session si elle n'est pas ouverte
    }

    /*
    * vérification des différentes variables post ( gestion du isset)
    */
    $item_emp = isset($_POST['item']) ? $_POST['item'] : '';
    // $id = isset($_SESSION['id_client']) ? $_SESSION['id_client'] : '';
    $id = $_SESSION['id_client'];
    /*
    * Affichage d'erreur si les variables ne correspondent pas à un contenus
    */
    if(!$item_emp) {
      die("<a  id=\"alert\" class=\"alert\" href=\"#alert\"> erreur jeux pas définit </a> </br>");
    }

   // verification si le nom d'utilisateur à été reseigner

      $db = mysqli_connect('localhost', 'root', 'root', "Ludotheque_BD");
      header("Content-Type: application/json; charset=UTF-8");

      $sql="SELECT '$id' FROM Paniers WHERE id='$id' AND Nom='$item_emp'";
      // echo $sql;
      // echo "<pre>";
      // print_r($_SESSION);
      // echo "</pre>";
  		$result=mysqli_query($db,$sql);

      if(mysqli_num_rows($result) == 1){
        die ("<a  id=\"alert\" class=\"alert\" href=\"#\">".$item_emp. " est déja commander</a>");
      }


      $sql="SELECT * FROM Paniers WHERE id='$id'";
      $result=mysqli_query($db,$sql);
      if(mysqli_num_rows($result) >= 5){
        die ("<a  id=\"alert\" class=\"alert\" href=\"#\">5 Jeux max</a>");
      }

        $query = mysqli_query($db, "INSERT INTO Paniers (id, Nom, creneau)VALUES ('$id', '$item_emp', '2015-11-30')");
        if($query){
          // header("Location:user_dashboard.php");
          echo "ok";
        }

      mysqli_close($db);

?>
