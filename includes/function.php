<?php
define('MAIL_FROM_ADDRESS', 'riturajreso@gmail.com');
define('MAIL_FROM_NAME', 'Client services');
define('GUSER', 'burrelles.bang@gmail.com'); // Mail username
define('GPWD', 'burrelles@123'); 
include 'class.phpmailer.php';
include 'class.smtp.php';

	function sendEmail($to, $from, $fromName, $subject, $content){


		$toaddr = explode("," , $to);
		$error;
		$mail = new PHPMailer();  // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  // authentication enabled
		//$mail->Debugoutput ='html';
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->Username = GUSER;                 // SMTP username
		$mail->Password = GPWD; 
		$mail->IsHTML(true);         
		$mail->SetFrom($from, $fromName);//set fromname for email
		$mail->Subject = $subject;
		$mail->Body = html_entity_decode($content);
		
		foreach($toaddr as $ad){
			$mail->AddAddress(trim($ad));
		}

		if(!$mail->Send()) {
   			 return 0;
		} else {
   			return 1;
		}
	}
	