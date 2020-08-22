<?php
	
/*
** /script/connection.php for RustPHP
**
** Made by kgtrey1
** Email admin@kgtrey1.eu
**
** Started on 01-Sep-2018 by kgtrey1
*/

	require_once($_SERVER["DOCUMENT_ROOT"] . "/config/recaptcha.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/script/recaptcha.php");

	class Connection
	{
		private $username;
		private $password;

		function __construct($username, $password)
		{
			$this->username = htmlspecialchars($username);
			$this->password = htmlspecialchars($password);
		}

		public function connect()
		{
			require($_SERVER["DOCUMENT_ROOT"] . "/config/config.php");

			try
			{
				$db = new PDO($db_host, $db_user, $db_pass);
			}
			catch (Exception $e)
			{
        		die ('Erreur : ' . $e->getMessage());
  			}
  			
			$query = $db->prepare('SELECT * FROM rp_users WHERE username = :username');
			$query->execute(array('username' => $this->username));
			$result = $query->fetch();
			$query->closeCursor();
			if (password_verify($this->password, $result['password']))
			{
				session_start();
        		$_SESSION['id'] = $result['id'];
        		$_SESSION['username'] = $result['username'];
        		$_SESSION['steamid'] = $result['steamid'];
        		$_SESSION['is_admin'] = $result['is_admin'];
        		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        		$_SESSION['coin'] = $result['coin'];
        		echo("SUCCESS");
			}
			else
			{
				echo("Mauvais identifiants.");
			}
		}

		public function check_fields()
		{
			if ($this->username == "" OR $this->password == "")
				return false;
			if (preg_match("#[^A-Za-z0-9]#", $this->username))
				return false;
			if (strlen($this->username) < 3)
				return false;
			if (strlen($this->username) > 20)
				return false;
			if (preg_match("#[^A-Za-z0-9]#", $this->password))
				return false;
			if (strlen($this->password) < 6)
				return false;
			if (strlen($this->password) > 20)
				return false;
			return true;
		}
	}

	if (isset($_POST['username'], $_POST['password']))
	{
		if (is_string($_POST['username']) AND is_string($_POST['password']))
		{
			$user = new Connection($_POST['username'], $_POST['password']);
			if ($user->check_fields())
			{
				$user->connect();
				return 0;
			}
			else
			{
				echo("Mauvais identifiants.");
				return 0;
			}
		}
		else
		{
			echo("Erreur AJAX.");
			return 0;
		}
	}
	else
	{
		echo("Erreur AJAX.");
		return 0;
	}

?>
