<?php
	require("config/config.php");
	require("config/session.php");
?>



<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
    	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="css/style.css">
    	<script type="text/javascript" src="js/jquery.min.js"></script>
    	<script type="text/javascript" src="js/popper.min.js"></script>
    	<script type="text/javascript" src="js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    	<title>Support - <?php echo($server_name); ?></title>
	</head>
	<body>
		<header> <?php include("template/header.php");?> </header>




<?php
	include("template/faq.php");

 ?>

	</body>
</html>
