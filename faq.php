<?php
  require("config/session.php");
  require("config/config.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
    <title>FAQ - <?php echo($server_name); ?></title>
  </head>
  <body>
    <?php include_once("template/header.php"); ?>

    <div class="container" style="min-height: 81vh; background-color: white;">
    	<div id="accordion">
  			<div class="card" style="">
    			<div class="card-header" id="headingOne">
      				<h5 class="mb-0">
        				<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          					Collapsible Group Item #1
        				</button>
      				</h5>
    			</div>
				<div id="collapseOne" class="collapsed collapse" aria-labelledby="headingOne" data-parent="#accordion">
      				<div class="card-body">
        				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      				</div>
    			</div>
  			</div>
  		</div>
	</div>

    <?php include_once("template/footer.php"); ?>
	</body>
</html>