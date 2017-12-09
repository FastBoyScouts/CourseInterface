<?php

class UserProfile extends ClassCore {
	private $userdata;
	private $username;
	private $uid;
	private $role_tile;
	private $logged_in;
	private $email;
	private $color;
	private $blocked;
	private $role;

	private function buildTile($id,$role_title) {
		return '<div class="user-tile"><p id="'.$id.'">'.$role_title.'</p></div>';
	}

	public function __construct($userName,$selector="username") {
		$this->initClass("UserProfile",true);

		if($selector=="id") { 
			$where = 'id='.mysqli_escape_string($this->db->getConnection(),$userName);
		} else if($selector=="username") { 
			$where = 'username="'.mysqli_escape_string($this->db->getConnection(),$userName).'"';
		}

		$query = $this->db->query("SELECT * FROM `users` WHERE ".$where.";");
		if($query && mysqli_num_rows($query) == 1) {
			foreach($query as $row) {
				$this->username = $row["username"];
				$this->email = $row["email"];
				$this->uid = $row["id"];
				$this->role = $row["role"];
				if($row["blocked"] == 1) {
					$this->blocked = true;
				} else {
					$this->blocked = false;
				}
				//echo "<!-- ROLE: ".$row["role"]." -->";
				switch($row["role"]) {

					case "adminstrator":
						$this->role_tile = $this->buildTile("Adminstrator","Adminstrator");
						$this->color = "red";
						break;

					case "webmaster":
					case "developer":
						$this->role_tile = $this->buildTile("Developer","Entwickler");
						$this->color = "cyan";
						break;

					case "content":
						$this->role_tile = $this->buildTile("Content","Inhaltsbeauftragter");
						$this->color = "#bc4755";
						break;

					default:
						$this->role_tile = $this->buildTile("User","Benutzer");
						$this->color = "gray";
						break;

				}
			}
			$this->logged_in = true;
			return true;
		} else {
			$this->logged_in = false;
			return false;
		}
	}

	public function getValid() {
		return $this->logged_in;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getRoleTile() {
		return $this->role_tile;
	}

	public function getAvatarUrl($size="200") {
		$mail_hash = md5(strtolower(trim($this->email)));
		return "https://www.gravatar.com/avatar/".$mail_hash."?d=robohash&s=".htmlspecialchars($size);
	}

	public function getFormattedName() {
		return '<span style="color:'.$this->color.';">'.$this->getUsername().'</span>';
	}

	public function block() {
		$this->db->query("UPDATE `users` SET blocked=1 WHERE id=".$this->uid.";");
		return true;
	}

	public function getBlocked() {
		return $this->blocked;
	}

	public function setBlocked($bl) {
		if($bl == true) {
			$this->db->query("UPDATE `security_tokens` SET valid=0 WHERE uid=".$this->uid.";");
			$this->db->query("UPDATE `users` SET blocked=1 WHERE id=".$this->uid.";");
		} else if($bl == false) {
			$this->db->query("UPDATE `users` SET blocked=0 WHERE id=".$this->uid.";");
		}
	}

	public function getId() {
		return $this->uid;
	}

	public function setRole($role) {
		$this->db->query("UPDATE `users` SET role='".mysqli_escape_string($this->db->getConnection(),$role)."' WHERE id=".$this->uid.";");
	}

	public function getRole() {
		return $this->role;
	}
}

?>