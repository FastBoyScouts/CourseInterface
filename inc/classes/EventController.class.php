<?php

class EventController extends ClassCore {


	public function __construct() {
		$this->initClass("EventController",true);
	}


	public function getAllEventsJson() {
		$json = '"events":[';
		$result = $this->db->query("SELECT * FROM `courses`;");
		$result2 = $this->db->query("SELECT * FROM `users`;");
		$users = array();
		foreach($result2 as $row) {
			$users[$row["id"]] = new UserProfile($row["id"],"id");
		}
		$rows = mysqli_num_rows($result);
		$queriedRows = 1;
		foreach($result as $row) {
			$temp = $users[$row["creator"]];
			$json .= '{';
			$json .= '"title":"'.$row["title"].'",';
			$json .= '"id":'.$row["id"].',';
			$json .= '"creator":{"id":'.$temp->getId().',"username":"'.$temp->getUsername().'","role":"'."unknown".'"}';
			$json .= '}';

			if($queriedRows != $rows) {
				$json .= ',';
			}

			++$queriedRows;
		}
		$json .= ']';
		return $json;
	}

	public function getAllEvents() {
		$events = array();
		$result = $this->db->query("SELECT * FROM `courses`;");
		foreach($result as $row) {
			$creator = new UserProfile($row["creator"],"id");
			array_push($events,array("id"=>$row["id"],"title"=>$row["title"],"creator_name"=>$creator->getUsername()));
		}
		return $events;
	}
}

?>