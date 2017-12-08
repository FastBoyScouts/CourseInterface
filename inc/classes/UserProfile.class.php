<?php

class UserProfile extends ClassCore {
	private $userdata;
	private $username;
	private $uid;
	private $role_tile;
	private $logged_in;
	private $email;
	private $color;

	private function buildTile($id,$role_title) {
		return '<div class="user-tile"><p id="'.$id.'">'.$role_title.'</p></div>';
	}

	public function __construct($userName) {
		$this->initClass("UserProfile",true);


		$query = $this->db->query("SELECT * FROM `users` WHERE username='".mysqli_escape_string($this->db->getConnection(),$userName)."';");
		if(mysqli_num_rows($query) == 1) {
			foreach($query as $row) {
				$this->username = $row["username"];
				$this->email = $row["email"];
				echo "<!-- ROLE: ".$row["role"]." -->";
				switch($row["role"]) {

					case "adminstrator":
						$this->role_tile = $this->buildTile("Adminstrator","Adminstrator");
						$this->color = "red";
						break;

					case "webmaster":
					case "developer":
						$this->role_tile = $this->buildTile("Developer","Developer");
						$this->color = "cyan";
						break;

					default:
						$this->role_tile = $this->buildTile("User","Nutzer");
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

	public function getAvatarUrl() {
		$mail_hash = md5(strtolower(trim($this->email)));
		return "https://www.gravatar.com/avatar/".$mail_hash."?d=robohash&s=200";
	}

	public function getFormattedName() {
		return '<span style="color:'.$this->color.';">'.$this->getUsername().'</span>';
	}
}

?>