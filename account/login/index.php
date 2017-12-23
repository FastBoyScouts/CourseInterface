<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php if(!$loggedIn) { ?>
<h2>Anmelden</h2>
<?php
?>
<h3 id="loginMessage"><?php echo $loginMessage; ?></h3>
<form action="?loginRequest=1" method="POST" id="loginForm" class="my-2 my-lg-0">
	<input type="hidden" name="login" value="1">
	<div class="form-group">
		<!--<label for="username">Nutzername:</label>-->
		<input type="text" class="form-control form-text form-control-lg" id="username" name="username" placeholder="Benutzername" required="required" aria-describedby="usernameHelp" value="<?= $predefUsername; ?>">
		<small id="usernameHelp" class="form-text text-muted">Bitte geben sie hier ihre E-Mail-Adresse ein.</small>
	</div>
	<div class="form-group">
		<!--<label for="password">Passwort:</label>-->
		<input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Passwort" aria-describedby="passwordHelp" required="required" value="<?= $predefPassword; ?>">
		<small id="passwordHelp" class="form-text text-muted">Bitte geben sie hier ihr Passwort ein.</small>
	</div>
	<div class="form-group">
		<label>Captcha:</label><br>
		<div class="g-recaptcha" data-sitekey="<?= $settings->get("recaptcha_public"); ?>"></div>
	</div>
	<a href="javascript:void(0);" onclick="javascript:submitForm();" class="btn btn-default btn-primary">Anmelden</a>&nbsp;&nbsp;<a href="/account/register" class="btn btn-secondary">Registrieren</a>
</form>
<script>function validateForm() {var isHuman = grecaptcha.getResponse();var fields = ["username","password"];var abort = false;fields.forEach(function(elem) {if($('#'+elem).val().length < 1) {abort = true;}});if(abort) {$('#loginMessage').html("<span style='color:red;'>Bitte füllen sie alle Felder aus!</span>");return false;}if(isHuman.length >= 1) {return true;} else {$('#loginMessage').html("<span style='color:red;'>Bitte aktivieren sie den \"Ich bin kein Roboter\"-Haken!</span>");return false;}}function submitForm() {if(validateForm()) {$('#loginForm').submit();} else {$('#loginMessage').html("<span style='color:red;'>Bitte aktivieren sie den \"Ich bin kein Roboter\"-Haken!</span>");}}</script>
<?php
} else {
	echo '<p class="error">Sie sind bereits angemeldet!</p>';
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>