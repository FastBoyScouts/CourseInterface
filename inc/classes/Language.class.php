<?php

class Language extends ClassCore {

	private $lang;
	private $data = array();
	private $queriedVars = array();

	public function __construct($lang) {
		$this->initClass("Language",true);

		$this->lang = $lang;
	}

	private function load() {
		$this->query = $this->db->query("SELECT * FROM `language` WHERE active=1 AND language='".$this->lang."';");
		foreach($this->query as $value) {
			$this->data[$value["key"]] = $value["value"];
		}
	}

	private function addToQueriedVars($key) {
		array_push($this->queriedVars,$key);
	}

	private function getQueriedVars($key) {
		return $this->queriedVars();
	}

	public function countQueriedVars() {
		return count($this->getQueriedVars());
	}

	public function get($key) {
		return $data[$key];
	}
}

?>