<?php
	/*
	** /admin/script/news_delete.php for RustPHP
	**
	** Made by kgtrey1
	** Email admin@kgtrey1.eu
	**
	** Started on 01-Oct-2018 by kgtrey1
	*/

	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

		if (user_is_connected() AND user_is_admin())
		{
			if (isset($_POST['title']))
			{
				require_once($_SERVER["DOCUMENT_ROOT"] . "/class/news.class.php");

				$news = new News_manager();
				$news->delete_news_by_title($_POST['title']);
				echo("SUCCESS");
				return(0);
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