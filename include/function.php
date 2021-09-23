<?php require_once("session.php");?>
<?php
function goto($location)
{
header("Location: {$location}");
exit;
}
function datetime_to_text($datetime){
    $datetime_formeted=strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p",$datetime_formeted);
}
function log_action($action,$message){
    
    $logfile="logs/{$_SESSION['username']}.txt";
    
    if($handle=fopen($logfile,'a')){
        
        $timestamp=strftime("%Y-%m-%d %H:%M:%S",time());
        $time_as_text=datetime_to_text($timestamp);
        $content="{$action}:      {$message}| \t on {$time_as_text}\n";
        
        fwrite($handle,$content);
        
        fclose($handle);
    }
    else
    {
        //echo "";
    }
    
}

function show_time()
{
    $timestamp=strftime("%Y-%m-%d %H:%M:%S",time());
    $time_as_text=datetime_to_text($timestamp);
    return $time_as_text;
}

function profileinfo()
{
    //echo $_SESSION['profilepic'];
    $pic="profilepics/".$_SESSION['profilepic'];
    echo "<img id=\"profilepic\" src=\"".$pic."\" width=150 height=150 onmouseover=\"changepic();\" /><a id=\"changepiclink\" href=\"\" style=\"text-decoration:blink;visibility:hidden;\">change</a>";    
    echo "<a href=\"myprofile.php\"><h4 style=\"color:blue\">My Profile</h4></a>";
    echo "<a href=\"my_uploads.php\"><h4 style=\"color:blue;\">My Uploads<h4></a>";
    echo "<a href=\"logfile.php\"><h4 style=\"color:blue;\">View History<h4></a>";
}
//log_action("","");
?>
