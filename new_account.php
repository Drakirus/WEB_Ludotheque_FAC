<?php


    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_bis = isset($_POST['password_bis']) ? $_POST['password_bis'] : '';

    $uppercase = preg_match('@[A-Z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $pattern_email =  preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email);
    $false = 0;

    if(!$pattern_email) {
      echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Adresse mail non valide</a> </br>";
      $false = 1;
    }

    if(strlen($password) < 6) {
      echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Le mots de passe doit être au minimum de 6 caractères</a> </br>";
      $false = 1;
    }
    if(!$number) {
      echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Le mots de passe doit être au minimum un chiffre</a> </br>";
      $false = 1;
    }
    if(!$uppercase) {
      echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Le mots de passe avoir des majuscule </a> </br>";
      $false = 1;
    }
    if ($false){
      die();
    }
    if ($password != $password_bis) {
      die("<a  id=\"alert\" class=\"alert\" href=\"#alert\"> Les mots de passe saisis sont différents. veuillez réessayer</a> </br>");
    }

    if ( ($login != '')) {

      $db = mysqli_connect('localhost', 'root', 'root', "Ludotheque_BD");
      header("Content-Type: application/json; charset=UTF-8");

      $sql="SELECT email FROM members WHERE email='$email'";
  		$result=mysqli_query($db,$sql);

      if(mysqli_num_rows($result) == 1){
        echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Désolé ... Cette email est déjà utilisé...</a>";
      }else{
        $query = mysqli_query($db, "INSERT INTO members (users, email, password)VALUES ('$login', '$email', '$password')");
        if($query){
          echo "<a  id=\"alert\" class=\"ok alert\" href=\"./index.php\"> Merci! Vous êtes maintenant inscrit.</a>";
        }
      }
      mysqli_close($db);

    } else {
        echo "<a  id=\"alert\" class=\"alert\" href=\"#\">Besoin d'un Nom d'Utilisateur</a>";
    }

?>
