<?php
/*
** /config/captcha.php for RustPHP
**
** Made by kgtrey1
** Email admin@kgtrey1.eu
**
** Started on 30-Aug-2018 by kgtrey1
*/

	class Recaptcha
	{
		private $secret;
		private $token;

		function __construct($secret, $token)
		{
			$this->secret = htmlspecialchars($secret);
			$this->token = htmlspecialchars($token);
		}

		public function check_token()
		{
			if (empty($this->token))
				return false;
			$url = "https://www.google.com/recaptcha/api/siteverify?secret={$this->secret}&response={$this->token}";
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($curl);
			if (empty($response) || is_null($response))
				return false;
			$json = json_decode($response);
			return $json->success;
		}
	}
?>