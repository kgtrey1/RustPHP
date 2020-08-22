<?php
	
	function user_is_admin()
	{
		if (user_is_connected() AND $_SESSION['is_admin'] == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function user_is_connected()
	{
		if (isset($_SESSION['id']) AND isset($_SESSION['username']) AND isset($_SESSION['steamid']) AND isset($_SESSION['is_admin']) AND isset($_SESSION['ip']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function user_check_ip()
	{
		if (user_is_connected())
		{
			if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
			{
				$_SESSION = array();
				session_destroy();
				header('index.php');
			}
		}
	}
	session_start();
	user_check_ip();
?>