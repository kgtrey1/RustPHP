<?php
	/*
	** /admin/script/social_edit.php for RustPHP
	**
	** Made by kgtrey1
	** Email admin@kgtrey1.eu
	**
	** Started on 02-Oct-2018 by kgtrey1
	*/

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

		if (user_is_connected() AND user_is_admin())
		{
			if (isset($_POST['id']) AND isset($_POST['link']) AND isset($_POST['content']))
			{
				require_once($_SERVER["DOCUMENT_ROOT"] . "/class/social_manager.class.php");

				
				if ($_POST['id'] == "discord")
					$id = "1";
				else if($_POST['id'] == "steam")
					$id = "2";
				else if($_POST['id'] == "rust")
					$id = "3";
				else
					die();
				$social = new Social_manager();
				$social->edit_social($id, $_POST['link'], $_POST['content']);
				echo ("SUCCESS");
				return (0);
			}
			else
			{
				die();
			}
		}
		else
		{
			die("error_admin");
		}
	}
	else
	{
		die();
	}
?>