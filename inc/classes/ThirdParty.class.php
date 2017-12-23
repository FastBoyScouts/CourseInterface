<?php

class ThirdParty extends ClassCore {

	const NUMVERIFY_API_KEY = NUMVERIFY_API_TOKEN;

	public function __construct() {
		$this->initClass("3rdParty",false);
	}

	public function getMobileData($number,$api_key=$this->settings->get("numverify_key")) {
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
		$valResult = $this->getMobileData($number);
		if(array_key_exists("success",$valResult)) {
			if($valResult["success"] == false) {
				return false;
			} else {
				return true;
			}
		}
		if($valResult["valid"]) {
			return true;
		} else {
			return false;
		}
	}
}

?>