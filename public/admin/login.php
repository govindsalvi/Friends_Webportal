<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php if($session->is_logedin()){goto("home.php");} ?>
<?php
    $message="";
    $message=$_SESSION['message'];
    if(isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $password=$_POST['password']; 
        $found_user=User::authonticate($username,$password);
        
        if($found_user)
        {
            //echo get_class($found_user);
            //echo "ello<br/>";
            //echo $found_user->username;
            $session->login($found_user);
            log_action("logged in","");
            //echo $session->user_id;
            //echo $session->username;
            //echo $session->profilepic;
            //echo $session->theme;
            //echo $session->username;
            //$session->user_id;
            goto("home.php");
        }
        else{
            $message="OOps Incorrect login,Check the capslock is on or off";
        }
    }
?>
<?php include("../layouts/header.php"); ?>
<div id="main">
<h1 style="color:blue">Enjoy the Photo uploding as make comment on </h1>
<div id=loginbox>
<form action="login.php" method="POST">
    <p style="color:blue;font-size:medium;font-weight:bold">Please give your login details</p>
    <p>Username <input type="text" name="username" /></p>
    <p>Password <input type="password" name="password" /></p>
    <p><input type="submit" name="submit" value="Login" /></p>
</form>
New to friends Don't worry
<h1><a href="new_account.php" style="text-decoration:none">Sign up</a><h1>
</div>
<p style="margin-left:35% "><?php echo $message; ?></p>
</div>
<?php include("../layouts/footer.php"); ?>
