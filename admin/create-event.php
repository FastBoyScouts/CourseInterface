<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php if($user->hasPermission("events.create")) { ?>
<h2>Event erstellen</h2>
<?php } else { ?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite anzusehen!</p>
<?php } include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>