<?php include("head.php"); ?>
<?php
if(isset($_GET["eid"])) {
	if($user->hasPermission("events.view")) {
	$event = new Event($_GET["eid"]);
	if($event->exists()) {
		$data = $event->getData();
		?>
<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2><?= $data["title"]; ?></h2>
				<p><b>Erstellt von:</b><?= $data["creator_name"]; ?></p>
			</div>
			<div class="col-md-6">
				<?= $data["about"]; ?>
			</div>
		</div>
</div>
		<?php
	} else {
		echo '<p class="NoPerm">Das Event existiert nicht!</p>';
	}
} else {
	echo '<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite zu sehen!</p>';
}
} else {
	echo '<div class="event-list">';
	// Has to be replaced with class
	$query = $db->query("SELECT * FROM `courses` WHERE archived=0;");
	foreach($query as $row) {
		?>
<div class="event-frame">
	<h3><?= $row["title"]; ?></h3>
	<a href='/events.php?eid=<?= $row["id"]; ?>'>Ansehen</a><br>
</div>
<hr>
		<?php
		echo '</div>';
	}
}
?>
<?php include("footer.php"); ?>