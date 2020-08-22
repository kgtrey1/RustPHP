<?php

	function get_number($response, $it_res)
	{
		$it = 0;

		while (is_numeric($response[$it_res]))
    	{
    		$str[$it] = $response[$it_res];
    		$it = $it + 1;
    		$it_res = $it_res + 1;
    	}
    	return (implode($str));
	}

	function get_player_count()
	{
		require($_SERVER['DOCUMENT_ROOT'] . "/config/rcon-config.php");
		require($_SERVER['DOCUMENT_ROOT'] . "/script/rcon.php");
		include($_SERVER['DOCUMENT_ROOT'] . "/script/time.temp.php");

		if (time() > ($time + 50))
		{
    		$rcon = new Rcon($rcon_host, $rcon_port, $rcon_password);
    		if ($rcon->connect() == -42)
    		{
    			$file = fopen('script/time.temp.php', 'w+');
				fputs($file, "<?php \$time = " . time() . "; \$player_status = 'offline'; ?>");
				fclose($file);
    		}
    		else
    		{
    			$query = $rcon->send("status");
    			$response = $rcon->read($query);
    			$rcon->disconnect();
    			$response = strstr($response, "players");
    			$player_number = get_number($response, 10);
    			$response = strstr($response, "(");
    			$player_max = get_number($response, 1);
    			if ($player_number != NULL && $player_max != NULL)
    			{
    				$player = $player_number . "/" . $player_max;
					$file = fopen('script/time.temp.php', 'w+');
					fputs($file, "<?php \$time = " . time() . "; \$player_status = '$player'; ?>");
					fclose($file);
				}
				else
				{
					$file = fopen('script/time.temp.php', 'w+');
					fputs($file, "<?php \$time = " . time() . "; \$player_status = '$player_status'; ?>");
					fclose($file);
				}
			}
		}
		return $player_status;
	}
?>
