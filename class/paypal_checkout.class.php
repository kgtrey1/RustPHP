<?php
	class Paypal_checkout
	{
		private $paypal_url = "https://api.sandbox.paypal.com/v1/";
		private $paypal_public;
		private $paypal_secret;
		private $payment_id;
		private $payment_token;
		private $payer_id;
		private $id;
		private $username;
		private $state;
		private $email;
		private $price;
		private $paid;
		private $db;

		public function __construct()
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/paypal.php");

			$this->paypal_public = $paypal_public;
			$this->paypal_secret = $paypal_secret;
		}

		public function paypal_public()
		{
			return $this->paypal_public;
		}

		public function prepare($poyment_id, $payment_token, $payer_id)
		{
			$this->payment_id = htmlspecialchars($payment_id);
			$this->payment_token = htmlspecialchars($payment_token);
			$this->payer_id = htmlspecialchars($payer_id);
			$this->username = htmlspecialchars($_SESSION['username']);
		}

		public function validate()
		{
			$url = curl_init();
        	curl_setopt($url, CURLOPT_URL, $this->paypal_url . 'oauth2/token');
        	curl_setopt($url, CURLOPT_HEADER, false);
        	curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
        	curl_setopt($url, CURLOPT_POST, true);
        	curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($url, CURLOPT_USERPWD, $this->paypal_public . ":" . $this->paypal_secret);
        	curl_setopt($url, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        	$response = curl_exec($url);
        	curl_close($url);
        	if(empty($response))
        	{
            	return true;
        	}
        	else
        	{
            	$jsonData = json_decode($response);
            	$url = curl_init($this->paypal_url . 'payments/payment/' . $this->payment_id);
            	curl_setopt($url, CURLOPT_POST, false);
            	curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
            	curl_setopt($url, CURLOPT_HEADER, false);
            	curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
            	curl_setopt($url, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $jsonData->access_token, 'Accept: application/json', 'Content-Type: application/xml'));
            	$response = curl_exec($url);
            	curl_close($url);
            	$response = json_decode($response, true);
            	$this->decode_response($response, true);
            	$this->save_transaction();
            	return $this->verify();
        	}
		}

		private function grant_coin()
		{
			$new_amount = $_SESSION['coin'] + (int)$this->paid * 100;
			$_SESSION['coin'] = $new_amount;
			$this->init_db();
			$query = $this->db->prepare('UPDATE rp_users SET coin = :coin WHERE username = :username');
            $query->execute(array('username' => $this->username, 'coin' => $new_amount));
		}

		private function save_transaction()
		{
				$this->init_db();
				$query = $this->db->prepare('INSERT INTO rp_payments(username, mail, state, paid, price) VALUES(:username, :mail, :state, :paid, :price)');
            	$query->execute(array('username' => htmlspecialchars($_SESSION['username']), 'mail' => $this->email, 'state' => $this->state, 'paid' => $this->paid, 'price' => $this->price));
		}

		private function verify()
		{
			if ($this->state == "approved" && $this->paid == $this->price && (int)$this->paid == 2 || (int)$this->paid == 5 || (int)$this->paid == 10 || (int)$this->paid == 20)
			{
				$this->grant_coin();
				return true;
			}
			else
				return false;
		}

		private function decode_response($data)
		{
			$this->id = $data["payments"][0]["id"];
			$this->state = $data["payments"][0]["state"];
			$this->email = $data["payments"][0]["payer"]["payer_info"]["email"];
			$this->price = $data["payments"][0]["transactions"][0]["amount"]["total"];
			$this->paid = $data["payments"][0]["transactions"][0]["amount"]["details"]["subtotal"];
		}

		private function init_db()
		{
			require($_SERVER["DOCUMENT_ROOT"] . "/config/config.php");

            try
            {
                $this->db = new PDO($db_host, $db_user, $db_pass);
            }
            catch (Exception $e)
            {
                die ('Erreur : ' . $e->getMessage());
            }
		}
	}
?>