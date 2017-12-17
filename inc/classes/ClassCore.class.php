<?php

class ClassCore {

	public $db;
	public $settings;
	public function __construct() {
		
	}

	public function initClass($class_title,$db=true,$addToLogger=true,$useThirdParty=true) {
		$this->connectSettings();

		if($db) {
			$this->connectDB();
		}

		if($addToLogger) {
			$this->addClassToLogger($class_title);
		}
	}

	public function connectDB() {
		global $db;
		//include($_SERVER["DOCUMENT_ROOT"]."/config.private.inc.php");
		//require_once($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Database.class.php");
		//$this->db = new Database($config["database"]["server"], $config["database"]["username"], $config["database"]["password"], $config["database"]["database"]);
		$this->db = $db;
	}

	public function connectSettings() {
		global $settings;

		$this->settings = $settings;
	}

	public function addClassToLogger($class) {
		global $classes;
		array_push($classes, $class);
	}

}

?>