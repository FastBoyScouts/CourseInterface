<?php

class ThirdParty extends ClassCore {

	public function __construct() {
		$this->initClass("3rdParty",false);
	}

	public function getMobileData($number,$api_key="6d32aa725a9a8f9dafc5dfc5a66c891e") {
		$ch = curl_init('http://apilayer.net/api/validate?access_key='.$api_key.'&number='.$number.'');  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($ch);
		curl_close($ch);

		// Decode JSON response:
		$validationResult = json_decode($json, true);

		// Access and use your preferred validation result objects
		return $validationResult;
	}

	public function validateNumber($number) {
		return $this->getMobileData($number)["valid"];
	}
}

?>