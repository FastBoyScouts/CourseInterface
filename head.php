<?php include($_SERVER["DOCUMENT_ROOT"]."/inc/implementer.php"); ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="creator" content="MarvNet / https://marvnet.de">
	<meta name="author" content="MarvNet / https://marvnet.de">
	<meta name="generator" content="MarvNet's course-interface">
	<meta name="viewport"  content="width=device-width,initial-scale=1,user-scalable=yes">
	<title><?php echo $config["site-title"]; ?></title>
  <!--<link rel="stylesheet" href="/static/lib/bootstrap/v4-imported/css/bootstrap.min.css">-->
  <!--<link rel="stylesheet" href="/static/lib/bootstrap/material/css/bootstrap-material-design.min.css">-->
  <script src="/static/lib/jquery/3.2.1-new/jquery-3.2.1.min.js"></script>
  <script src="/static/lib/popperjs/popper.min.js"></script>
  <!--<script src="/static/lib/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>-->
  <!--<script src="/static/lib/bootstrap/material/js/bootstrap-material-design.min.js"></script>-->
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.4/dist/css/bootstrap-material-design.min.css" integrity="sha384-R80DC0KVBO4GSTw+wZ5x2zn2pu4POSErBkf8/fSFhPXHxvHJydT0CSgAP2Yo2r4I" crossorigin="anonymous">
<script src="https://unpkg.com/bootstrap-material-design@4.0.0-beta.4/dist/js/bootstrap-material-design.js" integrity="sha384-3xciOSDAlaXneEmyOo0ME/2grfpqzhhTcM4cE32Ce9+8DW/04AGoTACzQpphYGYe" crossorigin="anonymous"></script>
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
  <script src='https://www.google.com/recaptcha/api.js?onload=captchaCallback&hl=de' async defer></script>
    
	<style>
    <?php echo(file_get_contents($_SERVER["DOCUMENT_ROOT"]."/static/css/app.css")); ?>
  </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><?= $settings->get("site-title"); ?></a>
      <button style="cursor:pointer;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/account" id="menu-dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mein Konto</a>
            <div class="dropdown-menu" aria-labelledby="menu-dropdown01">
              <?php
              if($user->isLoggedIn()) {
                ?>
                <a href="#" class="dropdown-item">Willkommen, <?= $user->getUsername(); ?>!</a>
                <a class="dropdown-item" href="/account/logout">Abmelden</a>
                <?php
              } else {
                ?>
                <a href="/account/login" class="dropdown-item">Anmelden</a>
                <a href="/account/register" class="dropdown-item">Registrieren</a>
                <?php
              }
              ?>
            </div>
          </li>
        </ul>
      </div>
    </nav>
<div class="container">
