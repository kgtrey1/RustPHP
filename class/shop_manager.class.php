<?php
	class Shop_manager
	{
		private $item_name;
		private $item_price;
		private $item_command;
		private $db;


		public function handle_purchase($id)
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

			if(user_is_connected() && ctype_digit($id))
			{
				$this->verify_id($id);
				$this->verify_coin();
				$this->deliver_purchase();
				$this->make_log();
				return true;
			}
			else
			{
				die("dsfsd");
			}
		}

		private function make_log()
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

			if (user_is_connected() && ctype_digit($_SESSION['coin']))
			{
				$log = (date("[d/m/Y] [H:i:s] ") . $_SESSION['username'] . " purchased " . $this->item_name . "(Had : " . ($_SESSION['coin'] + $this->item_price) . " coin | Now : " . $_SESSION['coin'] . " coin)." . PHP_EOL);
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/logs/purchase/" . date("d.m.Y") . ".txt", $log, FILE_APPEND);
				chmod($_SERVER['DOCUMENT_ROOT'] . "/logs/purchase/" . date("d.m.Y") . ".txt", 0600);
			}
			else
			{
				die();
			}
		}

		private function deliver_purchase()
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

			if (user_is_connected())
			{
				require ($_SERVER['DOCUMENT_ROOT'] . "/config/rcon-config.php");
				require ($_SERVER['DOCUMENT_ROOT'] . "/script/rcon.php");

				$this->item_command = str_replace("|playername|", $_SESSION['steamid'], $this->item_command);
				$rcon = new Rcon($rcon_host, $rcon_port, $rcon_password);
				$rcon->connect();
				$rcon->read($rcon->send($this->item_command));
				$rcon->disconnect();
			}
			else
			{
				die();
			}
		}

		private function debit_coin()
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

			if (user_is_connected() && ctype_digit($_SESSION['coin']))
			{
				$_SESSION['coin'] = ($_SESSION['coin'] - (int)$this->item_price);
				$this->init_db();
				$query = $this->db->prepare('UPDATE rp_users SET coin = :coin WHERE username = :username');
            	$query->execute(array('username' => htmlspecialchars($_SESSION['username']), 'coin' => $_SESSION['coin']));
            }
            else
            {
            	die();
            }
		}

		private function verify_coin()
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

			if (user_is_connected() && ctype_digit($_SESSION['coin']))
			{
				if ($_SESSION['coin'] >= (int)$this->item_price)
				{
					$this->init_db();
					$query = $this->db->prepare('SELECT coin FROM rp_users WHERE username = :username');
					$query->execute(array('username' => htmlspecialchars($_SESSION['username'])));
					$result = $query->fetch();
					$query->closeCursor();
					if($result['coin'] >= $this->item_price)
					{
						$this->debit_coin();
						return(true);
					}
					else
					{
						die("Pas assez riche");
					}
				}
				else
				{
					die("pas assez riche " . $coin . "/" . $this->item_price);
				}
			}
			else
			{
				die();
			}
		}

		private function verify_id($id)
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

			if (user_is_connected() && ctype_digit(htmlspecialchars($id)))
			{
				$this->init_db();
				$query = $this->db->prepare('SELECT * FROM rp_shopitems WHERE id = :id');
				$query->execute(array('id' => (int)$id));
				$result = $query->fetch();
				$query->closeCursor();
				$this->item_name = htmlspecialchars($result['name']);
				$this->item_price = htmlspecialchars($result['price']);
				$this->item_command = htmlspecialchars($result['command']);
				if ($this->item_name != NULL && $this->item_price != NULL && $this->item_command != NULL && ctype_digit($this->item_price))
				{
					return true;
				}
				else
				{
					die("Une erreur est survenue durant la recherche de l'article.");
				}
			}
			else
			{
				die("Une erreur est survenue, contactez le webmaster.");
			}
		}

		private function init_db()
		{
			require ($_SERVER["DOCUMENT_ROOT"] . "/config/config.php");	

			try
    		{
    			$this->db = new PDO($db_host, $db_user, $db_pass);
    		}
    		catch (Exception $e)
    		{
    			die ('Erreur : ' . $e->getMessage());
    		}
		}
	}
?>