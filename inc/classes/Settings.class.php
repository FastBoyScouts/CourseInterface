<?php

class Settings extends ClassCore {


	private $query;
	private $data = array();
	private $loadedSettings = array();

	public function __construct() {
		$this->initClass("Settings",true);
		$this->load();
	}

	public function load() {
		$this->query = $this->db->query("SELECT * FROM `settings` WHERE active=1;");
		foreach($this->query as $value) {
			$this->data[$value["property"]] = array("value"=>$value["value"],"type"=>$value["type"]);
		}
	}

	public function get($key) {
		$this->addToLoadedSettings($key);
		$dat = $this->data[$key];
		if($dat["type"] == "string") {
			return $dat["value"];
		}

		if($dat["type"] == "int") {
			return $dat["value"];
		}

		if($dat["type"] == "boolean") {
			if($dat["value"] == "1") {
				return true;
			} else {
				return false;
			}
		}

		return false;
	}

	public function getLoadedSettings() {
		return $this->loadedSettings;
	}

	public function addToLoadedSettings($stg) {
		array_push($this->loadedSettings,$stg);
	}

	public function countLoadedSettings() {
		return count($this->getLoadedSettings());
	}
}

?>