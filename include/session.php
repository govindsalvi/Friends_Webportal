<?php
class Session{
    private $logedin=false;
    public $user_id;
    public $username;
    public $profilepic;
    public $theme;
    public static $message="";
    function __construct()
    {
     session_start();
     $this->check_logedin();
     $this->check_message();
    }
    private function check_logedin()
    {
        if(isset($_SESSION['user_id']))
        {
            $this->user_id=$_SESSION['user_id'];
            $this->username=$_SESSION['username'];
            $this->profilepic=$_SESSION['profilepic'];
            $this->theme=$_SESSION['theme'];
            $this->logedin=true;
        }
        else{
            $this->logedin=false;
            unset($this->user_id);
        }
        
    }
private function check_message()
{
    if(isset($_SESSION['message'])){
        $this->message=$_SESSION['message'];
        unset($_SESSION['message']);
    }
    else{
        $this->message="";
    }
}
public function login($user){
	//$user->username;
        $this->user_id=$_SESSION['user_id']=$user->id;	
	$this->username=$_SESSION['username']=$user->username;
        $this->profilepic=$_SESSION['profilepic']=$user->profilepic;
        $this->theme=$_SESSION['theme']=$user->theme;
        $this->logedin=true;
}
public function getname()
{
return $this->username;
}
public function logout()
{
    unset($this->user_id);
    unset($_SESSION['user_id']);
    $this->logedin=false;
}
    
public function is_logedin(){
    return $this->logedin;
}        
public function message($msg="")
	{
        if(!empty($msg)){
            $this->message=$_SESSION['message']=$msg;
        }
        else
        {
            return $this->message;
        }
	}
}
$session = new Session();
//$session->message("hello session");
//echo $_SESSION['username'];
?>