<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<h2>Registrieren</h2>
<?php

if($registerShow == "yes") {
?>
<h3 id="registerMessage"><?= $registerMessage; ?></h3>
<form action="?registerRequest=1" method="POST" id="registerForm">
	<input type="hidden" name="register" value="1">
	<div role="tablist" id="accordion">
		<div class="card">
			<div class="card-header" role="tab" id="headingOne">
				<h4 class="mb-0">
					<a data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne" href="#collapseOne">Nutzername, E-Mail und Passwort</a>
				</h4>
			</div>
			<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<div class="form-group">
						<label for="username">Nutzername:</label>
						<input type="text" class="form-control" id="username" name="username" required="required" value="">
					</div>
					<div class="form-group">
						<label for="email">E-Mail:</label>
						<input type="email" class="form-control" id="email" name="email" required="required" value="<?= $predefEmail; ?>">
					</div>
					<div class="form-group">
						<label for="verify_email">E-Mail wiederholen:</label>
						<input type="email" class="form-control" id="verify_email" name="verify_email" required="required" value="<?= $predefVerifyEmail; ?>">
					</div>
					<div class="form-group">
						<label for="password">Passwort:</label>
						<input type="password" class="form-control" id="password" name="password" required="required" value="<?= $predefPassword; ?>">
					</div>
					<div class="form-group">
						<label for="password_verify">Passwort wiederholen:</label>
						<input type="password" class="form-control" id="password_verify" name="password_verify" required="required" value="<?= $predefPasswordVerify; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" role="tab" id="headingTwo">
				<h4 class="mb-0">
					<a data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo" href="#collapseTwo">Vorname und Nachname</a>
				</h4>
			</div>
			<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
				<div class="card-body">
					<div class="form-group">
						<label for="anrede">Anrede:</label>
						<select class="form-control" name="anrede" id="anrede" value="<?= $predefAnrede; ?>">
							<option value="Herr">Herr</option>
							<option value="Frau">Frau</option>
						</select>
					</div>
					<div class="form-group">
						<label for="firstname">Vorname:</label>
						<input class="form-control" type="text" name="firstname" id="firstname" required="required" value="<?= $predefFirstname; ?>">
					</div>
					<div class="form-group">
						<label for="lastname">Nachname:</label>
						<input class="form-control" type="text" name="lastname" id="lastname" required="required" value="<?= $predefLastname; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" role="tab" id="headingThree">
				<h4 class="mb-0">
					<a data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree" href="#collapseThree">Telefonnummer</a>
				</h4>
			</div>
			<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
				<div class="card-body">
					<div class="form-group">
						<label for="phone">Telefonnummer:</label>
						<input class="form-control" type="phone" name="phone" id="phone" required="required" value="<?= $predefPhone; ?>">
					</div>
					<div class="form-group">
						<label for="mobile">Mobilnummer:</label>
						<input class="form-control" type="phone" name="mobile" id="mobile" required="required" value="<?= $predefMobile; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<h4 class="mb-0">
					<a data-toggle="collapse" aria-expanded="false" aria-controls="collapseFour" href="#collapseFour">Adressdaten</a>
				</h4>
			</div>
			<div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
				<div class="card-body">
					<div class="form-group">
						<label for="address">Adresse:</label>
						<textarea class="form-control" name="address" id="address" required="required"><?= $predefAddress; ?></textarea>
					</div>
					<div class="form-group">
						<label for="city">Standort:</label>
						<select class="form-control" name="city" id="city" required="required" value="<?= $predefCity; ?>">
							<option value="Frankfurt">Frankfurt</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<h4 class="mb-0">
					<a data-toggle="collapse" aria-expanded="false" aria-controls="collapseFive" href="#collapseFive">Captcha</a>
				</h4>
			</div>
			<div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
				<div class="card-body">
					<div class="form-group">
						<label for="captcha">Captcha:</label><br>
						<div class="g-recaptcha" data-sitekey="6LeucDwUAAAAAGhPmwiLA7h09l2yGcPS6HMPBx3V"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<a href="javascript:void(0);" onclick="javascript:submitForm();" class="btn btn-default btn-primary">Registrieren</a><a href="/account/login" class="btn btn-secondary">Anmelden</a>
</form>
<script>function validateForm() {var $error = $('#registerMessage');var fields = ["username","email","verify_email","password","password_verify","anrede","firstname","lastname","phone","mobile","address","city"];var abort = false;fields.forEach(function(element) {if($('#'+element).val().length < 1) {$('#registerMessage').html("<span style='color:red;'>Bitte füllen sie alle Felder aus!</span>");window.location.href = '#top';abort = true;}});if(abort === true) {return false;}var isHuman = grecaptcha.getResponse();if(isHuman.length >= 1) {return true;} else {$('#registerMessage').html("<span style='color:red;'>Bitte aktivieren sie den \"Ich bin kein Roboter\"-Haken!</span>");return false;}}function submitForm() {if(validateForm()) {$('#registerForm').submit();} else {window.location.href="#top";}}</script>
<?php
} else if($registerShow == "created") {
	?>
<p class="success">Der Nutzer wurde angelegt.</p>
	<?php
} else if($registerShow == "no") {
	?>

	<?php
} else {
?>
<h3 id="registerMessage">Dieser Nutzer existiert bereits!</h3>
<form action="?registerRequest=1" method="POST" id="registerForm">
	<input type="hidden" name="register" value="1">
	<div class="panelgroup" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Nutzername, E-Mail und Passwort</a>
				</h4>
			</div>
			<div class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
						<label for="username">Nutzername:</label>
						<input type="text" class="form-control" id="username" name="username" required="required" value="">
					</div>
					<div class="form-group">
						<label for="email">E-Mail:</label>
						<input type="email" class="form-control" id="email" name="email" required="required" value="<?= $predefEmail; ?>">
					</div>
					<div class="form-group">
						<label for="verify_email">E-Mail wiederholen:</label>
						<input type="email" class="form-control" id="verify_email" name="verify_email" required="required" value="<?= $predefVerifyEmail; ?>">
					</div>
					<div class="form-group">
						<label for="password">Passwort:</label>
						<input type="password" class="form-control" id="password" name="password" required="required" value="<?= $predefPassword; ?>">
					</div>
					<div class="form-group">
						<label for="password_verify">Passwort wiederholen:</label>
						<input type="password" class="form-control" id="password_verify" name="password_verify" required="required" value="<?= $predefPasswordVerify; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Vorname und Nachname</a>
				</h4>
			</div>
			<div class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
						<label for="anrede">Anrede:</label>
						<select class="form-control" name="anrede" id="anrede" value="<?= $predefAnrede; ?>">
							<option value="Herr">Herr</option>
							<option value="Frau">Frau</option>
						</select>
					</div>
					<div class="form-group">
						<label for="firstname">Vorname:</label>
						<input class="form-control" type="text" name="firstname" id="firstname" required="required" value="<?= $predefFirstname; ?>">
					</div>
					<div class="form-group">
						<label for="lastname">Nachname:</label>
						<input class="form-control" type="text" name="lastname" id="lastname" required="required" value="<?= $predefLastname; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Telefonnummer</a>
				</h4>
			</div>
			<div class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
						<label for="phone">Telefonnummer:</label>
						<input class="form-control" type="phone" name="phone" id="phone" required="required" value="<?= $predefPhone; ?>">
					</div>
					<div class="form-group">
						<label for="mobile">Mobilnummer:</label>
						<input class="form-control" type="phone" name="mobile" id="mobile" required="required" value="<?= $predefMobile; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Adressdaten</a>
				</h4>
			</div>
			<div class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
						<label for="address">Adresse:</label>
						<textarea class="form-control" name="address" id="address" required="required"><?= $predefAddress; ?></textarea>
					</div>
					<div class="form-group">
						<label for="city">Standort:</label>
						<select class="form-control" name="city" id="city" required="required" value="<?= $predefCity; ?>">
							<option value="Frankfurt">Frankfurt</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-default btn-primary">Registrieren</button><a href="/account/login" class="btn btn-secondary">Anmelden</a>
</form>
<script>function validateForm() {var $error = $('#registerMessage');var fields = ["username","email","verify_email","password","password_verify","anrede","firstname","lastname","phone","mobile","address","city"];var abort = false;fields.forEach(function(element) {if($('#'+element).val().length < 1) {$('#registerMessage').html("<span style='color:red;'>Bitte füllen sie alle Felder aus!</span>");window.location.href = '#top';abort = true;}});if(abort === true) {return false;}var isHuman = grecaptcha.getResponse();if(isHuman.length >= 1) {return true;} else {$('#registerMessage').html("<span style='color:red;'>Bitte aktivieren sie den \"Ich bin kein Roboter\"-Haken!</span>");return false;}}function submitForm() {if(validateForm()) {$('#registerForm').submit();} else {window.location.href="#top";}}</script>
<?php
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>