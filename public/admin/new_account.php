<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/config.php"); ?>
<?php require_once("../../include/photographs.php"); ?>
<?php require_once("../../include/function.php"); ?>
<?php require_once("../../include/database.php"); ?>
<?php require_once("../../include/user.php"); ?>
<?php
    if(isset($_POST['submit']))
    {
        $user=new User();
        $username=$_POST['username'];
        $password=$_POST['password'];
        $user->username=$username;
        $user->password=$password;
        if($user->save())
        {
            $_SESSION['message']="User created";
            goto("login.php");
        }
        else{
            $_SESSION['message']="User can't be created";
            goto("login.php");
        }
    }
?>
<?php include("../layouts/header.php"); ?>
<div id="main">
<h1 style="color:blue">Please give us the following details and you'll be the part of friends </h1>
<div id="newaccount">
    <form action="new_account.php" method="POST">
        <table border="none" cellpadding=5 cellspacing=5 style="border:hidden">
        <tr>
        <td>Enter a Username for you</td><td><input type="text" name="username" /></td>
        </tr>
        <tr>
        <td>Enter a Password for you</td><td><input type="password" name="password" /></td>
        </tr>
        <tr>
        <td>Confirm Password </td><td><input type="password" name="password" /></td>
        </tr>
        <tr>
        <td><input type="submit" name="submit" value="Make me a part of friends" /></td>
        </tr>
        </table>
    </form>
</div>
</div>
<?php include("../layouts/footer.php"); ?>
