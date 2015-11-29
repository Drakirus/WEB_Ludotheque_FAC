<div class="row">

  <div class="twelve col border">
    <h4>Gestion des stocks</h4>

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
