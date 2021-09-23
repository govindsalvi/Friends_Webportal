<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/coments.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php
$id="";
if(isset($_GET['id'])){
    $id=(int)$_GET['id'];
    $photo=Photographs::find_by_id($id);
    $allcomments=Coments::find_by_photoid($id);
}
else{
    $session->message("No photograph id wos given");
    goto("index.php");
}
if(isset($_POST['submit'])){
    $newcomment=$database->work_on_slash(nl2br($_POST['newcomment']));
    //echo $comment;
    //echo $photo->id;
    $comment=Coments::create_comment($photo->id,$_SESSION['username'],$newcomment);
    if($comment->save())
    {
        $user=User::find_by_id($photo->user_id);
        log_action("comment on {$user->username}'s photo",$newcomment);
        goto("photo.php?id={$photo->id}");
    }
    
    
}
?>
<?php include("../layouts/adminheader.php"); ?>
<div id="main">
    <a href="home.php" >Back</a>
    <div id="photocomments">
    <p><img src="<?php echo "../images/{$photo->filename}";?>" height="auto" width=800 /></p>
    <h2><?php echo $photo->caption;?></h2>
    <?php foreach($allcomments as $com): ?>
    <?php $user=User::find_by_primary_key($com->author);?>
    <img style="float:left;padding-right:2em;" width=50 height=50 src="<?php echo $user->profilepic;?>"/>
    <div style="margin-left:75px;"><?php echo "<p><span style=\"color:blue;\">".$com->author." wrote.....</span> ";
    echo "<br/>".$com->body;
    echo "</br><span id=\"dateoncomment\" style=\"color:blue\">".datetime_to_text($com->created)."</span>"; ?>
    <?php
    if($com->author==$_SESSION['username']){
        echo "<a style=\"margin-left:50px;\" href=\"deletecoment.php?id={$com->id}\">Delete comment<a>";
    }
    
    ?>
    </p>
    </div>
    <?php endforeach;?>
    <form action="photo.php?id=<?php echo $photo->id;?>" method="POST">
        <p><img id="pic" width=50 height=50 src="profilepic.jpg" style="float:left;visibility:hidden;"/><textarea name="newcomment" cols=50 rows=2 style="margin-left:5px;" onfocus="showpic()"></textarea></p>
        <p><input type="submit" name="submit" value="comment" /></p>
    </from>
    </div>
</div>
<?php include("../layouts/adminfooter.php"); ?>
