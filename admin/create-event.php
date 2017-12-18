<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php if($user->hasPermission("events.create")) { ?>
<h2>Event erstellen</h2>
<form action="" method="post">
	<div class="form-group">
		<label for="title">Titel:</label>
		<input type="text" class="form-control" id="title" name="title" required>
	</div>
	<div class="form-group">
		<label for="registration_opened">Registrierung geöffnet <i>ab</i>:</label>
		<input type="date" class="form-control" id="registration_opened" name="registration_opened" required>
	</div>
	<div class="form-group">
		<label for="registration_closed">Registrierung geschlossen <i>ab</i>:</label>
		<input type="date" class="form-control" id="registration_closed" name="registration_closed" required>
	</div>
	<div class="form-group">
		<label for="location">Standort:</label>
		<textarea name="location" id="location" class="form-control" required></textarea>
	</div>
	<div class="form-group">
		<label for="about">Über den Kurs:</label>
		<textarea name="about" id="about" required="required" class="tinymce"><p>Hier können sie frei etwas über den Kurs <b>schreiben</b>!</p></textarea>
	</div>
	<input type="submit" class="btn btn-default btn-primary" value="Erstellen">
</form>
<?php } else { ?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite anzusehen!</p>
<?php } include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>