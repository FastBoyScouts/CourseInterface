<?php
/*

	THIS IS THE IMPLEMENTER SCRIPT FOR THE COURSE-INTERFACE.
	IT IMPLEMENTS ALL METHODS AND CLASSES FOR THE SITE TO WORK.

	CURRENT IMPLEMENTER VERSION: 1.0.1

*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);

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

include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Thirdparty.class.php");
$thirdparty = new ThirdParty();

include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/SMS.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Communication.class.php");
$communication = new Communication();

include($_SERVER["DOCUMENT_ROOT"]."/inc/functions.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/User.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/UserProfile.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Event.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/EventController.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/FileController.class.php");
$file = new FileController();

include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/Child.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/classes/ChildController.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/lib/securimage/securimage.php");

$user = new User();

if($settings->get("wartungsmodus")) {
	die("<html><head><meta charset='utf-8'><title>Wartungsmodus</title></head><body><h1>Wartung</h1><h2>Wir überarbeiten diese Webseite aktuell</h2></body></html>");
}

// Initialize database


if(isset($_REQUEST["goto"])) {
	$goto = htmlspecialchars($_REQUEST["goto"]);
} else {
	$goto = "/index.php";
}

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["login"]) && isset($_POST["captcha"])) {
	$abort = false;

	$captcha = $_POST["captcha"];

	$securimage = new Securimage();

	if($securimage->check($captcha) == false) {
		$loginMessage = "Das eingegebene Captcha ist ungültig!";
		$loggedIn = false;
		$abort = true;
	}

	
	if(!$abort) {
	$loginResponse = $user->login($_POST["username"], $_POST["password"]);
	if($loginResponse == "loggedin") {
		$loginMessage = "Sie wurden angemeldet!";
		die(header("Location: ".$goto));
	} else if($loginResponse == "blocked") {
		$loginMessage = "Der Nutzer wurde gesperrt. Bitte kontaktieren sie uns bei weiteren Fragen.";
		$loggedIn = false;
	} else if($loginResponse == "password") {
		$loginMessage = "Die angegebenen Daten sind falsch";
		$loggedIn = false;
	} else if($loginResponse == "username") {
		$loginMessage = "Die angegebenen Daten sind falsch";
		$loggedIn = false;
	} else if($loginResponse == "wrong") {
		$loginMessage = "Die angegebenen Daten sind falsch";
		$loggedIn = false;
	} else {
		$loginMessage = "Der Nutzer konnte nicht angemeldet werden.";
		$loggedIn = false;
	}
}


} else {
	$loginMessage = "Bitte geben sie ihre Daten ein!";
	$loggedIn = false;
}


if(isset($_SESSION["user_id"]) && isset($_SESSION["security_token"])) {
	if($user->applyTokens($_SESSION["user_id"], $_SESSION["security_token"])) {
		$db->query("UPDATE users SET last_activity=NOW() WHERE id=".$_SESSION["user_id"].";");
		$loggedIn = true;
		$registerShow = "no";
	} else {
		$loggedIn = false;
	}
} else {
	$loggedIn = false;
}


$predefUsername = "";
$predefEmail = "";
$predefAnrede = "";
$predefFirstname = "";
$predefLastname = "";
$predefPhone = "";
$predefAddress = "";
$predefMobile = "";
$predefPasswordVerify = "";
$predefPassword = "";
$predefVerifyEmail = "";
$predefCity = "";
if(!$loggedIn) {
	if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["anrede"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["register"]) && isset($_POST["phone"]) && isset($_POST["address"]) && isset($_POST["mobile"]) && isset($_POST["password_verify"]) && isset($_POST["verify_email"]) && isset($_POST["city"])) {
		$abort = false;


	$captcha = $_POST["captcha"];

	$securimage = new Securimage();

	if($securimage->check($captcha) == false) {
		$loginMessage = "Das eingegebene Captcha ist ungültig!";
		$loggedIn = false;
		$abort = true;
	}

	$predefUsername = htmlspecialchars($_POST["username"]);
	$predefEmail = htmlspecialchars($_POST["email"]);
	$predefAnrede = htmlspecialchars($_POST["anrede"]);
	$predefFirstname = htmlspecialchars($_POST["firstname"]);
	$predefLastname = htmlspecialchars($_POST["lastname"]);
	$predefPhone = htmlspecialchars($_POST["phone"]);
	$predefMobile = htmlspecialchars($_POST["mobile"]);
	$predefVerifyEmail = htmlspecialchars($_POST["verify_email"]);
	$predefAddress = htmlspecialchars($_POST["address"]);
	$predefCity = htmlspecialchars($_POST["city"]);
	if(!$abort) {
	$creator_ = $user->register($_POST["username"], $_POST["password"], $_POST["password_verify"], $_POST["email"], $_POST["verify_email"], $_POST["anrede"], $_POST["firstname"], $_POST["lastname"], $_POST["phone"], $_POST["mobile"], $_POST["address"], $_POST["city"]);
	if($creator_ == "ok") {
		$registerMessage = "Ihr Benutzerkonto wurde erfolgreich erstellt. Sie können sich nun anmelden.";
		$registerShow = "created";
	} else if($creator_ == "username-exists") {
		$predefUsername = "";
		$registerMessage = "Dieser Benutzername existiert bereits!";
		$registerShow = "yes";
	} else if($creator_ == "password-wrong") {
		$registerMessage = "Die Passwörter stimmen nicht überein.";
		$registerShow = "yes";
	} else if($creator_ == "email-wrong") {
		$predefEmail = "";
		$predefVerifyEmail = "";
		$registerMessage = "Die E-Mail Adressen stimmen nicht überein.";
		$registerShow = "yes";
	} else if($creator_ == "mobile-invalid") {
		$predefMobile = "";
		$registerMessage = "Die Mobilnummer ist ungültig.";
		$registerShow = "yes";
	} else if($creator_ == "phone-invalid") {
		$predefPhone = "";
		$registerMessage = "Die Telefonnummer ist ungültig.";
		$registerShow = "yes";
	}
}
} else {
	$registerMessage = "Bitte füllen sie die unten genannten Felder aus.";
	$registerShow = "yes";
}
}





?>