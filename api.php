<?php include($_SERVER["DOCUMENT_ROOT"]."/inc/implementer.php"); ?>
<?php
header("Content-type: application/json");
if(isset($_REQUEST["action"])) {
	$action = htmlspecialchars($_REQUEST["action"]);
} else {
	$action = "404";
}

function NoPermission() {
	echo '{"code":403,"response":{}}';
}

switch($action) {


	case "list-events":
		if($user->hasPermission("events.view")) {
			$eventController = new EventController();
			echo '{"code":200,"response":{'.$eventController->getAllEventsJson().'}}';
		} else NoPermission();
		break;

	case "404":
	default:
		echo '{"code":404,"response":{}}';
		break;

}
?>