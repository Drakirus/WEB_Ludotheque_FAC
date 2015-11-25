<!--- Fichier à inclure permettant d'afficher le titre et le menu sur toutes les pages le necessitant -->
<div>
  <h1>Ludotheque</h1>
</div>

<nav>
  <ul>
    <?php

  	if (basename($_SERVER['SCRIPT_NAME']) != "index.php"){
    	define('URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));
    }else{
    	define('URL',dirname($_SERVER['SCRIPT_NAME']));
    }?>
    <li><a href="<?php echo URL . '/index.php'?>"> Accueil </a></li>
    <li><a href="<?php echo URL . '/vue/register.php'?>"> S'inscrire </a></li>
    <li><a href="<?php echo URL . '/vue/about.php'?>"> A propos </a></li>  </ul>
</nav>
