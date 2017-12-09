<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php
if($user->hasPermission("admin.users")) {
$action = "list";
$selectedUser = false;
if(isset($_GET["action"])) {
	$action = htmlspecialchars($_GET["action"]);
}

if(isset($_GET["user"])) {
	$selectedUser = htmlspecialchars($_GET["user"]);
	$temp = new UserProfile($selectedUser,"id");
	if(!$temp->getValid()) {
		$selectedUser = false;
	}
}

if($action == "list") {
?>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Nutzername</th>
					<th>Avatar</th>
					<th>Rolle</th>
					<th>Informationen</th>
					<th>Steuerungen</th>
				</tr>
			</thead>
			<tbody>
<?php
$query = $db->query("SELECT * FROM `users`;");
echo '<p><b>Nutzer gefunden:</b>&nbsp;'.mysqli_num_rows($query).'</p>';

while($row = mysqli_fetch_assoc($query)) {
	$class ="";
	$informations = "";
	$blocked = false;
	$links = "";
	$profile = new UserProfile($row["username"]);
	if($profile->getBlocked()) {
		$blocked = true;
		$class .= "danger ";
		$informations .= "Gesperrt; ";
		//$links .= '<a href="?action=ban&user='.$profile->getUsername().'">Ban</a>';
		$links .= '<a href="?action=unban&user='.$profile->getId().'">Entsperren</a>';
	} else {
		$class .= "success ";
		//$links .= '<a href="?action=unban&user='.$profile->getUsername().'">Unban</a>';
		$links .= '<a href="?action=ban&user='.$profile->getId().'">Sperren</a>';
	}

	$adminstratorVars = "";
	$userVars = "";
	$contentVars = "";
	$developerVars = "";
	switch($profile->getRole()) {
		case "adminstrator":
			$adminstratorVars = "selected='selected'";
			break;

		case "user":
			$userVars = "selected='selected'";
			break;

		case "content":
			$contentVars = "selected='selected'";
			break;

		case "developer":
			$developerVars = "selected='selected'";
			break;

		default:
			$userVars = "selected='selected'";
			break;
	}
	$links .= "<br><form action='' method='get'><input type='hidden' name='action' value='setrole'><input type='hidden' name='user' value='".$profile->getId()."'><select name='role'><option value='adminstrator' $adminstratorVars>Adminstrator</option><option value='content' $contentVars>Inhaltsbeauftragter</option><option value='user' $userVars>Benutzer</option><option value='developer' $developerVars>Entwickler</option></select>&nbsp;&nbsp;<input type='submit' value='Go &raquo;'></form>";

?>
<tr class="<?= $class; ?>">
	<td><?= $profile->getFormattedName(); ?></td>
	<td><img src="<?= $profile->getAvatarUrl(50); ?>"></td>
	<td><?= $profile->getRoleTile(); ?></td>
	<td><?= $informations; ?></td>
	<td><?= $links; ?></td>
</tr>
<?php
}

} else if($action == "ban") {
	if(!$selectedUser) {
		echo '<p class="error">Kein Nutzer wurde angegeben/nutzer invalide! <a href="?action=list">Zur&uuml;ck</a></p>';
	} else {
		$temp = new UserProfile($selectedUser,"id");
		$temp->setBlocked(true);
		die(header("Location: ?action=list"));
	}
} else if($action == "unban") {
	if(!$selectedUser) {
		echo '<p class="error">Kein Nutzer wurde angegeben/nutzer invalide! <a href="?action=list">Zur&uuml;ck</a></p>';
	} else {
		$temp = new UserProfile($selectedUser,"id");
		$temp->setBlocked(false);
		die(header("Location: ?action=list"));
	}
} else if($action == "setrole") {
	if(!$selectedUser) {echo '<p class="error">Kein Nutzer wurde angegeben/nutzer invalide! <a href="?action=list">Zur&uuml;ck</a></p>';} else {
		$temp = new UserProfile($selectedUser,"id");
		$possibleRoles = array("adminstrator","content","moderator","user","developer");
		if(isset($_REQUEST["role"])) {
			if(in_array($_REQUEST["role"], $possibleRoles)) {
				$temp->setRole($_REQUEST["role"]);
				die(header("Location: ?action=list"));
			} else {echo '<p class="error">Die angegebene Rolle ist ungültig! <a href="?action=list">Zur&uuml;ck</a></p>';}
		} else {echo '<p class="error">Keine Rolle angegeben! <a href="?action=list">Zur&uuml;ck</a></p>';}
		
	}
}




?>
			</tbody>
		</table>
	</div>
</div>
<?php
} else {
?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite einzusehen!</p>
<?php
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>