<?php
if(!isset($_SESSION)){
    session_start(); // Ouverture la session si elle n'est pas ouverte
}
unset($_SESSION["nom_client"]); // raz de la session courante
unset($_SESSION["id_client"]);
unset($_SESSION["marker"]);
header("Location:../index.php"); // redirection vers la page défaut
?>
