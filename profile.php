<?php include("head.php"); ?>
<?php
if($user->hasPermission("user.profile")) {
?>
<?php
if(isset($_REQUEST["uid"])) {

$profile = new UserProfile($_REQUEST["uid"]);
if($profile->getValid()) {
?>
<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img src="<?= $profile->getAvatarUrl(); ?>">
			</div>
			<div class="col-md-6">
				<h2 class="trebuchet"><?= $profile->getUsername(); ?></h2>
				<?= $profile->getRoleTile(); ?>
			</div>
		</div>
</div>
<?php
} else {
?>
<p class="error">Nutzer nicht gefunden!</p>
<?php
}
} else {
?>
<p class="error">Kein Nutzer angegeben!</p>
<?php
}
} else {
?>
<p class="NoPerm">Du hast nicht die benötigten Berechtigungen, diese Seite aufzurufen.</p>
<?php
}
?>
<?php include("footer.php"); ?>