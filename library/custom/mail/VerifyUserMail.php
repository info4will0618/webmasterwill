<?php

namespace WebMasterWill\Library\Custom\Mail;

use WebMasterWill\Library\custom\mail\phpmailer;
use WebMasterWill\Library\custom\mail\smtp;

class VerifyUserMail {

	protected $mail;

	function __construct()
	{
		$this->mail = new phpmailer();
	}

	public function sendVerificationMail($firstname, $email, $code, $id) {

		$this->mail->SMTPDebug = 3;                           
 
		//Set PHPMailer to use SMTP.
		 
		$this->mail->isSMTP();        
		 
		//Set SMTP host name                      
		 
		$this->mail->Host = "smtp.gmail.com";
		 
		//Set this to true if SMTP host requires authentication to send email
		 
		$this->mail->SMTPAuth = true;                      
		 
		//Provide username and password
		 
		$this->mail->Username = "info4will0618@gmail.com";             
		 
		$this->mail->Password = "no1canbreakthispass";                       
		 
		//If SMTP requires TLS encryption then set it
		 
		$this->mail->SMTPSecure = "tls";                       
		 
		//Set TCP port to connect to
		 
		$this->mail->Port = 587;                    
		 
		$this->mail->From = "info4will0618@gmail.com";
		 
		$this->mail->FromName = "William Sanchez";
		 
		$this->mail->addAddress($email, $firstname);
		 
		$this->mail->isHTML(true);
		 
		$this->mail->Subject = "Verify Registration for webmasterwill.com";
		 
		$this->mail->Body = "     
						      Hello $firstname,
						      <br />
						      <br />
						      Welcome to WebMasterWill!<br/>
						      To complete your registration  please , just click following link<br/>
						      <br /><br />
						      <a href='webmasterwill/sign-up/approved?id=$id&code=$code'>Click HERE to Activate :)</a>
						      <br /><br />
						      Thanks,";
		 
		$this->mail->AltBody = "This is the plain text version of the email content";
		 
		if(!$this->mail->send())
		 
		{
		 
			echo "Mailer Error: " . $this->mail->ErrorInfo;
		 
		}
		 
		else
		 
		{
		 
			echo "Message has been sent successfully";
		 
		}
	}

}