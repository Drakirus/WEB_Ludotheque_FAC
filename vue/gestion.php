<div class="row">

  <div class="twelve col border">
    <h4>Gestion des stocks</h4>

    <div class="container-col">

      <form action="" name="item" method="post" enctype="multipart/form-data">
        <div class="row" >
          <div class="row">
            <label>Nom du jeu</label>
            <input class="u-full-width" type="text" placeholder="écheque" name="nom" />
          </div>
          <div class="row">
          <div class="six col">
            <label>Age minimum</label>
            <input class="u-full-width" type="text" placeholder="9" name="age" />
          </div>
          <div class="six col">
            <label>Quantité</label>
            <input class="u-full-width" type="text" placeholder="9" name="qt" />
          </div>

          <div class="row">
            <div class="six col">
              <label>Type de jeu</label>
              <input class="u-full-width" type="text" placeholder="Stratégie" name="typejeux" />
            </div>
            <div class="six col">
              <label>image</label>
              <input class="u-full-width" type="text" placeholder="http://i.imgur.com/rKqFxUz.jpg" name="image" />
            </div>
            <label>Description</label>
            <textarea class="u-full-width" placeholder="Description …" name="summ"></textarea>
          </div>
        <input type="button" name="submit" value="Ajouter" onclick="new_item(nom.value, age.value, typejeux.value, image.value, summ.value, qt.value);" />
        </div>
      </form>
      <br/>
      <div id="message"></div>
    </div>
  </div>
</div>

<div class="row">

  <div class="twelve col border">
    <h4>Suppresion</h4>

    <div class="container-col">
      <form action="" name="item" method="post" enctype="multipart/form-data">
        <div class="row" >
          <div class="row">
          <label>Nom du jeu à supprimer</label>
            <input class="u-full-width" type="text" placeholder="écheque" name="nomsup" />
          </div>
            <input type="button" name="submit" value="Suppression" onclick="del_item(nomsup.value);" />
      </form>
      <br/>
      <div id="messageSupp"></div>
    </div>

    </div>
  </div>
</div>

<script type="text/javascript"> // Nouveau item
function new_item(nom, age, type, image, summ, qt) {
  // alert (nom + ' ' +  age + ' ' +  type + ' ' +  image + ' ' +  summ + ' ' +  qt);
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      reponse = xhr.responseText;
      document.getElementById('message').innerHTML = reponse;
    }
  }

  xhr.open("POST", "controleur/new_item.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send("nom=" + (nom) + "&agejeu=" + (age) + "&type=" + (type) + "&image=" + (image) + "&summ=" + (summ) + "&qt=" + (qt) );
}

function del_item(nom) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      reponse = xhr.responseText;
      document.getElementById('messageSupp').innerHTML = reponse;
    }
  }

  xhr.open("POST", "controleur/supp_item.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xhr.send("nom=" + (nom));
}
</script>
