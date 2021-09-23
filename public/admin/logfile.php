<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/coments.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php
$logfile="logs/{$_SESSION[username]}.txt";
//echo $_GET['clear'];
if($_GET['clear']=='true'){
    
    //echo $_GET['clear'];
    file_put_contents($logfile,'');
    
    log_action("History cleared by you ","");
    
    goto("logfile.php");
}
?>
<?php include("../layouts/adminheader.php"); ?>
<div id="main">
<div id="stories">
    <h2>Your History</h2>
    <p><a href="logfile.php?clear=true" onclick="confirm('are u sure')">Clear History</a><p>
    <?php

    if($handle=fopen($logfile,'r')){
    echo "<ul class=\"logentry\">";
    while(!feof($handle)){
        $entry=fgets($handle);
        if(trim($entry)!="")
        echo "<li>{$entry}</li>";
    }
    echo "</ul>";
}
else
{
    
}
?>
</div>
<div id="profileinfo">
    <?php profileinfo();?>
<!--
<img id="profilepic" src="<?php echo $session->profilepic; ?>" width=150 height=150 onmouseover="changepic();" /><a id="changepiclink" href="" style="text-decoration:blink;visibility:hidden;">change</a>
    
<a href="myprofile.php"><h4 style="color:blue">My Profile</h4></a>
<a href="my_uploads.php"><h4 style="color:blue;">My Uploads<h4></a>
<a href="logfile.php"><h4 style="color:blue;">View History<h4></a>
    -->
</div>
</div>
<?php include("../layouts/adminfooter.php"); ?>
