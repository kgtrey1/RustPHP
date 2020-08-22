<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . "/class/vote_plugin.class.php");
	
	if (isset($_POST['link']) && isset($_POST['reward']) && isset($_POST['command']) && isset($_POST['site_key']) && isset($_POST['desc']))
	{
		$rustservers = new vote_plugin("rustservers");
		$rustservers->update_info($_POST['link'], $_POST['reward'], $_POST['command'], $_POST['site_key'], $_POST['desc']);
		echo 0;
	}
?>