<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php
if($user->hasPermission("admin.permissions")) {
?>
<?php
if(isset($_REQUEST["msg"])) {
	switch($_REQUEST["msg"]) {
		case "deleted":
			$msg = '<p class="error">Der Eintrag wurde gelöscht!</p>';
			break;

		default:
			$msg = "";
			break;
	}

} else {
	$msg = "";
}
$action = "list";
if(isset($_REQUEST["action"])) {
	$action = $_REQUEST["action"];
}
if($action == "list") {
?>
<div class="container">
	<?= $msg; ?>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<th>Rolle</th>
				<th>Recht</th>
				<th>Status</th>
			</thead>
			<tbody>
<?php
$result = $db->query("SELECT * FROM `permissions`;");
foreach($result as $row) {
	$role = "";
	switch($row["role"]) {
		case "adminstrator":
			$role = "<span style='color:red;'>Adminstrator</span>";
			break;

		case "guest":
			$role = "<span style='color:blue;'>Gast</span>";
			break;

		case "content":
			$role = "<span style='color:lightgreen;'>Inhaltsbeauftragter</span>";
			break;

		case "webmaster":
		case "developer":
			$role = "<span style='color:cyan;'>Entwickler</span>";
			break;

		case "user":
			$role = "<span style='color:grey;'>Nutzer</span>";
			break;

		default:
			$role = $row["role"];
			break;
	}

	?>
	<tr>
		<td><?= $role; ?></td>
		<td><em><?= $row["permission"]; ?></em></td>
		<td><?php
		if($row["active"] == 1) {
			echo '<span style="color:green;">Aktiv</span> (<a href="?action=toggle&perm='.$row["id"].'"><span style="">Deaktivieren</span></a>)';
		} else {
			echo '<span style="color:red;">Inaktiv</span> (<a href="?action=toggle&perm='.$row["id"].'"><span style="">Aktivieren</a></span> || <a href="?action=delete&perm='.$row["id"].'">Löschen</a>)';
		}
		?></td>
	</tr>
	<?php
}
} else if($action == "toggle") {
	if(isset($_REQUEST["perm"])) {
		$result = $db->query("SELECT * FROM `permissions` WHERE id=".mysqli_escape_string($db->getConnection(),$_REQUEST["perm"])." LIMIT 1;");
		if(mysqli_num_rows($result) == 1) {
			foreach($result as $row) {
			if($row["active"] == 1) {
				$db->query("UPDATE `permissions` SET active=0 WHERE id=".mysqli_escape_string($db->getConnection(),$_REQUEST["perm"]).";");
			} else {
				$db->query("UPDATE `permissions` SET active=1 WHERE id=".mysqli_escape_string($db->getConnection(),$_REQUEST["perm"]).";");
			}
		}
		echo '<script>location.href="?action=list";</script>';
	} else { echo '<p class="error">Das angegebene <b>Recht</b> ist ungültig! <a href="?action=list">Zur&uuml;ck</a></p>'; }
		
	} else { echo '<p class="error">Es wurde kein <b>Recht</b>angegeben! <a href="?action=list">Zur&uuml;ck</a></p>';}
} else if($action == "delete") {
	if(isset($_REQUEST["perm"])) {
		$result = $db->query("SELECT * FROM `permissions` WHERE id=".mysqli_escape_string($db->getConnection(),$_REQUEST["perm"]).";");
		if(mysqli_num_rows($result) == 1) {
			$db->query("DELETE FROM `permissions` WHERE id=".mysqli_escape_string($db->getConnection(),$_REQUEST["perm"]).";");
			echo '<script>location.href="?action=list";</script>';
		} else { echo '<p class="error">Das angegebene <b>Recht</b> ist ungültig! <a href="?action=list">Zur&uuml;ck</a></p>'; }
	} else { echo '<p class="error">Es wurde kein <b>Recht</b>angegeben! <a href="?action=list">Zur&uuml;ck</a></p>';}
}

?>

			</tbody>
		</table>
	</div>
</div>
<?php
?>
<?php
} else {
?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite aufzurufen!</p>
<?php
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>