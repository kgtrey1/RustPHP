<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/class/social_manager.class.php");
    $data = new Social_manager();
    $discord = $data->get_social('1');
    $steam = $data->get_social('2');
    $rust = $data->get_social('3');
?>

<html>
    <div class="container-fluid" id="social">
        <div class="container">
  			<div class="row">
    			<div class="col-md-4">
  					<a href="<?php echo($discord['link']); ?>" class="social-text" target="_blank">
                        <div class="social-card social-card-1">
        				    <h3 class = "social-h3">DISCORD</h3>
                            <p><?php echo($discord['content']); ?></p>
                        </div>
      				</a>
    			</div>
    			<div class="col-md-4">
                    <a href="<?php echo($steam['link']); ?>" class="social-text" target="_blank">
      					<div class="social-card social-card-2">
        					<h3 class = "social-h3">GROUPE STEAM</h3>
        					<p><?php echo($steam['content']); ?></p>
      					</div>
      				</a>
    			</div>
    			<div class="col-md-4">
    				<a href="<?php echo($rust['link']); ?>" class="social-text" target="_blank">
      					<div class="social-card social-card-3">
        					<h3 class = "social-h3">SERVEUR</h3>
        					<p><?php echo($rust['content']); ?></p>
      					</div>
      				</a>
    			</div>
    		</div>
    	</div>
    </div>
</html>
