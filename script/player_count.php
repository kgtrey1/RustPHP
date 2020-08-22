<?php
	require("rcon.php");
	include("time.temp.php");

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

    if ($time < (time() - 1))
    {	
		$host = 'skillofsurvive.tk'; // Server host name or IP
    	$port = 28016;                      // Port rcon is listening on
    	$password = "molosse1"; // rcon.password setting set in server.properties
    	$rcon = new Rcon($host, $port, $password);
    	$rcon->connect();
    	$packet_id = $rcon->send("say helooo");
        $notification = $rcon->get_notification($packet_id);
        $response = $rcon->get_response($packet_id);
    	$rcon->disconnect();

        echo ("<br><br>NOTIF = $notification<br>RESP = $response<br>");
        /*
        if (!preg_match("#Error#", $response))
        {
            echo("<br><br><br>Response is not an error<br><br><br>");
            $response = strstr($response, "players");
            $player_number = get_number($response, 10);
            $response = strstr($response, "(");
            $player_max = get_number($response, 1);
        
    	$player = $player_number . "/" . $player_max;
		$file = fopen('time.temp.php', 'r+');
		fputs($file, "<?php \$time = " . time() . "; \$player_status = '$player'; ?>");
		fclose($file);
        }*/
	}
    echo("<br><br><br>Response is an error<br><br><br>");
	echo $player_status;
?>