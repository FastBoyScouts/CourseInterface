<?php
/*

	THIS IS THE IMPLEMENTER SCRIPT FOR THE COURSE-INTERFACE.
	IT IMPLEMENTS ALL METHODS AND CLASSES FOR THE SITE TO WORK.

	CURRENT IMPLEMENTER VERSION: 1.0.1

*/

session_start();

$classes = array();

include($_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/variables.inc.php");
include($_SERVER["DOCUMENT_ROOT"]."/config.private.inc.php");

include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Database.class.php");
$db = new Database( $config["database"]["server"], $config["database"]["username"], $config["database"]["password"], $config["database"]["database"] );


include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/ClassCore.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Logger.class.php");
$logger = new Logger();

include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Settings.class.php");
$settings = new Settings();

include($_SERVER["DOCUMENT_ROOT"]."/inc/functions.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/User.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/UserProfile.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Event.class.php");

$user = new User();

// Initialize database


if(isset($_REQUEST["goto"])) {
	$goto = htmlspecialchars($_REQUEST["goto"]);
} else {
	$goto = "/index.php";
}

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["login"])) {
	if(!$user->login($_POST["username"], $_POST["password"])) {
		$loginMessage = "Der Nutzer konnte nicht angemeldet werden.";
	} else {
		$loginMessage = "Sie wurden angemeldet!";
		die(header("Location: ".$goto));

	}
} else {
	$loginMessage = "Bitte geben sie ihre Daten ein!";
}


if(isset($_SESSION["user_id"]) && isset($_SESSION["security_token"])) {
	if($user->applyTokens($_SESSION["user_id"], $_SESSION["security_token"])) {
		$db->query("UPDATE users SET last_activity=NOW() WHERE id=".$_SESSION["user_id"].";");
		$loggedIn = true;
		$registerShow = false;
	} else {
		$loggedIn = false;
	}
} else {
	$loggedIn = false;
}

if(!$loggedIn) {
	if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["anrede"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["register"]) && isset($_POST["phone"]) && isset($_POST["address"]) && isset($_POST["mobile"]) && isset($_POST["password_verify"]) && isset($_POST["verify_email"]) && isset($_POST["city"])) {
	$creator_ = $user->register($_POST["username"], $_POST["password"], $_POST["password_verify"], $_POST["email"], $_POST["verify_email"], $_POST["anrede"], $_POST["firstname"], $_POST["lastname"], $_POST["phone"], $_POST["mobile"], $_POST["address"], $_POST["city"]);
	if($creator_) {
		$registerMessage = "Ihr Benutzerkonto wurde erfolgreich erstellt. Sie können sich nun anmelden.";
		$registerShow = "created";
	} else if($creator_ == "username-exists") {
		$registerMessage = "Dieser Benutzername existiert bereits!";
		$registerShow = true;
	} else if($creator_ == "password-wrong") {
		$registerMessage = "Die Passwörter stimmen nicht überein.";
		$registerShow = true;
	} else if($creator_ == "email-wrong") {
		$registerMessage = "Die E-Mail Adressen stimmen nicht überein.";
		$registerShow = true;
	}
} else {
	$registerMessage = "Bitte füllen sie die unten genannten Felder aus.";
	$registerShow = true;
}
}





?>