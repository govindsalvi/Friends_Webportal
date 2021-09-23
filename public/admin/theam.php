<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php
	$theme="";
	$theme=$_GET['theme'];
	if(!empty($theme))
	{
	
	//echo $theme;
	$user=User::find_by_id($_SESSION['user_id']);
	$user->theme=$theme;
	$_SESSION['theme']=$user->theme;
	$user->save();
	}
	
?>
<?php include("../layouts/adminheader.php"); ?>
<div id="main">
	<h2>Select theam</h2>
	<p><a href="theam.php?theme=main.css"><img width=200 height=200 style="border:1px solid #aaa;" src="themes/main.jpg"></a><br/>most wanted </p>
	<p><a href="theam.php?theme=public1.css"><img width=200 height=200 style="border:1px solid #aaa;" src="themes/public1.jpg"><br/><br/>light</p>		
</div>
<?php include("../layouts/adminfooter.php"); ?>
