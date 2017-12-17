<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php if(!$loggedIn) { ?>
<h2>Anmelden</h2>
<?php
?>
<h3 id="loginMessage"><?php echo $loginMessage; ?></h3>
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
	<a href="javascript:void(0);" onclick="javascript:submitForm();" class="btn btn-default btn-primary">Submit</a>&nbsp;&nbsp;<a href="/account/register" class="btn btn-secondary">Registrieren</a>
</form>
<script>function validateForm() {var isHuman = grecaptcha.getResponse();var fields = ["username","password"];var abort = false;fields.forEach(function(elem) {if($('#'+elem).val().length < 1) {abort = true;}});if(abort) {$('#loginMessage').html("<span style='color:red;'>Bitte füllen sie alle Felder aus!</span>");return false;}if(isHuman.length >= 1) {return true;} else {$('#loginMessage').html("<span style='color:red;'>Bitte aktivieren sie den \"Ich bin kein Roboter\"-Haken!</span>");return false;}}function submitForm() {if(validateForm()) {$('#loginForm').submit();} else {$('#loginMessage').html("<span style='color:red;'>Bitte aktivieren sie den \"Ich bin kein Roboter\"-Haken!</span>");}}</script>
<?php
} else {
	echo '<p class="error">Sie sind bereits angemeldet!</p>';
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>