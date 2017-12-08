<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php
if($user->hasPermission("admin.users")) {
$query = $db->query("SELECT * FROM `users`;");
echo '<p><b>Nutzer gefunden:</b>&nbsp;'.mysqli_num_rows($query).'</p>';
while($row = mysqli_fetch_assoc($query)) {
	$profile = new UserProfile($row["username"]);

?>
<br><hr>
<h2><?= $profile->getFormattedName(); ?></h2>
<?= $profile->getRoleTile(); ?>
<?php
}

} else {
?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite einzusehen!</p>
<?php
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>