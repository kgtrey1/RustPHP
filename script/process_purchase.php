<?php
	/*
	** /admin/script/news_add.php for RustPHP
	**
	** Made by kgtrey1
	** Email admin@kgtrey1.eu
	**
	** Started on 05-Oct-2018 by kgtrey1
	*/

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

		if(user_is_connected())
		{
			if (isset($_POST['id']) AND ctype_digit($_POST['id']))
			{
				require_once($_SERVER["DOCUMENT_ROOT"] . "/class/shop_manager.class.php");

				$purchase = new Shop_manager;
				if($purchase->handle_purchase($_POST['id']))
				{
					die("SUCCESS");
				}
			}
			else
			{
				die("id n'est pas entier");
			}
		}
		else
		{
			die("pas co");
		}
	}
	else
	{
		die("dfsdef");
	}
?>