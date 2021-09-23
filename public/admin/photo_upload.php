<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php
if(isset($_POST['submit']))
	{
        $msg="";
	$photo = new Photographs();
        $photo->caption=$_POST['caption'];
        //echo $photo->caption;
	$photo->attach_file($_FILES['file_upload']);
	if($photo->save())
        {
            $msg="successfull";
	    //log_action("Post a new photo ",$_POST['caption']);
            goto("my_uploads.php");
        }
        else{
            $msg=$photo->errors[0];
        }
	}
?>
<?php include("../layouts/adminheader.php"); ?>
<div id="main">
<?php echo $msg; ?>    
<form action="photo_upload.php" enctype="multipart/form-data" method="POST">
<p><input type="file" name="file_upload" /></p>
<p><input type="text" name="caption" /></p>
<p><input type="submit" name="submit" value="upload" /></p>
<form>
</div>
<?php include("../layouts/adminfooter.php"); ?>
