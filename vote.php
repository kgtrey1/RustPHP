<?php
  require("config/session.php");
  require("config/config.php");
?>

<!DOCTYPE html>
<html>
  <head>
  	<title>Voter - <?php echo($server_name); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src='js/rustservers.js'></script>
    <script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>
    <?php
      include("template/header.php");
    ?>
    <div class="container" style="min-height: 81vh; background-color: white; display: flex;">
      <div style="margin-top: auto; margin-bottom: auto; width: 100%">
    <?php 
      include("template/vote_plugin.php");
      include("template/vote_ranking.php");
      ?>
    </div>
  </div>
    <?php
      include("template/footer.php");
    ?>
  </body>
</html>