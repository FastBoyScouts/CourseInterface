<?php

class Mailer {

	public function __construct($server) {
		include($_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php");
		$this->phpmailer = new PHPMailer();

		$this->phpmailer->IsSMTP();
		$this->Host = $server;
		$this->Username = $username;
	}
}