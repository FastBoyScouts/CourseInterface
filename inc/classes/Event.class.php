<?php

class Event extends ClassCore {

	private $event_title;
	private $event_id;
	private $query;
	private $data;

	public function setEventId($Id) {
		$this->event_id = $Id;
	}

	public function setEventTitle($Title) {
		$this->event_title = $Title;
	}

	public function getEventId() {
		return $this->event_id;
	}

	public function getEventTitle() {
		return $this->event_title;
	}

	public function __construct($id) {
		$this->initClass("Event",true);
		$this->setEventId($id);
		$this->load();

	}

	private function load() {
		$this->query = $this->db->query("SELECT * FROM `courses` WHERE id=".$this->db->escapeString($this->getEventId()).";");
		if($this->exists()) {
			foreach($this->query as $row) {
				$this->data["title"] = $row["title"];
				$this->data["id"] = $row["id"];
				$this->data["about"] = $row["about"];
				$this->data["creator_id"] = $row["creator"];
				$query2 = $this->db->query("SELECT * FROM `users` WHERE id=".$this->data["creator_id"].";");
				if(mysqli_num_rows($query2) == 1) {
					foreach($query2 as $row) {
						$userProfile =  new UserProfile($row["username"]);
						$this->data["creator_name"] = "&nbsp;<a href='/user/".$userProfile->getUsername()."/profile' target='_blank'>".$userProfile->getFormattedName()."</a>";
					}
				} else {
					$this->data["creator_name"] = "&nbsp;<span style='color:red;'>Unknown</span>";
				}
			}
		}
	}

	public function exists() {
		if(mysqli_num_rows($this->query) == 1) {
			return true;
		}
		return false;
	}

	public function getData() {
		return $this->data;
	}
}

?>