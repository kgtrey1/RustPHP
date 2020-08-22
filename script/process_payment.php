<?php
	/*
	** /admin/script/news_add.php for RustPHP
	**
	** Made by kgtrey1
	** Email admin@kgtrey1.eu
	**
	** Started on 05-Oct-2018 by kgtrey1
	*/

	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

		if (user_is_connected() && isset($_POST['payment_id']) && isset($_POST['payment_token']) && isset($_POST['payer_id']))
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/class/paypal_checkout.class.php");

			$paiement = new Paypal_checkout;
			$paiement->prepare($_POST['payment_id'], $_POST['payment_token'], $_POST['payer_id']);
			if ($paiement->validate())
			{
				echo("SUCCESS");
			}
			else
			{
				echo "cancel";
			}
		}
	}
?>