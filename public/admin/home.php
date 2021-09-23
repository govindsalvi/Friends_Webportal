<?php require_once("../../include/session.php");?>
<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php require_once("../../include/pagination.php"); ?>
<?php
    $current_page=empty($_GET['page'])?1:(int)$_GET['page'];
    $per_page=5;
    $total_count=Photographs::count_all();
    //echo "hello".$total_count;
    $pagination = new Pagination($current_page,$per_page,$total_count);
    
    $sql="SELECT * FROM photographs LIMIT {$per_page} OFFSET {$pagination->offset()}";
    $photos=Photographs::find_by_sql($sql);
    //$photos=Photographs::find_all();
    
    //$users=User::find_all();
?>
<?php include("../layouts/adminheader.php"); ?>
<div id="main">
    <div id="stories">
    <span style="color:blue">Fullname:</span><?php echo $session->username; ?> Salvi <span style="color:blue">From:</span> Udaipur <span style="color:blue">Current-city:</span> Jodhpur
        <h2>All current stories</h2>
    <?php echo $session->message(); ?>
    
    <?php foreach($photos as $photo): ?>
        
        <?php $user=User::find_by_id($photo->user_id);?>    
        <div style="margin-left:20px; text-align:top;vertical-align:top;"><img style="padding-right:2em; float:left;" width=50 height=50 src="profilepics/<?php echo $user->profilepic;?>"/><?php echo "<h5 style=\"color:blue;font-weight:bold;font-size:18;\">".$user->username."</h5>";?> Post at <?php echo datetime_to_text($photo->give_time()); ?></div>
        <br/>
      <div style="margin-left:70px;padding-bottom:2em;"><a href="photo.php?id=<?php echo $photo->id; ?>"><img width=200 src="../images/<?php echo $photo->filename; ?>"></a>
      <br/>
        <?php //echo $photo->filename; ?>
        <?php echo "<h3 style=\"color:blue;\">".$photo->caption."</h3>"; ?>
         <span style="color:blue;text-decoration:none;"><a href="photo.php?id=<?php echo $photo->id;?>" style="text-decoration:none;">view or create comments</a><?php echo "<b> total comments ".count($photo->allcomment())."</b>"; ?></span>
        </div>
        <?php //echo $photo->type; ?>
        <?php //echo $photo->sizetext();?>
    <?php endforeach; ?>
<br/>
    <?php
    //echo $pagination->total_pages();
    if($pagination->total_pages()>1){
        
    if($pagination->has_privious_page()){
        //echo "hello";
        echo "<span style=\"color:red;font-weight:bold;\"><a href=\"home.php?page={$pagination->privious_page()}\">Previous</a></span>";
        //echo $pagination->next_page();
        //echo "\">"Next Page</a>;
        }
    if($pagination->has_next_page()){
        //echo "hello";
        echo "  <a href=\"home.php?page={$pagination->next_page()}\">Next</a><br/>";
        //echo $pagination->next_page();
        //echo "\">"Next Page</a>;
        }
    }
    ?>
<!--<a href="photo_upload.php" >Upload more Photos</a>-->
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
