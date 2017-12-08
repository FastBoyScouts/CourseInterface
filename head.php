<?php include($_SERVER["DOCUMENT_ROOT"]."/inc/implementer.php"); ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="creator" content="MarvNet / https://marvnet.de">
	<meta name="author" content="MarvNet / https://marvnet.de">
	<meta name="generator" content="MarvNet's course-interface">
	<meta name="viewport"  content="width=device-width,initial-scale=1,user-scalable=yes">
	<title><?php echo $config["site-title"]; ?></title>

<!--
<link rel="stylesheet" href="/static/lib/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="/static/lib/jquery/3.2.1-new/jquery-3.2.1.min.js"></script>
    <script src="/static/lib/popperjs/popper.min.js"></script>
    <script src="/static/lib/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>-->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
	<style>
    <?php echo(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/static/css/app.css")); ?>
  </style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/"><?php echo $settings->get("site-title"); ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/index.php">Startseite</a></li>
      <li><a href="/events.php">Veranstaltungen</a></li>
      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Mein Konto<b class="caret"></b></a>
      	<ul class="dropdown-menu">
      		<?php
      			if($loggedIn) {
      				echo "<li><a href='/account'>Mein Konto</a></li>";
      				echo "<li><a href='/account/logout'>Logout</a></li>";
      				echo "<li class='divider'></li>";
      				echo "<li><a href='/account'>Willkommen, ".$user->getUserData()["username"]."!</a></li>";
      			} else {
      				echo "<li><a href='/account/login?return=".$_SERVER['PHP_SELF']."'>Anmelden</a></li>";
      				echo "<li><a href='/account/register?return=".$_SERVER['PHP_SELF']."'>Registrieren</a></li>";
      			}
      		?>	
      	</ul>	
      </li>

    </ul>
    <?php
      if(!$loggedIn) {
      ?>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="/account/register?goto=<?= $_SERVER['PHP_SELF']; ?>"><span class="glyphicon glyphicon-user"></span> Registrieren</a></li>
      	<li><a href="/account/login?goto=<?= $_SERVER['PHP_SELF']; ?>"><span class="glyphicon glyphicon-log-in"></span> Anmelden</a></li>
      </ul>
      <?php
  		}
  	?>
  </div>
</nav>