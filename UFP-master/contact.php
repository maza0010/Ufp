<?php
error_reporting();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("mailer/class.phpmailer.php"); // this will include smtp and pop files.

if(isset($_POST['mail'])) {

   $email_to = "bonvanks@gmail.com";

   function died($error) {// your error code can go here
        echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
   }

   // validation expected data exists
   if(!isset($_POST['name']) || !isset($_POST['mail']) || !isset($_POST['message'])){
       died('We are sorry, but there appears to be a problem with the form you submitted.'); 
   }

   $name = $_POST['name']; // required
   $email_from = $_POST['mail']; // required
   $comments = $_POST['message']; // required

   $error_message = "";
   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
   if(!preg_match($email_exp,$email_from)) {
       $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
   }
   /*$string_exp = "/^[A-Za-z .'-]+$/";
   if(!preg_match($string_exp,$first_name)) {
      $error_message .= 'The First Name you entered does not appear to be valid.<br />';
   }  */ 
   if(strlen($comments) < 2) {
       $error_message .= 'The Comments you entered do not appear to be valid.<br />';
   }
   if(strlen($error_message) > 0) {
       died($error_message);
   }
   $email_message = "\n\n";

   $email_message .= "First Name: $name\n";
   $email_message .= "Email: $email_from\n"; //.clean_string($email_from)
   $email_message .= "Comments: $comments\n";

   
$mail=new PHPMailer();
$mail->CharSet = 'UTF-8';

$mail->IsSMTP();
$mail->Host       = 'mail.domain.com.mx';

$mail->SMTPSecure = 'tls';
$mail->Port       = 465;
$mail->SMTPDebug  = 1;
$mail->SMTPAuth   = true;

$mail->Username   = 'bonvanks@gmail.com';
$mail->Password   = 'bonvanks10';
$mail->AddReplyTo('bonvanks@gmail.com','site Admin');
$mail->Subject    = 'CONTACT '.$inputEmail;

   
   $mail = new PHPMailer();
   /*$mail->*/isSendmail();
   $mail->setFrom($email_from, $name);
   $mail->addAddress($email_to, 'admin fkibukila');
   $mail->MsgHTML($comments);
   

   if (!$mail->send()) { //send the message, check for errors
      echo "Mailer Error: " ;//. died($error);
   } else {
       echo 'success';
       header('Location: contact.php?result=success'); 
   }
?>

<!-- place your own success html below -->
<h1>Sent successfully</h1>

<?php
}
die();
?>
