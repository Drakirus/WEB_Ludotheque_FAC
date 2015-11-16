<?php
  if(!isset($_SESSION)){
        session_start();
    }?>
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
      <div>
        <h1>Ludotheque</h1>
      </div>

      <nav>
        <ul>
          <li><a href="#"> Accueil </a></li>
          <li><a href="#"> Connexion </a></li>
          <li><a href="#"> Jeux </a></li>
          <li><a href="#"> A propos </a></li>
        </ul>
      </nav>

      <div class="eleven columns">
        <p>Ici enfants et leurs parents peuvent réserver des jeux (disponibles) et venir les chercher à un créneau horaire défini. Les jeux sont être triés selon différents critères : âges des enfants, activité calme ou dynamique, jeu individuel ou collectif,
          etc. </p>
        <br>

      </div>
    </div>
    <div class="row">

      <div class="six columns border">
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
          <label for="exampleRecipientInput">filtrer par :</label>
          <select id="select" class="u-full-width" onchange="update()">
            <option value="Nom">Nom</option>
            <option value="Ages">Ages</option>
            <option value="NbJeuxDispos">Quantité disponibles</option>
          </select>
          <input type="checkbox" id="order" onchange="update()"> décroissante</input>
        </div>
      </div>
      <div class="six columns border">
        <h4>Connexion </h4>

        <div class="container-col">
          <?php
          //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
          if (!isset($_SESSION['nom_client'])) {
          ?>

          <div class="row" id="form" >
            <form action="" name="connexion" method="post" enctype="multipart/form-data">

              <div class="six columns">
                <label>Identifiant</label>
                <input class="u-full-width" type="text"  placeholder="Utilisateur" id="login" name="login" />
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
          "+ " + arr[i].Ages +
          "</td><td>" +
          arr[i].Type +
          "</td><td>" +
          arr[i].NbJeuxDispos + " / " + arr[i].NbJeux +
          "</td></tr>";
      }
      // out += "</table>";
      document.getElementById("TABLE").innerHTML = out;
    }


    function tagCallback(theTag, str, order) {

      console.log('callback executed');
      var request = new XMLHttpRequest();
      request.open('GET', "Get_items.php?q=" + str + "&order=" + order, true);
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
    tagCallback(DisplayTab, filter, order);


    function update() {
      if (document.getElementById('order').checked) {
        var order = 'DESC'
        tagCallback(DisplayTab, document.getElementById('select').value, order);
      } else {
        var order = ''
        tagCallback(DisplayTab, document.getElementById('select').value, order);
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
      login = document.connexion.login.value;
      password = document.connexion.password.value;
      xhr.send("login=" + escape(login) + "&password=" + escape(password));
    }
  </script>
</body>

</html>
