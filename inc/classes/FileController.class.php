<?php

class FileController extends ClassCore {
	public function __construct() {
		$this->initClass("FileController",true);
	}

	public function getFileContent($id) {
		$result = $this->db->query("SELECT * FROM `images` WHERE id=".$this->db->escapeString($id).";");
		if(mysqli_num_rows($result) == 1) {
			foreach($result as $row) {
				return $row["file"];
			}
		} else {
			return false;
		}
	}

	public function getFile($id) {
		$result = $this->db->query("SELECT * FROM `images` WHERE id=".$this->db->escapeString($id).";");
		if(mysqli_num_rows($result) == 1) {
			foreach($result as $row) {
				return array("title"=>$row["title"],"mime"=>$row["mime"],"file"=>$row["file"],"id"=>$row["id"]);
			}
		} else {
			return false;
		}
	}

	public function getFileBase64($id) {
		return base64_encode($this->getFileContent($id));
	}

	public function getImageBase64($id) {
		return 'data:'.$this->getFile($id)["mime"].';base64,'.$this->getFileBase64($id);
	}


}