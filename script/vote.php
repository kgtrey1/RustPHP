<?php
	require ($_SERVER['DOCUMENT_ROOT'] . "/config/session.php");
	require ($_SERVER['DOCUMENT_ROOT'] . "/class/rustservers.class.php");
	
	if ($_POST['query'] == "rustservers")
	{
		require ($_SERVER['DOCUMENT_ROOT'] . "/script/time.temp.php");

		if ($player_status == "offline")
		{
			echo("-42");
			return 0;
		}
		else
		{
			$vote = new Vote_rustservers($_SESSION['steamid']);
			$response = $vote->query_rustservers();
			if ($response == 0)
			{
				echo("0");
				return (0);
			}
			else if ($response == 1)
			{
				require ($_SERVER['DOCUMENT_ROOT'] . "/class/vote_ranking.class.php");

				$ranking = new Vote_ranking();
				$ranking->add_vote(htmlspecialchars($_SESSION['username']));
				$vote->claim_rustservers();
				echo "1";
				return (0);
			}
			else if ($response == 2)
			{
				echo("2");
				return (0);
			}
			else
			{
				echo("error");
				return 0;
			}
		}
	}
?>