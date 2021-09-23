<?php
require_once("PHPMailer/class.phpmailer.php");
require_once("PHPMailer/class.smtp.php");
require_once("PHPMailer/language/phpmailer.lang-es.php");

$to_name="govind";
$to="govindsalvi139@gmail.com";

$subject="mail test at".strftime("%T",time());

$message="this is my mail application";

$mail=new PHPMailer();


$mail->FromName="Govind";

$mail->From="gloriousgovind@gmail.com";

$mail->AddAddress($to,$to_name);

$mail->Subject=$subject;

$mail->Body=$message;

$result = $mail->Send();

echo $result?'sent':'failed';


?>