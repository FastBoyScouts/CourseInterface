<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php
if($user->hasPermission("admin.webmaster.general")) {
?>
<h2>Willkommen, Webmaster!</h2>
<p>Hier können Einstellungen bezüglich der Webseite getätigt werden.<br>
Webmaster ist die höchste Rolle im <b>CourseCMS</b>.</p>
<?php
} else {
?>
<p class="error">Du hast nicht die benötigten Berechtigungen, diese Seite aufzurufen.</p>
<?php
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>