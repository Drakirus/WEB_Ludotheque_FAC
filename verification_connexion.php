<?php
function debut_session($id, $nom) {
        session_start();
        $_SESSION['id_client'] = $id;
        $_SESSION['nom_client'] = $nom;
        $_SESSION['marker'] = true;
}


    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ( ($login != '') && ($password != '')) {

      $db = mysqli_connect('localhost', 'root', 'root', "Ludotheque_BD");
      header("Content-Type: application/json; charset=UTF-8");
      $sql = "SELECT * FROM members WHERE email='" . $_POST["login"] . "' and password = '". $_POST["password"]."'";
      $req = mysqli_query($db, $sql) or die("Erreur SQL !<br>".$sql."<br>".mysqli_error($db));

      $data  = mysqli_fetch_assoc($req);

      if (is_array($data)) {
              debut_session($data['id'], $data['users']);
              header("Location:user_dashboard.php");
              // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
      } else {
              echo "<a  id=\"alert\" class=\"alert client\" href=\"./register.html\">Devenez client</a>";
      }
        mysqli_close($db);
    } else {
        echo "<a  id=\"alert\" class=\"alert\" href=\"#alert\">Formulaire incomplet</a>";
    }


?>
