<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>S'inscrire</title>
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
        <p>Pour accéder au service de réservation, il faut vous créer un compte </p>

      </div>
    </div>
    <div class="row">

      <div class="twelve col border">
        <h4 id="form-title">Inscription </h4>
        <h4 id="logged-title">Jeux Réservé</h4>

        <div class="container-col">

          <form action="" name="connexion" method="post" enctype="multipart/form-data">
            <div class="row" id="form">

              <div class="six col">
                <label>Nom d'Utilisateur</label>
                <input class="u-full-width" type="text" placeholder="Utilisateur" name="login" />
              </div>
              <div class="six col">
                <label>Adresse email</label>
                <input class="u-full-width" type="text" placeholder="Email" name="email" />
              </div>

              <div class="row">
                <div class="six col">
                  <label>Mot de passe</label>
                  <input class="u-full-width" type="password" placeholder="********" name="password" />
                </div>
                <div class="six col">
                  <label>Vérifiez le mot de passe</label>
                  <input class="u-full-width" type="password" placeholder="********" name="password_bis" />
                </div>

              </div>
            <input type="button" name="submit" value="Envoyer" onclick="upload(login.value, email.value, password.value, password_bis.value);" />
            </div>
          </form>
          <div id="message"></div>
          <br/>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
function upload(login, email, password, password_bis) {
  // alert (login + ' ' +  email + ' ' +  password + ' ' +  password_bis);
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      reponse = xhr.responseText;
      document.getElementById('message').innerHTML = reponse;
    }
  }

  xhr.open("POST", "./new_account.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send("login=" + escape(login) + "&email=" + escape(email) + "&password=" + escape(password) + "&password_bis=" + escape(password_bis));
}
</script>
</body>

</html>
