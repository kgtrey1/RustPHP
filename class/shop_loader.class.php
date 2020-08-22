<?php
	class Shop_loader
	{
		private $category;
		private $items;
		private $db;

		public function __construct()
		{
			$this->init_db();
			$this->get_categories();
			$this->get_items();
			$this->load_html();
		}

		private function get_categories()
		{
			$query = $this->db->prepare('SELECT name FROM rp_shopcategories');
			$query->execute();
			$it = 0;
			while ($result = $query->fetch()) 
			{
				$this->category[$it] = $result['name'];
				$it = $it + 1;
			}
			$query->closecursor();
		}

		private function get_items()
		{
			$it_cat = 0;
			$it = 0;

			while ($this->category[$it_cat] != NULL)
			{
				$query = $this->db->prepare('SELECT * FROM rp_shopitems WHERE category = :category');
				$query->execute(array('category' => $this->category[$it_cat]));
				while($result = $query->fetch())
				{
					$this->items[$it]['id'] = $result['id'];
					$this->items[$it]['name'] = $result['name'];
					$this->items[$it]['image'] = $result['image'];
					$this->items[$it]['price'] = $result['price'];
					$this->items[$it]['category'] = $result['category'];
					$this->items[$it]['description'] = $result['description'];
					$it = $it + 1;
				}
				$query->closecursor();
				$it_cat = $it_cat + 1;
			}
		}

		private function load_container()
		{
			$it_cat = 0;

			while ($this->category[$it_cat] != NULL)
			{
				$it = 0;
				echo "<div class='col-lg-9' id='" . $this->category[$it_cat] . "'>";
				
				echo "<div class='row'>";
				while ($this->items[$it] != NULL)
				{
					if ($this->items[$it]['category'] == $this->category[$it_cat])
					{
						echo("<div class = 'col-lg-4'>");
						echo("<div class='card text-white bg-dark mb-3 text-center'>");
						echo("<div class='card-header'>" . $this->items[$it]['name'] . "</div>");
						echo("<div class='card-body text-dark'>");
						echo("<img src='" . $this->items[$it]['image'] ."' style='padding-bottom: 20px;'>");
						echo("<div class='d-flex' style='min-height: 100px;'> <p class='text-white' style='margin: auto;'>" . $this->items[$it]['description'] . "</p></div>");
						
						if (user_is_connected())
							echo("<input type='button' id ='button-" . $this->category[$it_cat] . "-" . $this->items[$it]['id'] . "' class='btn btn-success' value='" . $this->items[$it]['price'] ." coins'>");
						else
							echo("<input type='button' id ='button-" . $this->category[$it_cat] . "-" . $this->items[$it]['id'] . 
								"' class='btn btn-success' value='" . $this->items[$it]['price'] . " coins' DISABLED>");
						echo("</div></div></div>");
					}
					$it = $it + 1;
				}
				echo "</div></div>";
				$it_cat = $it_cat + 1;
			}
		}

		private function load_menu()
		{
			$it_cat = 0;
			echo "<div class='col-lg-3' style='justify-content: center;'>";
			echo "<div class='list-group'>";
			while ($this->category[$it_cat] != NULL) 
			{
				if ($it_cat == 0)
					echo "<button type='button' class='list-group-item list-group-item-action active' id ='button-" . $this->category[$it_cat] . "'>" .$this->category[$it_cat] . "</button>";
				else
					echo "<button type='button' class='list-group-item list-group-item-action' id ='button-" . $this->category[$it_cat] . "'>" .$this->category[$it_cat] . "</button>";
				$it_cat = $it_cat + 1;
			}
			echo "<a class='list-group-item list-group-item-action' href='checkout.php'>Acheter des coins</a>";
			echo "</div></div>";
		}

		private function load_html()
		{
			$this->load_menu();
			$this->load_container();
		}

		public function load_javascript()
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

			echo("<script type='text/javascript'>");
			echo("$('.list-group-item').on('click', function(){
					$('.active').removeClass('active');
					$(this).addClass('active');
				});");
			$it_cat = 0;
			while ($this->category[$it_cat] != NULL)
			{
				if ($it_cat != 0)
				{
					echo('$("#' . $this->category[$it_cat] . '").hide();');
				}
				echo('$("#button-' . $this->category[$it_cat] . '").click(function(){');
				$it_js = 0;
				while ($this->category[$it_js] != NULL)
				{
					echo('$("#' . $this->category[$it_js] . '").hide();');
					$it_js = $it_js + 1;
				}
				echo('$("#' . $this->category[$it_cat] . '").show();});');
				$it_cat = $it_cat + 1;
			}
			if (user_is_connected())
			{
				$it = 0;
				while ($this->items[$it]['name'] != NULL)
				{
					echo('$("#button-' . $this->items[$it]['category'] . "-" . $this->items[$it]['id'] . '").click(function(e){e.preventDefault();');
					echo('$("#purchase-result").html("<p class=\'alert alert-info text-center\' role=\'alert\'>Chargement...</p>");');
					$it2 = 0;
					while($this->items[$it2]['name'] != NULL)
					{
						echo('$("#button-' . $this->items[$it2]['category'] . "-" . $this->items[$it2]['id'] . '").prop("disabled", true);');
						$it2 = $it2 + 1;
					}
					echo('$.post("script/process_purchase.php",{id : "' . $this->items[$it]['id'] . '"},');
					echo('function(data){');
					echo('if (data == "SUCCESS"){ $("#purchase-result").html("<p class=\'alert alert-success text-center\' role=\'alert\'>Votre commande a bien été livrée.</p>");
						setTimeout(function () {location.reload();}, 3000);}');
					echo('else{'); 
					echo('$("#purchase-result").html("<p class=\'alert alert-danger text-center\' role=\'alert\'>"+data+"</p>");');
					$it2 = 0;
					while($this->items[$it2]['name'] != NULL)
					{
						echo('$("#button-' . $this->items[$it2]['category'] . "-" . $this->items[$it2]['id'] . '").prop("disabled", false);');
						$it2 = $it2 + 1;
					}
					echo "}},);});";
					$it = $it + 1;
				}
			}
				echo ("</script>");
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
    			die ('Erreuzr : ' . $e->getMessage());
    		}
		}
	}
?>