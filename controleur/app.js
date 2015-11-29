// Fonction qui affiche le tableau des items
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
      "<a  class='logged-reserver' href=\"javascript:NewCal('"+ i+
      "','ddmmyyyy',true,24)\"> <input class='date' value='Date' id='" +
      i+
      "' type='text'></a>" +
      "</td><td><input class='logged-reserver'  type='button' value='Réservez' name='" + arr[i].Name + "' onclick='reserver(name,"+i+")'> </td> </tr>";
  }
  // out += "</table>";
  document.getElementById("TABLE").innerHTML = out;
}
function update_user_dashboard(){ // AJAX affiche le contenu du résultat de la gestion du dashboard de l'utilisateur dans la div "user_dashboard"
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        reponse = xhr.responseText;
        document.getElementById('user_dashboard').innerHTML = reponse;
      }
    }

  xhr.open("POST", "./controleur/user_dashboard.php", true); // script a utiliser
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send(); // envoi de la requette
}

function reserver(Name, dateID){ // Réservation d'un item
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
      document.getElementById('message').innerHTML = reponse; // affichage de la réponse
      }
    }
  }

  xhr.open("POST", "./controleur/new_emprunt.php", true); // script a utiliser
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send("item=" + escape(Name)+ "&date=" + x); // envoi de la requette
}

function RechercheItems(theTag, str, order, recherche) { // recherche d'un item

  console.log(recherche);
  var request = new XMLHttpRequest();
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  request.onload = function() {
    if (request.status == 200) {
      var data = request.responseText;
      theTag(data);

    }
  }

  request.send();// envoi de la requette
}

// au chargement de la page affichage des item
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

function verification(login, password) { // login

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      reponse = xhr.responseText;
      document.getElementById('user_dashboard').innerHTML = reponse;
    }
  }

  xhr.open("POST", "./controleur/verification_connexion.php", true);// script a utiliser
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send("login=" + escape(login) + "&password=" + escape(password));// envoi de la requette
}
