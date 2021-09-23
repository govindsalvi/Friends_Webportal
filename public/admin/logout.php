<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php
$session->logout();
goto("login.php");

?>