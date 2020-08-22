<?php

/*
** /script/add_user.php for RustPHP
**
** Made by kgtrey1
** Email admin@kgtrey1.eu
**
** Started on 30-Aug-2018 by kgtrey1
*/

	require_once($_SERVER["DOCUMENT_ROOT"] . "/config/recaptcha.php");
	require_once($_SERVER["DOCUMENT_ROOT"] . "/script/recaptcha.php");

	class Register
	{	
		private $username;
		private $password;
		private $repassword;
		private $mail;
		private $steamid;
		private $captcha;

		public function __construct($username, $password, $repassword, $mail, $steamid, $captcha)
		{
			$this->username = htmlspecialchars($username);
			$this->password = htmlspecialchars($password);
			$this->repassword = htmlspecialchars($repassword);
			$this->mail = htmlspecialchars($mail);
			$this->steamid = htmlspecialchars($steamid);
			$this->captcha = htmlspecialchars($captcha);
		}

		public function check_fields()
		{
			if ($this->username == "" OR $this->password == "" OR $this->repassword == "" OR $this->mail == "")
			{
				echo("Un ou plusieurs champs sont vides.");
				return false;
			}
			if ($this->captcha == false)
			{
				echo("Captcha invalide");
				return false;
			}
			if (preg_match("#[^A-Za-z0-9]#", $this->username))
			{
				echo("Votre pseudonyme ne doit contenir que des lettres et des chiffres");
				return false;
			}
			if (strlen($this->username) < 3)
			{
				echo("Votre nom d'utilisateur doit faire 3 caractères minimum.");
				return false;
			}
			if (strlen($this->username) > 20)
			{
				echo("Votre nom d'utilisateur doit faire 20 caractères maximum.");
				return false;
			}
			if ($this->check_avail_user() > 0)
			{
				echo("Nom d'utilisateur déjà utilisé.");
				return false;
			}
			if ($this->password != $this->repassword)
			{
				echo("Les mots de passe entrés ne sont pas les mêmes.");
				return false;
			}
			if (preg_match("#[^A-Za-z0-9]#", $this->password))
			{
				echo("Votre mot de passe ne doit contenir que des lettres et des chiffres");
				return false;
			}
			if (strlen($this->password) < 6)
			{
				echo("Votre mot de passe doit faire 6 caractères minimum.");
				return false;
			}
			if (strlen($this->password) > 20)
			{
				echo("Votre mot de passe doit faire 20 caractères maximum.");
				return false;
			}
			if (!$this->check_strenght())
			{
				echo("Votre mot de passe doit comporter une au moins minuscule, une majuscule et un chiffre");
				return false;
			}
			if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL))
			{
				echo("Votre adresse e-mail est invalide.");
				return false;
			}
			if ($this->check_avail_mail() > 0)
			{
				echo("Adresse e-mail déjà utilisée.");
				return false;
			}
			if (preg_match("#[^0-9]#", $this->steamid) OR strlen($this->steamid) != 17)
			{
				echo("SteamID invalide");
				return false;
			}
			if ($this->check_avail_steamid() > 0)
			{
				echo("Votre SteamID est déjà utilisé.");
				return false;
			}
			return true;
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
        		$_SESSIOn['coin'] = $result['coin'];
        		$_SESSION['is_admin'] = $result['is_admin'];
        		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
			}
			else
			{
				echo("Erreur AJAX.");
			}
			echo("SUCCESS");
		}

		public function register()
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
    		$pass_hash = password_hash($this->password, PASSWORD_DEFAULT);
    		$query = $db->prepare('INSERT INTO rp_users(username, password, mail, steamid, remote_adress) VALUES(:username, :password, :mail, :steamid, :ip)');
    		$query->execute(array('username' => $this->username, 'password' => $pass_hash, 'mail' => $this->mail, 'steamid' => $this->steamid, 'ip' => $_SERVER['REMOTE_ADDR']));
		}

		private function check_avail_steamid()
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
    		$query = $db->prepare('SELECT COUNT(*) FROM rp_users WHERE steamid = :steamid');
    		$query->execute(array('steamid' => $this->steamid));
    		$num = $query->fetchColumn();
    		$query->closeCursor();
    		return ($num);
		}

		private function check_avail_mail()
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
    		$query = $db->prepare('SELECT COUNT(*) FROM rp_users WHERE mail = :mail');
    		$query->execute(array('mail' => $this->mail));
    		$num = $query->fetchColumn();
    		$query->closeCursor();
    		return ($num);
		}

		private function check_strenght()
		{
			if (preg_match("#[A-Z]#", $this->password))
			{
				if (preg_match("#[a-z]#", $this->password))
				{
					if (preg_match("#[0-9]#", $this->password))
						return true;
				}
			}
			return false;
		}

		private function check_avail_user()
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
    		$query = $db->prepare('SELECT COUNT(*) FROM rp_users WHERE username = :username');
    		$query->execute(array('username' => $this->username));
    		$num = $query->fetchColumn();
    		$query->closeCursor();
    		return ($num);
		}
	}

	if (isset($_POST['username'], $_POST['password'], $_POST['repassword'], $_POST['email'], $_POST['steamid'], $_POST['captcha']))
	{
		if (is_string($_POST['username']) AND is_string($_POST['password']) AND is_string($_POST['repassword']) 
			AND is_string($_POST['email']) AND is_string($_POST['steamid']) AND is_string($_POST['captcha']))
		{
			$captcha = new Recaptcha($RECAPTCHA_SECRET_KEY, $_POST['captcha']);
  			$new_user = new Register($_POST['username'], $_POST['password'], $_POST['repassword'], $_POST['email'], $_POST['steamid'], $captcha->check_token());
  			if($new_user->check_fields())
  			{
    			$new_user->register();
    			$new_user->connect();
  			}
  		}
  		else
  		{
  			echo("Erreur AJAX.");
  		}
  	}
  	else
  	{
  		echo("Erreur AJAX.");
  	}
?>