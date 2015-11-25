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
function update_user_dashboard(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        reponse = xhr.responseText;
        document.getElementById('user_dashboard').innerHTML = reponse;
      }
    }

  xhr.open("POST", "./controleur/user_dashboard.php", true);
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

  xhr.open("POST", "./controleur/new_emprunt.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send("item=" + escape(Name)+ "&date=" + x);
}

function RechercheItems(theTag, str, order, recherche) {

  console.log(recherche);
  var request = new XMLHttpRequest();
  request.open('GET', "./controleur/Get_items_recherche.php?q=" + str + "&order=" + order + "&recherche=" + recherche, true);
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

  xhr.open("POST", "./controleur/verification_connexion.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send("login=" + escape(login) + "&password=" + escape(password));
}
