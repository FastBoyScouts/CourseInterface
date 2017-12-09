<?php

class SMS extends ClassCore {

	private $client;
	private $balance;

	public function __construct($api_key="b8d5653c",$api_secret = "295278a09bce5090") {
		$this->initClass("SMS",false);
		$this->client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($api_key, $api_secret));
		//$this->send("+491724321458","Hallo Papi ");
	}

	public function send($phone,$message) {
		$message = $this->client->message()->send([
    		'to' => $phone,
    		'from' => "FBS",
    		'text' => $message
		]);
		$this->balance = $message["remaining-balance"];
		echo $this->balance;
	}

	public function getBalance() {

	}
}

?>