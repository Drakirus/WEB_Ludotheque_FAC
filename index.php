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
      <div class="eleven col">
        <br/>
        <p>Ici enfants et leurs parents peuvent réserver des jeux (disponibles) et venir les chercher à un créneau horaire défini. Les jeux sont triés selon différents critères : âges des enfants, activité calme ou dynamique, jeu individuel ou collectif,
          etc. </p>

      </div>
    </div>
    <div class="row">

      <div class="eight col border">
        <h4>Liste des jeux disponibles</h4>
        <div class="container-col">

          <label for="exampleRecipientInput">Recherche : (En fonction du filtre)</label>
          <input class="u-full-width" type="search"  id="recherche" placeholder="Recherche" name="find" onkeyup="update()" />

          <label for="exampleRecipientInput">Filtrer par :</label>
          <select id="select" class="u-full-width" onchange="update()">
            <option value="Nom">Nom du jeux</option>
            <option value="Ages">Ages</option>
            <option value="Type_jeux">Type de jeux</option>
            <option value="NbJeuxDispos">Quantité disponibles</option>
          </select>
          <input type="checkbox" id="order" onchange="update()">  Décroissante</input>

          <table class="u-full-width">
            <thead>
              <tr>
                <th>Jeux</th>
                <th>Age</th>
                <th>Type</th>
                <th>Restant</th>
                <th class='logged-reserver' >Réservez</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="TABLE"></tbody>
          </table>

        </div>
      </div>
      <div class="four col border">
        <h4 id="form-title" >Connexion </h4>
        <h4 id="logged-title" >Jeux Réservé</h4>

        <div class="container-col">
          <?php
          //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
          if (!isset($_SESSION['nom_client'])) {
          ?>

          <div class="row" id="form" >
            <form action="" name="connexion" method="post" enctype="multipart/form-data">

              <div class="six col">
                <label>Email</label>
                <input class="u-full-width" type="email"  placeholder="Utilisateur" id="login" name="login" />
              </div>
              <div class="six col">
                <label>Mot de passe</label>
                <input class="u-full-width" type="password" placeholder="********" id="password" name="password" />
              </div>

              <input type="button" name="submit" value="Envoyer" onclick="verification(login.value, password.value);" />
            </form>
          </div>
          <div id="user_dashboard">
            <?php }else{
              //header("Location:user_dashboard.php");
              echo "<div id='user_dashboard'>";
              include './user_dashboard.php';
            } ?>
          </div>
          <div id="message"></div>
          <br/>
        </div>
      </div>
    </div>
  </div>

  <script language="javascript" type="text/javascript" src="./controleur\datetimepicker.js">  </script>
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

          "</td> <td>" +
          "<a class='logged-reserver' href=\"javascript:NewCal('"+ i+
          "','ddmmyyyy',true,24)\"> <input class='date' value='Date' id='" +
          i+
          "' type='text'></a>" +
          "</td><td><input type='button' value='Réservez' class='logged-reserver' href='' name='" + arr[i].Name + "' onclick='reserver(name,"+i+")'> </td> </tr>";
      }
      // out += "</table>";
      document.getElementById("TABLE").innerHTML = out;
    }
    function update_user_dashboard(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            reponse = xhr.responseText;
            document.getElementById('user_dashboard').innerHTML = reponse;
          }
        }

      xhr.open("POST", "./user_dashboard.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
      xhr.send();
    }

    function reserver(Name, dateID){
      console.log(Name);
      var x=document.getElementById(dateID).value;
      if (x == "Date") {
        var alertMsg = "<a  id=\"alert\" class=\"alert\" href=\"#\">date non définie</a>"
        document.getElementById('message').innerHTML = alertMsg;
        return;
      }
      // alert(x);
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          reponse = xhr.responseText;
          if(reponse == "ok"){
            update_user_dashboard();
            update();
          }else{
          document.getElementById('message').innerHTML = reponse;
          }
        }
      }

      xhr.open("POST", "./new_emprunt.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
      xhr.send("item=" + escape(Name)+ "&date=" + x);
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
          document.getElementById('user_dashboard').innerHTML = reponse;
        }
      }

      xhr.open("POST", "./verification_connexion.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
      xhr.send("login=" + escape(login) + "&password=" + escape(password));
    }
  </script>
</body>
</html>
