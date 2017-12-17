<?php

class Core extends ClassCore {

	public function __construct() {
		$this->initClass("Core",true);
	}

	public function curl_json($url,$method="POST",$var=array(),$contenttype = "application/x-www-form-urlencoded") {
		$url = 'http://server.com/path';
		$data = array();
		foreach($var as $key=>$val) {
			$data[urlencode($key)] = urlencode($val);
		}

		// use key 'http' even if you send the request to https://...
		$options = array(
    		'http' => array(
        		'header'  => "Content-type: ".$contenttype."\r\n",
        		'method'  => 'POST',
        		'content' => http_build_query($data)
    		);
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { return false; }
		return json_decode($result);
	}
}

?>