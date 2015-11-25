<?php
  if(!isset($_SESSION)){
        session_start();
  }
  ob_start();
  require_once('modele/gestion_bdd.php');
  ob_end_flush();
    ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ludotheque</title>
  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/perso.css">


</head>

<body>
  <div class="container">
    <div class="row">
        <?php  include './vue/header.php';?>
      <div class="eleven col">
        <br/>
        <p>Ici enfants et leurs parents peuvent réserver des jeux (disponibles) et venir les chercher à un créneau horaire défini. Les jeux sont triés selon différents critères : âges des enfants, activité calme ou dynamique, jeu individuel ou collectif,
          etc. </p>

      </div>
    </div>
    <?php  include './vue/main.php';?>
  </div>
  <script language="javascript" type="text/javascript" src="./controleur/datetimepicker.js">  </script>
  <script language="javascript" type="text/javascript" src="./controleur/app.js">  </script>
</body>
</html>
