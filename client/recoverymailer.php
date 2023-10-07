<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



// require_once "Mail.php";
function mailer($recipient,$msg){
    $mail = new PHPMailer(true);
    
try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();										
	$mail->Host	 = 'smtp.gmail.com;';				
	$mail->SMTPAuth = true;							
	$mail->Username = 'myphpminorproject@gmail.com';				
	$mail->Password = 'mxmyzxcwpbfmzixh';					
	$mail->SMTPSecure = 'ssl';							
	$mail->Port	 = 465;

	$mail->setFrom('myphpminorproject@gmail.com');		
	$mail->addAddress($recipient);
	// $mail->addAddress('receiver2@gfg.com', 'Name');
	
	$mail->isHTML(true);								
	$mail->Subject = 'GECR Teacher Registration';
	$mail->Body = $msg;
	$mail->AltBody = 'This block is body content';
	$mail->send();
	echo "Mail has been sent successfully!";
    return true;
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
}



// require_once "Mail.php";
// function mailer($recipient,$msg){
// $from = '<your_user_name@gmail.com>';
// $to = '<'.$recipient.'>';
// $subject = 'Password Reset Key For '.$recipient;
// $body = $msg;
// $status = false; // initially set to false
// $headers = array(
//     'From' => $from,
//     'To' => $to,
//     'Subject' => $subject
// );

// $smtp = Mail::factory('smtp', array(
//         'host' => 'ssl://smtp.gmail.com',
//         'port' => '465',
//         'auth' => true,
//         'username' => 'your_user_name@gmail.com',
//         'password' => 'your_password'
//     ));

// $mail = $smtp->send($to, $headers, $body);

// if (PEAR::isError($mail)) {
//     $status = false;
// } else {
//     $status = true; // return true on succesful sending
// }
// return $status;
}
?>
