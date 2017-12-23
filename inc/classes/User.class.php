<?php

class User extends ClassCore {

	//require_once($_SERVER["DOCUMENT_ROOT"]."/config.private.inc.php");
	// require_once($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Database.class.php");

	private $security_token;
	private $username;
	private $password;
	private $firstname;
	private $lastname;
	private $role;
	private $logged_in;
	private $phone;
	private $mobile;
	private $address;
	private $city;
	private $plz;
	private $uid;
	private $trdparty;

	

	public function __construct() {
		global $thirdparty;
		$this->trdparty = $thirdparty;

		$this->initClass("User",true);


		$this->logged_in = false;
	}

	public function applyTokens($uid, $security_token,$respond=true) {
		$result = $this->db->query("SELECT * FROM security_tokens WHERE uid=".mysqli_escape_string($this->db->getConnection(),$uid)." AND security_token='".mysqli_escape_string($this->db->getConnection(),$security_token)."';");
		if(mysqli_num_rows($result) == 1) {
			foreach($result as $row) {
				if($row["valid"] == 0) {
					echo '<script>alert("Ihre Sitzung ist abgelaufen. Bitte melden sie sich erneut an.");window.location.href="/account/login";</script>';
					session_destroy();
					return false;
				}
			}
			$this->logged_in = true;
			$result2 = $this->db->query("SELECT * FROM users WHERE id=".mysqli_escape_string($this->db->getConnection(),$uid).";");
			foreach($result2 as $row2) {
				$this->firstname = $row2["firstname"];
				$this->lastname = $row2["lastname"];
				$this->role = $row2["role"];
				$this->username = $row2["username"];
				$this->phone = $row2["phone"];
				$this->mobile = $row2["mobile"];
				$this->address = $row2["address"];
				$this->city = $row2["city"];
				$this->plz = $row2["plz"];
				$this->uid = $row2["id"];
			}
			return true;
		} else {
			$this->logged_in = false;
			return false;
		}
	}

	public function isLoggedIn() {
		return $this->logged_in;
	}

	public function login($username, $password) {
		$username_temp = mysqli_escape_string($this->db->getConnection(), $username);
		$password_temp = mysqli_escape_string($this->db->getConnection(), $password);
		$result = $this->db->query("SELECT * FROM users WHERE username = '".$username_temp."' LIMIT 1;");
		if(mysqli_num_rows($result) == 1) {
			foreach($result as $row) {
				$password_queried = $row["password"];
				$blocked = $row["blocked"];
			}
			if(password_verify($password_temp, $password_queried)) {
				if($blocked != 1) {
					$result2 = $result;
					foreach($result2 as $row2) {
						$security_token = bin2hex(random_bytes(16));
						$this->db->query("UPDATE `security_tokens` SET valid=0 WHERE uid=".$row2["id"].";");
						$this->db->query("INSERT INTO security_tokens (uid, security_token, created,valid) VALUES (".$row2["id"].",'".$security_token."',NOW(),1);");
						$_SESSION["security_token"] = $security_token;
						$_SESSION["user_id"] = $row2["id"];
						$this->applyTokens($row2["id"],$security_token);
						return "loggedin";
					}
				} else {
					return "blocked";
				}
				
			} else {
				return "password";
			}
		} else {
			return "username";
		}
	}

	public function register($username, $password, $password_verify, $email, $email_verify, $anrede, $firstname, $lastname, $phone, $mobile, $address, $city) {
		if($password != $password_verify) {
			return "password-wrong";
		}
		if($email != $email_verify) {
			return "email-wrong";
		}
		$username_temp = mysqli_escape_string($this->db->getConnection(),$username);
		$password_temp = password_hash($password,PASSWORD_DEFAULT);
		$email_temp = mysqli_escape_string($this->db->getConnection(),$email);
		$firstname_temp = mysqli_escape_string($this->db->getConnection(),$firstname);
		$lastname_temp = mysqli_escape_string($this->db->getConnection(),$lastname);
		$anrede_temp = mysqli_escape_string($this->db->getConnection(),$anrede);
		$mobile_temp = $this->db->escapeString($mobile);
		$phone_temp = $this->db->escapeString($phone);

		if($this->settings->get("use_numverify")) {
			if(!$this->trdparty->validateNumber($mobile_temp)) {
				return "mobile-invalid";
			}

			if(!$this->trdparty->validateNumber($phone_temp)) {
				return "phone-invalid";
			}
		}
		

		$q1 = $this->db->query("SELECT * FROM users WHERE username='".$username_temp."';");
		if(mysqli_num_rows($q1) == 0) {
			$sql = "INSERT INTO users (username,password,email,anrede,firstname,lastname,role,registered,last_activity) VALUES ('".$username_temp."','".$password_temp."','".$email_temp."','".$anrede_temp."','".$firstname_temp."','".$lastname_temp."','user',NOW(),NOW());";
			$q2 = $this->db->query($sql);
			return "ok";
		} else {
			return "username-existing";
		}
	}

	public function getUserData() {
		if($this->isLoggedIn()) {
			$userdata = array();
			$userdata["username"] = $this->username;
			$userdata["firstname"] = $this->firstname;
			$userdata["lastname"] = $this->lastname;
			$userdata["role"] = $this->role;
			$userdata["phone"] = $this->phone;
			$userdata["mobile"] = $this->mobile;
			$userdata["address"] = $this->address;
			$userdata["city"] = $this->city;
			$userdata["plz"] = $this->plz;
			$userdata["id"] = $this->uid;
			return $userdata;
		} else {
			return false;
		}
	}

	public function getUsername() {
		return $this->getUserData()["username"];
	}

	public function getId() {
		return $this->getUserData()["id"];
	}

	public function hasPermission($permission) {
		if($userdata = $this->getUserData()) {
			$result = $this->db->query("SELECT * FROM permissions WHERE role='".$userdata["role"]."' AND active=1 AND permission='".$permission."';");
			if(mysqli_num_rows($result) >= 1) {
				return true;
			} else {
				$result = $this->db->query("SELECT * FROM permissions WHERE role='".$userdata["role"]."' AND active=1 AND permission='*';");
				if(mysqli_num_rows($result) >= 1) {
					return true;
				} else {
					$result = $this->db->query("SELECT * FROM permissions WHERE role='guest' AND active=1 AND permission='".$permission."';");
					if(mysqli_num_rows($result) >= 1) {
						return true;
					} else {
						return false;
					}
				}
			}
		} else {
			$result = $this->db->query("SELECT * FROM permissions WHERE role='guest' AND active=1 AND permission='".$permission."';");
			if(mysqli_num_rows($result) >= 1) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function getRoleTile() {
		
	}


}