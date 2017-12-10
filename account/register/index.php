<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<h2>Registrieren</h2>
<?php

if($registerShow == "yes") {
?>
<h3><?php echo $registerMessage; ?></h3>
<form action="?registerRequest=1" method="POST">
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
						<input type="text" class="form-control" id="username" name="username" required="required" value="<?= $predefUsername; ?>">
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
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Captcha</a>
				</h4>
			</div>
			<div class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="form-group">
					<?php

						$options = array();
     					$options['input_name']             = 'captcha'; // change name of input element for form post
      					$options['disable_flash_fallback'] = false; // allow flash fallback

						echo Securimage::getCaptchaHtml($options);
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-default btn-primary">Registrieren</button><a href="/account/login" class="btn btn-secondary">Anmelden</a>
</form>
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
<h3>Dieser Nutzer existiert bereits!</h3>
<form action="?registerRequest=1" method="POST">
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
<?php
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>