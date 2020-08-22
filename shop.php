<?php
	/*
	** shop.php for rustphp
	**
	** Made by kgtrey1
	** Email admin@kgtrey1.eu
	**
	** Started on 05-Oct-2018 by kgtrey1
	*/

	require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/config/server_config.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/class/shop_loader.class.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="kgtrey1">
    	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    	<link rel="stylesheet" type="text/css" href="css/style.css">
    	<script type="text/javascript" src="js/jquery.min.js"></script>
    	<script type="text/javascript" src="js/popper.min.js"></script>
    	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    	<script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>
    	<title>Boutique - <?php echo($site_name); ?></title>
	</head>
	<body>
		<?php
			include_once($_SERVER["DOCUMENT_ROOT"] . "/template/header.php");
			include_once($_SERVER["DOCUMENT_ROOT"] . "/template/shop.php");
			include_once($_SERVER["DOCUMENT_ROOT"] . "/template/footer.php");
			$shop->load_javascript();
		?>
	</body>
</html>