<?php

	function get_page_number()
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
    	$query = $db->prepare('SELECT COUNT(*) FROM rp_page');
    	$query->execute();
    	$num = $query->fetchColumn();
    	$query->closeCursor();
    	return ($num);
	}

	function get_page_data()
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
  		$query = $db->prepare('SELECT * FROM rp_page');
    	$query->execute();
    	$it = 0;
    	while($result = $query->fetch())
    	{
      		$data[$it]['name'] = htmlspecialchars($result['name']);
      		$data[$it]['href'] = htmlspecialchars($result['href']);
      		$data[$it]['img'] = htmlspecialchars($result['img']);
      		$it = $it + 1;
    	}
    	return ($data);
	}

	function print_page($page_data, $page_number)
	{
		$it = 0;
    	while ($it != $page_number)
    	{
    		?>
    		<li class="nav-li">
    			<a class="nav-a" href=" <?php echo($page_data[$it]['href']); ?> ">
    				<img class = "nav-img" src="<?php echo($page_data[$it]['img']); ?>">
    				<?php echo($page_data[$it]['name']); ?> 
    			</a>
    		</li>
    		<?php
    		$it = $it + 1;
    	}
	}

?>