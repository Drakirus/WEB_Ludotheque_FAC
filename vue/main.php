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
      <label>(cliquez pour plus d'info)</label>
      <br/>
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
            <label>Password</label>
            <input class="u-full-width" type="password" placeholder="********" id="password" name="password" />
          </div>

          <input type="button" name="submit" value="Envoyer" onclick="verification(login.value, password.value);" />
        </form>
      </div>
      <div id="user_dashboard">
        <?php }else{
          //header("Location:user_dashboard.php");
          echo "<div id='user_dashboard'>";
          include './controleur/user_dashboard.php';
        } ?>
      </div>
      <div id="message"></div>
      <br/>
    </div>
  </div>
  </div>

  <div class="four col border top">
    <h4 >Dernier Jeux </h4>
    <div class="container-col">
      <table>
        <thead>
          <tr>
            <th>Jeux</th>
            <th>Age</th>
            <th>Type</th>
            <th>Restant</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include './controleur/Get_last_item.php';
          ?>
        </tbody>
      </table>
    </div>
  </div>

  </div>
