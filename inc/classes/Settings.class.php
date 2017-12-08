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
			$this->data[$value["property"]] = $value["value"];
		}
	}

	public function get($key) {
		$this->addToLoadedSettings($key);
		return $this->data[$key];
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