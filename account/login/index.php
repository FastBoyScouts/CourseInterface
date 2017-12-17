<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php if(!$loggedIn) { ?>
<h2>Anmelden</h2>
<?php
?>
<h3><?php echo $loginMessage; ?></h3>
<form action="?loginRequest=1" method="POST" id="loginForm">
	<input type="hidden" name="login" value="1">
	<div class="form-group">
		<label for="username">Nutzername:</label>
		<input type="text" class="form-control" id="username" name="username" required="required" value="<?= $predefUsername; ?>">
	</div>
	<div class="form-group">
		<label for="password">Passwort:</label>
		<input type="password" class="form-control" id="password" name="password" required="required" value="<?= $predefPassword; ?>">
	</div>
	<div class="form-group">
		<label>Captcha:</label><br>
		<div class="g-recaptcha" data-sitekey="6LeucDwUAAAAAGhPmwiLA7h09l2yGcPS6HMPBx3V"></div>
	</div>
	<button onclick="javascript:submitForm();">Registrieren</button>&nbsp;&nbsp;<a href="/account/register" class="btn btn-secondary">Registrieren</a>
</form>
<script>
var isHuman = grecaptcha.getResponse();
function validateForm() {
	if(isHuman.length == 0) {
    	return false;
	}

	return false;
}

function submitForm() {
	if(validateForm()) {
		$('#loginForm').submit();
	} else {
		alert("Bitte aktivieren sie den \"Ich bin kein Roboter \"-Haken!");
	}
}
</script>
<?php
} else {
	echo '<p class="error">Sie sind bereits angemeldet!</p>';
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>