<?php include($_SERVER["DOCUMENT_ROOT"]."/inc/implementer.php"); ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="creator" content="MarvNet / https://marvnet.de">
	<meta name="author" content="MarvNet / https://marvnet.de">
	<meta name="generator" content="MarvNet's course-interface">
	<meta name="viewport"  content="width=device-width,initial-scale=1,user-scalable=yes">
	<title><?php echo $config["site-title"]; ?></title>
  <link rel="stylesheet" href="/static/lib/bootstrap/v4-imported/css/bootstrap.min.css">
  <script src="/static/lib/jquery/3.2.1-new/jquery-3.2.1.min.js"></script>
  <script src="/static/lib/popperjs/popper.min.js"></script>
  <script src="/static/lib/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
  <script src="/static/lib/fontawesome-free-5.0.1/svg-with-js/js/fontawesome-all.min.js"></script>
  <script src="/static/lib/tinymce/js/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: 'textarea.tinymce',
      plugins: 'textcolor colorpicker',
      toolbar: 'backcolor forecolor'
    });
  </script>
  <script src='https://www.google.com/recaptcha/api.js?onload=captchaCallback' async defer></script>
    
	<style>
    <?php echo(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/static/css/app.css")); ?>
  </style>
</head>
<body>
<header>
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
      <?php
        $adminFrames = 0;
        $admin = array();
        $admin["users"] = false;
        $admin["permissions"] = false;
        $admin["files"] = false;

        if($user->hasPermission("admin.files")) {
          ++$adminFrames;
          $admin["files"] = true;
        }

        if($user->hasPermission("admin.users")) {
          ++$adminFrames;
          $admin["users"] = true;
        }

        if($user->hasPermission("admin.permissions")) {
          ++$adminFrames;
          $admin["permissions"] = true;
        }

        if($adminFrames >= 1) {
        ?>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <?php if($admin["users"]) { ?>
            <li><a href="/acp/users">Nutzerverwaltung</a></li>
            <?php
          }
          if( $admin["permissions"]) {
          ?>
          <li><a href="/acp/permissions">Rechteverwaltung</a></li>
          <?php
        }
          if($admin["files"]) {
            ?>
              <li><a href="/acp/files">Dateiverwaltung</a></li>
            <?php
          }
        ?>
          </ul>
        </li>

        <?php
      }
      ?>
    </ul>
    <?php
      if(!$loggedIn) {
      ?>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="/account/register?goto=<?= $_SERVER['PHP_SELF']; ?>"><i class="far fa-user"></i> Registrieren</a></li>
      	<li><a href="/account/login?goto=<?= $_SERVER['PHP_SELF']; ?>"><i class="fas fa-user"></i> Anmelden</a></li>
      </ul>
      <?php
  		} else {
  	?>
<ul class="nav navbar-nav navbar-right" style="margin-right:5px;">
        <?php $temp = new UserProfile($user->getId(),"id"); ?>
        <li><?php
        
        echo $temp->getRoleTile(); ?></li>
      </ul>
    <?php
  }
  ?>
  </div>
</nav>
</header>
<main>
<div class="container">
<noscript>
  <div class="alert alert-danger">
    <strong>Achtung!</strong> Diese Webseite funktioniert ohne <strong>JavaScript</strong> nicht korrekt!
  </div>
</noscript>