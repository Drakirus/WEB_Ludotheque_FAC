<?php
if(!isset($_SESSION))
    {
        session_start();
    }
?>
  <style type="text/css">#form{display:none;}#form-title{display:none;}#logged-title{display: block;}</style>

  <table class="u-full-width">
      <thead>
      <?php
        if($_SESSION["nom_client"]) {
      ?>
      Salut <?php echo $_SESSION["nom_client"]; ?>. <br/><a href="logout.php" tite="Logout">ce déconecter.
      <?php
        }else {
          header("Location:index.php");
        }
      ?>
      <thead>
  </table>
