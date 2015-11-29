<?php
if(!isset($_SESSION)){
        session_start(); // Ouverture la session si elle n'est pas ouverte
}
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP/modele/gestion_bdd.php';
ob_end_flush();

?>
<!-- affichage dynamique de la position dans le menu de droite de l'avancement de l'utilisateur  -->
<style type="text/css">#form{display:none;}#form-title{display:none;}#logged-title{display: block;}.logged-reserver{display: block;}</style>


<!-- Creation d'une table contenant les informations propre à l'utilisateur qui vient de se connecter  -->
<?php
  if($_SESSION["nom_client"]) { // Si l'utilisateur est un petit malin, et qu'il fait appel à cette page sans être connecté...
?>
Salut <?php echo $_SESSION["nom_client"]; ?>. <br/><a href="./controleur/logout.php" tite="Logout">se Déconnecter. </a>
<?php
  }else {
    header("Location:../index.php"); // BHAM il est redirigé vers la home page
  }

?>

<table class="u-full-width">
    <thead>
      <tr>
        <th>Jeux</th>
        <th>Date d'emprunt</th>
        <th></th>
      </tr>
    </thead
    <tr>
      <?php

        // on crée la requête SQL
        $sql = 'SELECT Nom,creneau,id_reservation FROM `Paniers` WHERE id='.$_SESSION['id_client'].'';
        // on envoie la requête
        $req = requete_bdd_select($sql);
        // on fait une boucle qui va faire un tour pour chaque enregistrement
        $outp = '';
        while($data = mysqli_fetch_assoc($req)){
            // on affiche les informations de l'enregistrement en cours

            $outp .= "<tr onclick='displayInfo(\"". $data['Nom']."\")' ><td>".$data['Nom'];
            $outp .= "</td><td>".$data['creneau'];
            $outp .= '</td><td><a onclick="dell('.$_SESSION['id_client'].','.$data['id_reservation'].',\''.$data['Nom'].'\')" href="#dell" tite="Logout">X</a>'; //href="./controleur/delete_items.php?id='.$_SESSION['id_client'].'&idR='.$data['id_reservation'].'&Nom='.$data['Nom'].'"
            $outp .= "</td><tr>";
        }
          echo ($outp); // on envoie le résultat à la vue


       ?>
</table>
