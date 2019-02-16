<?php

class NewUserMail {

	protected $phpMailer;

	public function __construct() {
		$this->phpMailer = new PHPMailer();
	}

	public function sendWelcomeEmail($email, $code) {

		$this->phpMailer->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		// $message = '<html><body>';
		// $message .= '<h1>Hello, fellow Web Master!</h1>';
		// $message .= '<p></p>'
		// $message .= '</body></html>';

		$this->phpMailer->IsSMTP();                                     
		$this->phpMailer->Host = 'smtp.gmail.com';              
		$this->phpMailer->Port = 587;                                    
		$this->phpMailer->SMTPAuth = true;                              
		$this->phpMailer->Username = 'info4will0618@gmail.com';             
		$this->phpMailer->Password = 'no1canbreakthispass';               
		$this->phpMailer->SMTPSecure = 'tls';                           

		$this->phpMailer->From = 'info4will0618@gmail.com';
		$this->phpMailer->FromName = 'WebMasterWill';
		$this->phpMailer->AddAddress($email);         

		$this->phpMailer->IsHTML(true);     

		$this->phpMailer->Subject = 'WebMasterWill Blog Subscription Email Verification';
		$this->phpMailer->Body    = '

			<h1>Hello, fellow WebMaster</h1>

			<p> Thanks for signing up to my WebMasterWill blog. Pretty soon you are going to be receiving awesome content and news about on my blog. You just need to verify this email address with the link below and you are on your way to become a more awesome business person/web developer. Once again thank you for signing up and I\'ll talk to you soon. 
			</p>'
			.
			'<a href="/localhost/webmasterwill/signup/approve?id=$id&code=$verificationCode"> Click HERE to Activate :) </a>'
			.
			'<p>
				If you have any questions or concerns my blog or I please feel free to message me back any time :).
			</p>

			<a href="www.william@webmasterwill.com">www.william@webmasterwill.com</p>

		';
		
		$this->phpMailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$this->phpMailer->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $this->phpMailer->ErrorInfo;
		}
		 
	}

	public function confirmUserCode() {

	}
}   