<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/coments.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/session.php"); ?>
<?php
$message="";
$id=$_GET['id'];
$comentthis=Coments::find_by_id($id);
//$photos=Photographs::find_all();
//echo "<br/>hello<br/>";
//echo get_class($photothis);
//echo get_class($photos[1]);
//echo $photothis->filename;
//echo $id;
//echo $photo->id;
//echo $comentthis->id;
if($comentthis->delete()){
    $message="Photo Deleteed Successfully";
}
else
{
    $message="Photo Deleteed faield";
}
$session->message($message);
//$url="photo.php?id=".echo $comentthis->photo_id;
//echo 
goto("photo.php?id={$comentthis->photo_id}");
?>
