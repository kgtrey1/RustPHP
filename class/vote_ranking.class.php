<?php
	class Vote_ranking
	{
		public function add_vote($username)
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
  			$query = $db->prepare('UPDATE rp_users SET vote = vote + 1 WHERE username = :username');
  			$query->execute(array('username' => $username));
		}

		public function get_leaderboard()
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
  			$query = $db->prepare('SELECT username, vote FROM rp_users ORDER BY vote DESC LIMIT 0, 15');
			$query->execute();
			$it = 1;
			while ($result = $query->fetch())
			{
				$ranking[$it][0] = htmlspecialchars($result['username']);
				$ranking[$it][1] = htmlspecialchars($result['vote']);
				$it = $it + 1;
			}
			$query->closeCursor();
			return $ranking;
		}
	}
?>