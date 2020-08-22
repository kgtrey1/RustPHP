<?php
	try
	{
		$db = new PDO($db_host, $db_user, $db_pass);
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
  }
	$query = $db->prepare('SELECT * FROM rp_sliders ORDER BY id ASC');
	$query->execute();
	$result = $query->fetch();
?>

<!DOCTYPE html>

<html>
	<head>

	</head>

	<body>
		<div class="container-fluid" id="slider">
			<div class="container">
				<div id="main-slider" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#main-slider" data-slide-to="0" class="active"></li>
						<li data-target="#main-slider" data-slide-to="1"></li>
						<li data-target="#main-slider" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" style="border: 2px solid #A94545; ">
						<div class="carousel-item active">
							<img class="d-block w-100" src="./../img/slider/slider_1.jpg" alt="First slide">
							<div class="carousel-caption d-none d-md-block">
    							<h5> <?php echo($result['title']); ?> </h5>
    							<p> <?php echo($result['content']); ?> </p>
  							</div>
						</div>
						<?php $result = $query->fetch(); ?>
						<div class="carousel-item">
							<img class="d-block w-100"  src="./../img/slider/slider_2.jpg" alt="Second slide">
							<div class="carousel-caption d-none d-md-block">
    							<h5> <?php echo($result['title']); ?> </h5>
    							<p> <?php echo($result['content']); ?> </p>
  							</div>
						</div>
						<?php $result = $query->fetch(); ?>
						<div class="carousel-item">
							<img class="d-block w-100" src="./../img/slider/slider_3.jpg" alt="Third slide">
							<div class="carousel-caption d-none d-md-block">
    							<h5> <?php echo($result['title']); ?> </h5>
    							<p> <?php echo($result['content']); ?> </p>
  							</div>
						</div>
						<?php $query->closeCursor(); ?>
					</div>
					<a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#main-slider" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</body>
</html>
