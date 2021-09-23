<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/session.php"); ?>
<?php
$message="";
$id=$_GET['id'];
$photothis=Photographs::find_by_id($id);
//$photos=Photographs::find_all();
//echo "<br/>hello<br/>";
//echo get_class($photothis);
//echo get_class($photos[1]);
//echo $photothis->filename;
//echo $id;
//echo $photo->id;
if($photothis->delete()){
    if(unlink("../images/{$photothis->filename}"))
    {
    $message="Photo Deleteed Successfully";
    }
}
else
{
    $message="Photo Deleteed faield";
}
$session->message($message);
goto("my_uploads.php");
?>
