<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<h2>Anmelden</h2>
<?php

if(!$loggedIn) {
?>
<h3><?php echo $loginMessage; ?></h3>
<form action="?loginRequest=1" method="POST">
	<input type="hidden" name="login" value="1">
	<div class="form-group">
		<label for="username">Nutzername:</label>
		<input type="text" class="form-control" id="username" name="username" required="required">
	</div>
	<div class="form-group">
		<label for="password">Passwort:</label>
		<input type="password" class="form-control" id="password" name="password" required="required">
	</div>
	<button type="submit" class="btn btn-default btn-primary">Anmelden</button>&nbsp;&nbsp;<a href="/account/register" class="btn btn-secondary">Registrieren</a>
</form>
<?php
} else {
?>
<h2>Sie sind bereits angemeldet!</h2>
<?php
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>