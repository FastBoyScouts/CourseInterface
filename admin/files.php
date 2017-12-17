<?php include($_SERVER["DOCUMENT_ROOT"]."/head.php"); ?>
<?php
if($user->hasPermission("admin.files")) {
if(isset($_REQUEST["action"]) && isset($_REQUEST["file"])) {
	switch($_REQUEST["action"]) {
		case "delete":
			$file->delete($_REQUEST["file"]);
			break;
	}
}
?>
<h2>Dateien</h2>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<th>ID</th>
				<th>Titel</th>
				<th>Typ</th>
				<th>Datei</th>
				<th>Kontrolle</th>
			</thead>
			<tbody>
				<?php
					$i = 0;
					foreach($file->getAllFiles() as $f) {
						$i++;
						?>
							<tr>
								<td><?= $f["id"]; ?></td>
								<td><?= $f["title"]; ?></td>
								<td><?= $f["mime"]; ?></td>
								<td>
								<?php
								switch($f["mime"]) {
									case "image/png":
									case "image/jpg":
										?>
										<a href="/media/<?= $f["id"]; ?>" target="_blank"><img src="<?= $f["webpath"]; ?>" alt="<?= $f["title"]; ?>"></a>
										<?php
										break;

									default:
										?>
										<a href="<?= $f["webpath"]; ?>" target="_blank">Ansehen</a>
										<?php
										break;
								}
								?>
								</td>
								<td><a href="?action=delete&file=<?= $f["id"]; ?>">Löschen</a></td>
							</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<button class="btn btn-default btn-primary" onclick="javascript:location.href='/acp/file-upload';">Upload</button>
</div>
<br><hr><br>

<?php
} else {
?>
<p class="NoPerm">Sie haben nicht die benötigten Berechtigungen, diese Seite einzusehen!</p>
<?php }
include($_SERVER["DOCUMENT_ROOT"]."/footer.php"); ?>