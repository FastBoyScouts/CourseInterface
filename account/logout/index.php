<?php
session_start();
$_SESSION["security_token"] = "logged_out";
die(header("Location: /account/login?msg=logged_out"));
?>