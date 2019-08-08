<?php

namespace WebMasterWill\Application\Models;

use PDO;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Core\Database\QueryBuilder;
use WebMasterWill\Library\Custom\UserValidation;
use WebMasterWill\Library\Custom\Mail\PHPMailer;

class Contact {

	protected $db,
			  $Mail,
			  $ValidateUserRequestClass;
	
	function __construct()
	{
		$this->db = App::get('databaseConn');
		$this->ValidateUserRequestClass = new UserValidation();
		$this->Mail = new PHPMailer();
	}

	public function validateUserInput($name, $email, $number) {

		$inputErrors = [];

		$errorName = $this->ValidateUserRequestClass->validateName($name);
		$errorEmail = $this->ValidateUserRequestClass->validateEmail($email);
		$errorNumber = $this->ValidateUserRequestClass->validatePhoneNumber($number);

		if ($errorName !== null) {
			$inputErrors['name'] = $errorName;
		} 
		
		if ($errorEmail !== null) {
			$inputErrors['email'] = $errorEmail;
		}

		if ($errorNumber !== null) {
			$inputErrors['phone-number'] = $errorPhoneNumber;
		}

		if (!empty($inputErrors)) {
			return $inputErrors;
		} else {
			return null;
		}
	}

	public function insertContact($name, $email, $number, $message) {

		$data = [];

		try {

			$query= "

				INSERT INTO `contact` 
					(name, email, number, message) 
				VALUES 
					(:name, :email, :number, :message)
			";
			
			$stmt = $this->db->prepare($query);

			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':number', $number);
			$stmt->bindParam(':message', $message);

			$stmt->execute();

			if ( $stmt ) {
				$rowCount = $stmt->rowCount();
				return $rowCount;
			} else {
				echo "no row inseted";
			}

		} catch(Exception $e) {
			$data['failed'] = $e->getMessage();
			echo $e;
		}

	}


	public function thankYouMail($name, $email, $message) {

		$this->Mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		if ($message) {
			$message = $message;
		} else {
			$message = 'no message';
		}

		// $message = '<html><body>';
		// $message .= '<h1>Hello, fellow Web Master!</h1>';
		// $message .= '<p></p>'
		// $message .= '</body></html>';

		$this->Mail->IsSMTP();                                     
		$this->Mail->Host = 'smtp.gmail.com';              
		$this->Mail->Port = 587;                                    
		$this->Mail->SMTPAuth = true;                              
		$this->Mail->Username = 'info4will0618@gmail.com';             
		$this->Mail->Password = 'no1canbreakthispass';               
		$this->Mail->SMTPSecure = 'tls';                           

		$this->Mail->From = 'info4will0618@gmail.com';
		$this->Mail->FromName = 'WebMasterWill';
		$this->Mail->AddAddress($email, $name);         

		$this->Mail->IsHTML(true);     

		$this->Mail->Subject = 'Thank you '.$name.' for contacting me!';
		$this->Mail->Body    = '

			<h1>I got your message '.$name.'</h1>

			<p> 
				I can\'t wait to talk to you. I will reply as soon as I can. I will most likely send you a short little message or call so we can set up a good time to talk. 
			</p>
			<p> 
				For now, check out the information you sent me. If you don\'t think it is correct or you want to say something more, please send me another message. I will gladly respond to your most recent message. Thank you very much. Talk to you soon.
			</p>

			<h2>The info you send me:</h2>

			<p>
				'.$name.'
			</p>
			<p>
				'.$email.'
			</p>
			<p>
				'.$message.'
			</p>
		';
		
		$this->Mail->AltBody = 'Thank you.';

		if(!$this->Mail->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $this->Mail->ErrorInfo;
		   exit;
		}
	}

	public function sendMeMail($name, $email, $message) {
		$this->Mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		if ($message) {
			$message = $message;
		} else {
			$message = 'no message';
		}

		// $message = '<html><body>';
		// $message .= '<h1>Hello, fellow Web Master!</h1>';
		// $message .= '<p></p>'
		// $message .= '</body></html>';

		$this->Mail->IsSMTP();                                     
		$this->Mail->Host = 'smtp.gmail.com';              
		$this->Mail->Port = 587;                                    
		$this->Mail->SMTPAuth = true;                              
		$this->Mail->Username = 'info4will0618@gmail.com';             
		$this->Mail->Password = 'no1canbreakthispass';               
		$this->Mail->SMTPSecure = 'tls';                           

		$this->Mail->From = 'info4will0618@gmail.com';
		$this->Mail->FromName = 'WebMasterWill';
		$this->Mail->AddAddress('info4will0618@gmail.com', 'webmasterwill contact request');         

		$this->Mail->IsHTML(true);     

		$this->Mail->Subject = 'You have a new contact request from'.$name.
		$this->Mail->Body    = '

			<h1>Your have a new contact request message!</h1>

			<h2>Here is their information:</h2>

			<p>
				'.$name.'
			</p>
			<p>
				'.$email.'
			</p>
			<p>
				'.$message.'
			</p>
		';
		
		$this->Mail->AltBody = 'You have a new contact request message';

		if(!$this->Mail->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $this->Mail->ErrorInfo;
		   exit;
		}
	}

	function checkCaptcha($captcha) {
		if (empty($captcha)) {
			return false;
		} else {
			if ($_SESSION['captcha_text'] !== $captcha) {
				var_dump($captcha);
				return false;
			} else {
				return true;
			}
		}
	}
}