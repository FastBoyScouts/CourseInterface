<?php

class Child extends ClassCore {

	private $chid;

	public function __construct($chid) {
		$this->initClass("Child",true);
		$this->chid = $chid;
	}
}

?>