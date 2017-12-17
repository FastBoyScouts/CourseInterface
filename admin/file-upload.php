<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php
if($user->hasPermission("admin.files.upload")) {
if(isset($_POST["title"]) && isset($_POST["type"]) && isset($_FILES["f"])) {
	if($file->upload($_FILES["f"],$db->escapeString($_POST["title"]),$db->escapeString($_POST["type"]))) {
		//die(header("Location: /acp/files?msg=upload-success"));
	} else {
		//die(header("Location: /acp/files?msg=upload-failure"));
	}
}
?>
<div class="container">
	<h2>Datei hochladen</h2>
	<form action='' method='post' enctype='multipart/form-data'>
		<div class="form-group">
			<label for="title">Titel:</label><br>
			<input type="text" id="title" name="title" required="required" class="form-control">
		</div>
		<div class="form-group">
			<label for="type">Typ:</label><br>
			<select name="type" id="type" required="required" class="form-control">
				<option value="image">Bild</option>
				<option value="course-material">Kursmaterial</option>
			</select>
		</div>
		<div class="form-group">
			<label for="f">Datei:</label><br>
			<input type="file" name="f" id="f" required="required" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" value="Hochladen" class="btn btn-default btn-primary">
		</div>
	</form>
</div>
<?php
} else {
?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite aufzurufen!</p>
<?php }
include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>