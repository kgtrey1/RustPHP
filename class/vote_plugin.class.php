<?php
	class Vote_plugin
	{
		private $website;
		private $link;
		private $desc;
		private $reward;
		private $site_key;
		private $command;

		public function __construct($website)
		{
			if ($website == "rustservers" OR $website == "trackyserver")
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
  				$query = $db->prepare('SELECT link, description, reward, site_key, command FROM rp_vote WHERE website = :website');
				$query->execute(array('website' => $website));
				$result = $query->fetch();
				$query->closeCursor();
				$this->website = htmlspecialchars($website);
				$this->link = htmlspecialchars($result['link']);
				$this->desc = htmlspecialchars($result['description']);
				$this->reward = htmlspecialchars($result['reward']);
				$this->site_key = htmlspecialchars($result['site_key']);
				$this->command = htmlspecialchars($result['command']);
			}
			else
			{
				$this->link = "";
				$this->desc = "";
				$this->reward = "";
				$this->site_key = "";
				$this->command = "";
			}
		}

		public function update_info($link, $reward, $command, $site_key, $description)
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
  			$query= $db->prepare('UPDATE rp_vote SET link = :link, reward = :reward , command = :command, site_key = :site_key, description = :description  WHERE website = :website');
			$query->execute(array('website' => $this->website, 'link' => $link, 'reward' => $reward, 'command' => $command, 'site_key' => $site_key, 'description' => $description));
		}

		public function link()
		{
			return ($this->link);
		}

		public function desc()
		{
			return ($this->desc);
		}

		public function reward()
		{
			return ($this->reward);
		}

		public function site_key()
		{
			return ($this->site_key);
		}

		public function command()
		{
			return ($this->command);
		}
	}
?>