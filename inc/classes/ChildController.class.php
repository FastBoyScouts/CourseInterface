<?php

class ChildController extends ClassCore {

	public function __construct() {
		$this->initClass("ChildController",true);
	}

	public function register($parent, $firstname, $lastname, $sex) {
		$this->db->query("INSERT INTO `childrens` (parent,firstname,lastname,sex) VALUES (".$parent->getId().",'".$firstname."','".$lastname."','".$sex."');");
	}
}

?>