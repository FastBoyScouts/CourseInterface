
<br>
<hr>
<br>
<?php
if(!$user->hasPermission("message.copyright.bypass")) {
?>
<p>Development: <b><a href="https://marvnet.de" target="_blank">MarvNet</a></b><br>
Courses: <b><?= $settings->get("author"); ?></b></p>
<?php
} else {
?>
<p><b>:)</b></p>
<?php
}
?>
<?php if($user->hasPermission("system.meta")) { ?>
<p>Generated with <b><?= $db->numQueries(); ?></b> database queries.<br>
Used <b><?= count($classes); ?></b> classes.<br>
Queried <b><?= $settings->countLoadedSettings(); ?></b> settings.
</p>
<?php
}
?>
<script src="/static/js/app.js"></script>
</body>
</html>