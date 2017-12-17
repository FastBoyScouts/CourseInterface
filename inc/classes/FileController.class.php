<?php

class FileController extends ClassCore {
	public function __construct() {
		$this->initClass("FileController",true);
	}

	public function getFileContent($id) {
		$result = $this->db->query("SELECT * FROM `files` WHERE id=".$this->db->escapeString($id).";");
		if(mysqli_num_rows($result) == 1) {
			foreach($result as $row) {
				return $row["file"];
			}
		} else {
			return false;
		}
	}

	public function getFile($id) {
		$result = $this->db->query("SELECT * FROM `files` WHERE id=".$this->db->escapeString($id).";");
		if(mysqli_num_rows($result) == 1) {
			foreach($result as $row) {
				return array("title"=>$row["title"],"mime"=>$row["mime"],"id"=>$row["id"],"webpath"=>$row["file_path"],"file"=>file_get_contents($row["file_path_system"]),"base64"=>"data:".$row["mime"].";base64,".$row["base64"]);
			}
		} else {
			return false;
		}
	}

	public function getCodedFileBase64($id) {
		return base64_encode($this->getFile($id)["file"]);
	}

	public function getBase64($id) {
		return 'data:'.$this->getFile($id)["mime"].';base64,'.$this->getCodedFileBase64($id);
	}

	public function getAllFiles() {
		$i = 1;
		$result = $this->db->query("SELECT * FROM `files` WHERE available=1;");
		$files = array();
		foreach($result as $row) {
			array_push($files,$this->getFile($row["id"]));

			++$i;
		}
		return $files;
	}
	private function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}

	public function upload($f, $title, $type) {
		$target_dir = $_SERVER["DOCUMENT_ROOT"]."/uploads/";
		$raw_target = $this->generateRandomString()."-".basename($f["name"]);
		while(file_exists($target_file)) {
			$raw_target = $this->generateRandomString()."-".basename($f["name"]);
		}
		$target_file = $target_dir . $raw_target;
		$uploadOk = 1;
		$mime = mime_content_type($f["tmp_name"]);

		if($f["size"] > 500000) {
			return false;
		}

		if(!move_uploaded_file($f["tmp_name"], $target_file)) {
			return false;
		}

		if(!$this->db->query("INSERT INTO `files` (title,mime,file_path_system,type,base64,file_path) VALUES ('".$title."','".$mime."','".$target_file."','".$type."','".base64_encode(file_get_contents($target_file))."','/uploads/".$raw_target."');")) {
			return false;
		}

		return true;

	}

}