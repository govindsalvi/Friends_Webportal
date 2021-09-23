<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php
//$photos=Photographs::find_all();
?>
<?php include("../layouts/adminheader.php"); ?>
<div id="main">
    <div id="myprofile">
    <span style="color:blue">Fullname:</span> Govind Salvi <span style="color:blue">From:</span> Udaipur <span style="color:blue">Current-city:</span> Jodhpur
        <h2>My Profile Info</h2>
    <?php echo $session->message(); ?>
    <img src="profilepic.jpg" width=100 height=100 style="float:left;" />
    <table style="margin-left:40%;margin-top:20%;" cellspacing=10 border=0 cellpadding=0>
      <tr><td>First name</td><td></td></tr>
      <tr><td>Last name</td><td></td></tr>
      <tr><td>From</td><td></td></tr>
      <tr><td>Current city</td><td></td></tr>
      <tr><td>School</td><td></td></tr>
      <tr><td>Works as</td><td></td></tr>
      <tr><td>Education</td><td></td></tr>  
    </table>
<br/>
<a href="" style="color:blue; text-decoration:none" ><h1>Edit my profile</h1></a>
</div>
<div id="profileinfo">
<?php profileinfo();?>
</div>
<?php include("../layouts/adminfooter.php"); ?>







<!--
