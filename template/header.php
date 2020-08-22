<?php
/*
** /template/header.php for RustPHP
**
** Made by kgtrey1
** Email admin@kgtrey1.eu
**
** Started on 29-Aug-2018 by kgtrey1
*/

	require($_SERVER["DOCUMENT_ROOT"] . "/script/page.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/config/recaptcha.php");
	require($_SERVER["DOCUMENT_ROOT"] . "/script/time.php");
?>

<header>
	<div class="top-nav">
		<div class="container" style="display: flex; align-items: center; justify-content: space-between;">
			<div style="width: 150px; height: 25px; border-radius: .25rem; background-color: #efefef; display: flex; align-items: center;"> 
				<?php 
					$player_count = get_player_count();
					if ($player_count != "offline")
						echo ('<p style="margin: auto; color: green;">En ligne : ' . $player_count. '</p>');
					else
						echo ('<p style="margin: auto; color: red;">Hors-ligne</p>');
				?>
			</div>
			<ul class ="top-nav-ul">
				<?php if(!isset($_SESSION['username'])){ ?>
				<li class="top-nav-li"><a class="top-nav-a" href="" data-toggle="modal" data-target="#login-modal">CONNEXION</a></li>
				<li class="top-nav-li"><a class="top-nav-a" href="" data-toggle="modal" data-target="#register-modal">S'INSCRIRE</a></li>
				<?php }else{ ?>
				<li class="top-nav-li"><a class="top-nav-a" href="#">Bonjour, <?php echo($_SESSION['username']); ?></a></li>
				<li class="top-nav-li"><a class="top-nav-a" href="#">Coin : <?php echo($_SESSION['coin']); ?></a></li>
				<?php if($_SESSION['is_admin'] == 1){ ?>
				<li class="top-nav-li"><a class="top-nav-a" href="#" data-toggle="modal" data-target="#sign-up">Dashboard</a></li>
				<?php } ?>
				<li class="top-nav-li"><a class="top-nav-a" href="logout.php">Se deconnecter</a></li>
				<?php }?>
			</ul>
		</div>
	</div>
	<div class="container-fluid nav-b">
		<div class="container">
			<div class="row">
				<img src="./../img/header/logo.png" style = "width: 200px; height: 100px;">
				<ul class ="nav-ul">
    				<?php print_page(get_page_data(), get_page_number()); ?>
    				<a class="nav-d" style="color: white;" href="" id="supportmenu" data-toggle="dropdown">SUPPORT<span class=" fa fa-chevron-circle-down" aria-hidden="true"></span></a>
    				<div class="dropdown-menu" aria-labelledby="supportmenu">
   						<a class="dropdown-item" href="support.php">Support</a>
    					<a class="dropdown-item" href="rules.php">Règles</a>
   						<a class="dropdown-item" href="faq.php">FAQ</a>
					</div>
    			</ul>
			</div>
    	</div>
	</div>

	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="border-top: 3px solid #A94545; text-align: initial;">
				<div class="modal-header">
					<h5 class="modal-title">Se connecter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<center>
						<div id="login-result"></div>
							<div class="input-group" style="width: 80%; margin-top: 10px;">
								<div class="input-group-prepend">
									<div class="input-group-text"><span class="fa fa-user-alt" aria-hidden="true"></span></div>
								</div>
								<input type="text" class="form-control" id="login-username" placeholder="Nom d'utilisateur"/>
							</div>
							<div class="input-group" style="width: 80%; margin-top: 15px; margin-bottom: 10px;">
								<div class="input-group-prepend">
									<div class="input-group-text"><span class="fa fa-key" aria-hidden="true"></span></div>
								</div>
								<input type="password" class="form-control" id="login-password" placeholder="Mot de passe">
							</div>
					</center>
				</div>
				<div class="modal-footer">
					<input type="submit" id="login-button"  class="btn btn-secondary" value="Se connecter" style="margin: auto; width: 70%;">
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="border-top: 3px solid #A94545; text-align: initial;">
				<div class="modal-header">
					<h5 class="modal-title">S'enregistrer</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="register-result"></div>
					<center>
						<div class="input-group" style="width: 80%;">
							<div class="input-group-prepend">
								<div class="input-group-text"><span class="fa fa-user-alt" aria-hidden="true"></span></div>
							</div>
							<input type="text" class="form-control" id="register-username" placeholder="Nom d'utilisateur"/>
						</div>
						<div class="input-group" style="width: 80%; margin-top: 15px;">
							<div class="input-group-prepend">
								<div class="input-group-text"><span class="fa fa-key" aria-hidden="true"></span></div>
							</div>
							<input type="password" class="form-control" id="register-password" placeholder="Mot de passe"/>
						</div>
						<div class="input-group" style="width: 80%; margin-top: 15px;">
							<div class="input-group-prepend">
								<div class="input-group-text"><span class="fa fa-key" aria-hidden="true"></span></div>
							</div>
							<input type="password" class="form-control" id="register-repassword" placeholder="Confirmation">
						</div>
						<div class="input-group" style="width: 80%; margin-top: 15px;">
							<div class="input-group-prepend">
								<div class="input-group-text"><span class="fa fa-at" aria-hidden="true"></span></div>
							</div>
							<input type="text" class="form-control" id="register-email" placeholder="Email">
						</div>
						<div class="input-group" style="width: 80%; margin-top: 15px; margin-bottom: 15px;">
							<div class="input-group-prepend">
								<div class="input-group-text"><span class="fab fa-steam" aria-hidden="true"></span></div>
							</div>
							<input type="text" class="form-control" id="register-steamid" placeholder="SteamID64">
							<a href="https://steamidfinder.com/" target="_blank" style="margin-left: 3px; padding-top: 5px; color: black;">(Need help?)</a>
						</div>
						<div class="g-recaptcha" data-sitekey="<?php echo($RECAPTCHA_SITE_KEY); ?>"></div>
					</center>
				</div>
				<div class="modal-footer">
					<input type="submit" id="register-button" class="btn btn-secondary" value="S'inscrire" style="margin: auto; width: 70%;">
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function()
		{
    		$("#login-button").click(function(e)
    		{
        		e.preventDefault();
        		$("#login-result").html("<p class='alert alert-info' role='alert'>Chargement...</p>");
        		$("#login-button").prop('disabled', true);
        		$("#login-button").prop('value', 'Chargement..');
 				$.post('script/connection.php',
            	{
                	username : $("#login-username").val(),
                	password : $("#login-password").val()
            	},
            	function(data)
            	{
                	if(data == 'SUCCESS')
                	{
                    	$("#login-result").html("<center><p class='alert alert-success' role='alert'>Connexion en cours...</p></center>");
                    	$("#login-button").prop('class', "btn btn-success");
                    	setTimeout(function () {location.reload();}, 1000);
                	}
                	else
                	{
                    	$("#login-result").html("<p class='alert alert-danger' role='alert'>"+data+"</p>");
                    	$("#login-button").prop('disabled', false);
        				$("#login-button").prop('value', "Se connecter");
                	}
            	},
            	);
    		});	
			$("#register-button").click(function(e)
			{
        		e.preventDefault();
        		$("#register-result").html("<p class='alert alert-info' role='alert'>Chargement...</p>");
        		$("#register-button").prop('disabled', true);
        		$("#register-button").prop('value', 'Chargement..');
 				$.post('script/register.php',
            	{
                	username : $("#register-username").val(),
                	password : $("#register-password").val(),
					repassword : $("#register-repassword").val(),
                	email : $("#register-email").val(),
                	steamid : $("#register-steamid").val(),
                	captcha: grecaptcha.getResponse()
            	},
            	function(data)
            	{
                	if(data == 'SUCCESS')
                	{
                    	$("#register-result").html("<center><p class='alert alert-success' role='alert'>Votre inscription a bien été prise en compte.</p></center>");
                    	$("#register-button").prop('class', "btn btn-success");
                    	setTimeout(function () {location.reload();}, 1000);
                	}
                	else
                	{
                		$("#register-result").html("<p class='alert alert-danger' role='alert'>Erreur: "+data+"</p>");
    					$("#register-button").prop('disabled', false);
        				$("#register-button").prop('value', "S'inscrire");
                    	grecaptcha.reset();
                	}
            	},
         		);
    		});
		});
	</script>
</header>