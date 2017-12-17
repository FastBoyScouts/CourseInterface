<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php
if($user->hasPermission("user.children")) {
?>

<?php
} else {
?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite aufzurufen!</p>
<?php }
include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>