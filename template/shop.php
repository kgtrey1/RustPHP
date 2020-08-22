<?php
	require_once($_SERVER["DOCUMENT_ROOT"] . "/class/shop_loader.class.php");
?>

<html>
	<div class="container d-flex" style="min-height: 81vh; background-color: white; align-items: center;">
    	<div class="row" style="margin: auto; width: 100%;">
    		<div class="col-lg-12">
    			<div id='purchase-result'>
    				<?php if(!user_is_connected()) echo('<p class=\'alert alert-danger text-center\' role=\'alert\'>Vous devez être connecté pour faire des achats.</p>'); ?>
    			</div>
    		</div>
    		<?php $shop = new Shop_loader; ?>
		</div>
	</div>
</html>