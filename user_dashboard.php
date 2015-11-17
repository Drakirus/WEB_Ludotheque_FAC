<?php
if(!isset($_SESSION)){
        session_start(); // Ouverture la session si elle n'est pas ouverte
}
?>
<!-- affichage dynamique de la position dans le menu de droite de l'avancement de l'utilisateur  -->
<style type="text/css">#form{display:none;}#form-title{display:none;}#logged-title{display: block;}</style>


<!-- Creation d'une table contenant les information propre à l'utilisateur qui vient de ce connecter  -->
<table class="u-full-width">
    <thead>
    <?php
      if($_SESSION["nom_client"]) { // Si l'utilisateur est un petit malin, et qu'il fait appelle à cette page sans étre connecter...
    ?>
    Salut <?php echo $_SESSION["nom_client"]; ?>. <br/><a href="logout.php" tite="Logout">ce déconecter. 
    <?php
      }else {
        header("Location:index.php"); // BHAM il est rediriger vers la home page
      }
    ?>
    <thead>
</table>
