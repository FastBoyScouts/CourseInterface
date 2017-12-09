<?php

class Communication extends ClassCore {

	private $sms;

	public function __construct() {
		$this->initClass("Communication",true);

		$this->sms = new SMS();
	}
}

?>