<?php
if(!isset($_SESSION)){
        session_start(); // Ouverture la session si elle n'est pas ouverte
}
require('./modele\gestion_bdd.php');

?>
<!-- affichage dynamique de la position dans le menu de droite de l'avancement de l'utilisateur  -->
<style type="text/css">#form{display:none;}#form-title{display:none;}#logged-title{display: block;}</style>


<!-- Creation d'une table contenant les information propre à l'utilisateur qui vient de ce connecter  -->
<?php
  if($_SESSION["nom_client"]) { // Si l'utilisateur est un petit malin, et qu'il fait appelle à cette page sans étre connecter...
?>
Salut <?php echo $_SESSION["nom_client"]; ?>. <br/><a href="logout.php" tite="Logout">se Déconnecter. </a>
<?php
  }else {
    header("Location:index.php"); // BHAM il est rediriger vers la home page
  }
?>

<table class="u-full-width">
    <thead>
      <tr>
        <th>Jeux</th>
        <th>Date d'emprunt</th>
      </tr>
    </thead
    <tr>
      <?php

        // on crée la requête SQL
        $sql = 'SELECT Nom,creneau FROM `Paniers` WHERE id='.$_SESSION['id_client'].'';
        // on envoie la requête
        $req = requete_bdd_select($sql);
        // on fait une boucle qui va faire un tour pour chaque enregistrement
        $outp = '';
        while($data = mysqli_fetch_assoc($req)){
            // on affiche les informations de l'enregistrement en cours

            $outp .= "<tr><td>".$data['Nom'];
            $outp .= "</td><td>".$data['creneau'];
            $outp .= "</td><tr>";
        }

        echo ($outp); // on envoie le résulata à la vue

       ?>
</table>
