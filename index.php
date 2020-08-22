<?php
  require("config/session.php");
  require("config/config.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
    <title>Accueil - <?php echo($server_name); ?></title>
  </head>
  <body>
    <?php
      include_once("template/header.php");
      include_once("template/slider.php");
      include_once("template/news.php");
      include_once("template/social.php");
      include_once("template/footer.php");
    ?>
  </body>
</html>
