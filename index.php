<?php
  if(!isset($_SESSION)){
        session_start();
    }
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
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/perso.css">



</head>

<body>
  <div class="container">
    <div class="row">
        <?php  include './header.php';?>
      <div class="eleven columns">
        <br/>
        <p>Ici enfants et leurs parents peuvent réserver des jeux (disponibles) et venir les chercher à un créneau horaire défini. Les jeux sont triés selon différents critères : âges des enfants, activité calme ou dynamique, jeu individuel ou collectif,
          etc. </p>

      </div>
    </div>
    <div class="row">

      <div class="eight columns border">
        <h4>Liste des jeux disponibles</h4>
        <div class="container-col">
          <table class="u-full-width">
            <thead>
              <tr>
                <th>Jeux</th>
                <th>Age</th>
                <th>Type</th>
                <th>Restant</th>
              </tr>
            </thead>
            <tbody id="TABLE"></tbody>
          </table>
          <label for="exampleRecipientInput">Recherche :</label>
          <input class="u-full-width" type="text"  id="recherche" placeholder="Recherche" name="find" onkeyup="update()" />

          <label for="exampleRecipientInput">Filtrer par :</label>
          <select id="select" class="u-full-width" onchange="update()">
            <option value="Nom">Nom du jeux</option>
            <option value="Ages">Ages</option>
            <option value="Type_jeux">Type de jeux</option>
            <option value="NbJeuxDispos">Quantité disponibles</option>
          </select>
          <input type="checkbox" id="order" onchange="update()">  Décroissante</input>
        </div>
      </div>
      <div class="four columns border">
        <h4 id="form-title" >Connexion </h4>
        <h4 id="logged-title" >Jeux Réservé</h4>

        <div class="container-col">
          <?php
          //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
          if (!isset($_SESSION['nom_client'])) {
          ?>

          <div class="row" id="form" >
            <form action="" name="connexion" method="post" enctype="multipart/form-data">

              <div class="six columns">
                <label>Email</label>
                <input class="u-full-width" type="email"  placeholder="Utilisateur" id="login" name="login" />
              </div>
              <div class="six columns">
                <label>Mot de passe</label>
                <input class="u-full-width" type="password" placeholder="********" id="password" name="password" />
              </div>

              <input type="button" name="submit" value="Envoyer" onclick="verification(login.value, password.value);" />
            </form>
          </div>
          <?php }else{
            //header("Location:user_dashboard.php");
            include './user_dashboard.php';
          } ?>
          <div id="message"></div>
          <br/>
        </div>
      </div>
    </div>
  </div>


  <script>
    function DisplayTab(result) {
      // alert(result);
      var arr = JSON.parse(result);
      var i;
      // var out = "<table>";
      var out = "";
      for (i = 0; i < arr.length; i++) {
        out += "<tr><td>" +
          arr[i].Name +
          "</td><td>" +
           arr[i].Ages + "+ " +
          "</td><td>" +
          arr[i].Type +
          "</td><td>" +
          arr[i].NbJeuxDispos + " / " + arr[i].NbJeux +
          "</td> <td> <input type='button' name='" + arr[i].Name + "' value='Réserver' onclick='reserver(name);' /> </td> </tr>";
      }
      // out += "</table>";
      document.getElementById("TABLE").innerHTML = out;
    }

    function reserver(Name){
      console.log(Name);
    }

    function RechercheItems(theTag, str, order, recherche) {

      console.log(recherche);
      var request = new XMLHttpRequest();
      request.open('GET', "Get_items_recherche.php?q=" + str + "&order=" + order + "&recherche=" + recherche, true);
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
      request.onload = function() {
        if (request.status == 200) {
          var data = request.responseText;
          theTag(data);

        }
      }

      request.send();
    }


    var filter = 'Nom';
    var order = ''
    RechercheItems(DisplayTab, filter, order, "");


    function update() {
      if (document.getElementById('order').checked) {
        var order = 'DESC'
        RechercheItems(DisplayTab, document.getElementById('select').value, order, document.getElementById('recherche').value);
      } else {
        var order = ''
        RechercheItems(DisplayTab, document.getElementById('select').value, order, document.getElementById('recherche').value);
      }
    }

    function verification(login, password) {

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          reponse = xhr.responseText;
          document.getElementById('message').innerHTML = reponse;
        }
      }

      xhr.open("POST", "./verification_connexion.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
      xhr.send("login=" + escape(login) + "&password=" + escape(password));
    }
  </script>
</body>

</html>
