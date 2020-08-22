<?php
	class Vote_rustservers
	{
		private $site_key;
		private $command;
		private $steamid;

		function __construct($steamid)
		{
			require ($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");

			$db = new PDO($db_host, $db_user, $db_pass);
			$query = $db->prepare('SELECT * FROM rp_vote WHERE website = ?');
			$query->execute(array("rustservers"));
			$result = $query->fetch();
			$query->closeCursor();
			$this->site_key = $result['site_key'];
			$this->command = $result['command'];
			$this->steamid = $steamid;
		}

		public function query_rustservers()
		{
			$url = "https://rust-servers.net/api/?object=votes&element=claim&key={$this->site_key}&steamid={$this->steamid}";
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($curl);
			return $response;
		}

		public function claim_rustservers()
		{
			require ($_SERVER['DOCUMENT_ROOT'] . "/config/rcon-config.php");
			require ($_SERVER['DOCUMENT_ROOT'] . "/script/rcon.php");

			$url = "https://rust-servers.net/api/?action=post&object=votes&element=claim&key={$this->site_key}&steamid={$this->steamid}";
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_exec($curl);
			$this->command = str_replace("|playername|", $this->steamid, $this->command);
			$rcon = new Rcon($rcon_host, $rcon_port, $rcon_password);
			$rcon->connect();
			$rcon->read($rcon->send($this->command));
			$rcon->disconnect();		
		}
	}
?>