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
  <title>Ludotheque Admin</title>
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
      <div>
        <h1>Ludotheque</h1>
      </div>
    </div>
        <?php  include './vue/gestion.php';?>
  </div>

</body>
</html>
