<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/pagination.php"); ?>
<?php
    $current_page=empty($_GET['page'])?1:(int)$_GET['page'];
    $per_page=5;
    $total_count=Photographs::count_all_by_user($_SESSION['user_id']);
    //echo "hello".$total_count;
    $pagination = new Pagination($current_page,$per_page,$total_count);
    
    $sql="SELECT * FROM photographs WHERE user_id={$_SESSION['user_id']} LIMIT {$per_page} OFFSET {$pagination->offset()}";
    $photos=Photographs::find_by_sql($sql);
    //$r=strlen($photos);
    //echo Photographs::count_all();
  //  echo "<pre>";
    //print_r($photos);
    //echo "</pre>";
    //echo $photos[0]->filename;
?>
<?php include("../layouts/adminheader.php"); ?>
<div id="main">
    <div id="stories">
        <h2>All your uploads</h2>
    <?php echo $session->message(); ?>
    <?php foreach($photos as $photo): ?>    
        <div style="margin-left:20px; text-align:top;vertical-align:top;"><?php echo "<h5 style=\"color:blue;font-weight:bold;font-size:18;\">";?> Post at <?php echo datetime_to_text($photo->give_time()); ?></div>
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
    
    
    
    <?php /*
<!--<table>
    <tr>
        <th>image</th>
        <th>caption</th>
        <th>size</th>
    </tr>
    <?php foreach($photos as $photo): ?>
    <tr>
        <td><a href="photo.php?id=<?php echo $photo->id;?>"><img width=200 src="../images/<?php echo $photo->filename; ?>"></a></td>
        <td style="vertical-align:text-top;padding:1em;"><?php echo $photo->caption; ?></td>
        <td><?php echo $photo->sizetext();?></td>
        <td><a href="photo_delete.php?id=<?php echo $photo->id; ?>" onclick="return confirm('Are you sure?');">delete photo</a></td>
    </tr>
    <?php endforeach; ?>

        </table>
-->
          */?>

<br/>
<a href="photo_upload.php">Upload more Photos</a>    
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
