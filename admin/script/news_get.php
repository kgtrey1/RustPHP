<?php
	/*
	** /admin/script/news_get.php for RustPHP
	**
	** Made by kgtrey1
	** Email admin@kgtrey1.eu
	**
	** Started on 01-Oct-2018 by kgtrey1
	*/

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

		if (user_is_connected() AND user_is_admin())
		{
			if (isset($_POST['title']))
			{
				require_once($_SERVER["DOCUMENT_ROOT"] . "/class/news.class.php");

				$news = new News_manager();
				$news_content = $news->get_news($_POST['title']);
				header('Content-Type: application/json; Charset=UTF-8');
				echo json_encode($news_content);
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