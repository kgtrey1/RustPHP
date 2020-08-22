<html>
	<div class="container d-flex bg-white" style="min-height: 81vh;">
		<div class="row my-auto mx-auto w-100">
			<div class="col-lg-12">
				<div id="result">
					<?php if(!user_is_connected()) echo("<p class='alert alert-danger text-center' role='alert'>Veuillez vous connecter pour faire des achats.</p>") ?>	
				</div>
			</div>
			<div class="col-lg-3 justify-content-center">
				<div class="card text-center">
					<div class="card-header">
						<h4>Pannier</h4>
					</div>
  					<div class="card-body">
    					<p class="card-text" id="shopping-cart-item">Votre panier est vide.</p>
  					</div>
  					<div class="card-footer text-muted pb-0">
  						<p id="item-price">Total : 0€</p>
    					<div id="paypal-offer-1"></div>
    					<div id="paypal-offer-2"></div>
    					<div id="paypal-offer-3"></div>
    					<div id="paypal-offer-4"></div>
    					<a><p id="cancel-payment">Annuler l'achat</p></a>
  					</div>
				</div>
				<div class="text-center"><a href="shop.php">Retourner à la boutique</a></div>
			</div>
			<div class="col-lg-9 d-flex justify-content-center">
				<div class="row">
					<div class = "col-lg-6">
						<div class="card text-white bg-dark mb-3 text-center">
							<div class="card-header">200 coins</div>
							<div class="card-body text-dark" style="">
								<img src="img/offers/offer-1.png">
								<br>
								<p class="card-text text-white">Petit budget?</p>
								<?php 	
									if(user_is_connected())
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter">');
									else
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter" DISABLED>');
								?>
							</div>
						</div>
					</div>
					<div class = "col-lg-6" style="">
						<div class="card text-white bg-dark mb-3 text-center">
							<div class="card-header">500 coins</div>
							<div class="card-body text-dark" style="">
								<img src="img/offers/offer-2.png">
								<br>
								<p class="card-text text-white">Le juste milieu.</p>
								<?php 	
									if(user_is_connected())
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter">');
									else
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter" DISABLED>');
								?>
							</div>
						</div>
					</div>
					<div class = "col-lg-6">
						<div class="card text-white bg-dark mb-3 text-center">
							<div class="card-header">1000 coins</div>
							<div class="card-body text-dark" style="">
								<img src="img/offers/offer-3.png">
								<br>
								<p class="card-text text-white">Plein de billets.</p>
								<?php 	
									if(user_is_connected())
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter">');
									else
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter" DISABLED>');
								?>
							</div>
						</div>
					</div>
					<div class ="col-lg-6">
						<div class="card text-white bg-dark text-center">
							<div class="card-header">2000 coins</div>
							<div class="card-body text-dark" style="">
								<img src="img/offers/offer-4.png">
								<br>
								<p class="card-text text-white">Un gros tas d'or!</p>
								<?php 	
									if(user_is_connected())
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter">');
									else
										echo('<input type="button" id ="button-offer-1" class="btn btn-success" value="Acheter" DISABLED>');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</html>