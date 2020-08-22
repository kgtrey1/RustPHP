<?php
  require_once($_SERVER["DOCUMENT_ROOT"] . "/class/vote_plugin.class.php");

  $rustservers = new Vote_plugin("rustservers");
?>

<html>
  <section id="vote-plugin" style="padding-top: 2%;">
  	<div class="row">
        <div class="col-lg-6 col-xs-12 mx-auto">
        	<div class="card text-center">
        		<img class="card-img-top" src="img/vote/test.jpg" alt="Card image cap">
        		<div class="card-body">
        			<div id="rustservers-result"></div>
        			<a href="<?php echo $rustservers->link(); ?>" target="_blank"> <h5 class="card-title vote-link">Cliquez ici pour voter</h5> </a>
        			<p class="card-text"><?php echo $rustservers->desc(); ?></p>
        			<?php
                		if (isset($_SESSION['id']) AND isset($_SESSION['username']) AND isset($_SESSION['steamid']) AND isset($_SESSION['is_admin']) AND isset($_SESSION['ip']))
                			echo('<input class="btn btn-secondary" id="rustservers-query" type="button" value="Vérifier mon vote">');
                		else
                			echo('<input class="btn btn-secondary" type="button" value="Connectez vous pour voter" disabled>');
                	?>
        		</div>
        		<div class="card-footer text-muted">
        			Récompense : <?php echo $rustservers->reward(); ?>
        		</div>
        	</div>
        </div>
    </div>
  </section>
</html>