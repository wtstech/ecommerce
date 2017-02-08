<?php

namespace App\Helpers;

class Mail
{

    public static function send($emailAddress, $message, $subject, $fullname)
    {

	$message = self::emailHeader().$message.self::emailFooter();

		require __DIR__.'/../../includes/class.phpmailer.php';

		$mail = new \PHPMailer();
		
		if($_SERVER['HTTP_HOST'] == "localhost"){
		
		$mail->IsSMTP();
		
		}

		$mail->Encoding = "base64";
		$mail->CharSet = "UTF-8";
		$mail->SMTPAuth   = true;
		$mail->Host       = SMTP_HOST;
		$mail->Port       = 25;
		$mail->Username   = SMTP_USERNAME;
		$mail->Password   = SMTP_PASSWORD;
		$mail->SetFrom(SMTP_EMAIL, COMPANY_NAME);
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->AddAddress($emailAddress, ucwords($fullname));	
		$mail->Send();

    }


    public static function enquiry()
    {

	$message = "You have an enquiry.<br /><br />Name: ".$_POST['name']."<br />Phone: ".$_POST['phone']."<br />Email: ".$_POST['email']."<br />Message: ".$_POST['message'];
	self::send('info@newlobofish.co.uk', $message, 'Enquiry Form', COMPANY_NAME);
	return redirect( 'contact', 'Thank you, your enquiry has been sent' );

    }
    

    public static function newsletter()
    {

	$message = "You have a newsletter sign up.<br /><br />Email: ".$_POST['newsletter_email'];
	self::send('info@newlobofish.co.uk', $message, 'Newsletter Sign Up', COMPANY_NAME);
	return redirect( 'contact', 'Thank you, you have been added to our mailing list' );

    }


    public static function emailHeader()
    {

	return "<div style='width:700px;height:auto;'><div style='width:100%;float:left;margin-bottom:10px'><img title='".COMPANY_NAME."' alt='".COMPANY_NAME."' width='200' src='".DOMAIN."/images/logo.jpg'></div><div style='float:left;width:100%;height:3px; background:#009CD9;margin-bottom:20px'></div><br />";

    }


    public static function emailFooter()
    {

	return "<br /><br /><br /><br />Thanks<br /><br />".COMPANY_NAME." <br /><br /><div style='float:left;width:100%;height:3px; background:#009CD9;margin-top:20px'></div></div>";

    }


}
