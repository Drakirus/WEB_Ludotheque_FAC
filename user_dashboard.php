<?php
if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>
  <head>
    <title>User Login</title>
    <style type="text/css">#form{display:none;}</style>
  </head>
<body>
  <table border="0" cellpadding="10" cellspacing="1" align="center">
    <tr class="tableheader">
      <td align="center">Utilistaeur profile</td>
    </tr>
    <tr class="tablerow">
      <td>
      <?php
      if($_SESSION["nom_client"]) {
      ?>
      Salut <?php echo $_SESSION["nom_client"]; ?>. Clic ici pour  <a href="logout.php" tite="Logout">ce déconecter.
      <?php

    }else {
      header("Location:index.php");
    }
      ?>
      </td>
    </tr>
  </table>
</body>
</html>
