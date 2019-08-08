<?php 

namespace WebMasterWill\Application\Models;

use PDO;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Custom\UserValidation;
use WebMasterWill\Library\custom\mail\VerifyUserMail;
use WebMasterWill\Library\Core\Database\QueryBuilder;
use WebMasterWill\Library\Custom\Mail\PHPMailer;

class Subscribe {


	public  $name,
			$email,
			$Validator,
			$Mail;

	function __construct() {
		$this->db = App::get('databaseConn');
		$this->Validator = new UserValidation();
		$this->Mail = new PHPMailer();
	}

	public function setPostData($name, $email) {

			$this->name = $name;

			$this->email = $email;

	}

	public function sanitizeUserInput() {

		$this->name = sanitize_input($this->name);

		$this->email = sanitize_input($this->email);

	}

	public function verifyUserInput() {

		$validated = [];

		$validated['name'] = $this->Validator->validateName($this->name);

		$validated['email'] = $this->Validator->validateEmail($this->email);

		if (!empty($validated['name'] && !empty(['email']))) {
	    	return $validated;
	    } else {
	    	return null;
	    }
	}

	public function checkEmailIsUnique($email) {

		try {

			$query = "

				SELECT blog_subscriber.email AS email

				FROM blog_subscriber

				WHERE blog_subscriber.email = :email

				LIMIT 1
		
			";

			$result = $this->db->prepare($query);

			$result->bindParam(':email', $email);

	        $result->execute();

	        $result->setFetchMode(PDO::FETCH_ASSOC);
			
	        $result->fetch();

	        $exists = $result->rowCount();

			if ($exists > 0) {
				return true;
			} else {
				return false;
			}


		} catch(Exception $e) {
			$data['failed'] = $e->getMessage();
			echo $e;
		}

	}

	public function subscribeUser($code) {

		$data = [];

		try {

			$query= "

			INSERT INTO `blog_subscriber` 
				(name, email, verification_code) 
			VALUES 
				(:name, :email, :verification_code)
			";
			
			$stmt = $this->db->prepare($query);

			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':verification_code', $code);

			$stmt->execute();

			if ( $stmt ) {
				$data['id'] = $this->db->lastInsertId();
				$data['name'] = $this->name;
				return $data;
			}

		} catch(Exception $e) {
			$data['failed'] = $e->getMessage();
			echo $e;
		}
	}

	public function subscribePopUser($code) {

		try {

			$query = "

			INSERT INTO `blog_subscriber` 
				(name, email, verification_code) 
			VALUES 
				(:name, :email, :verification_code)

			";
			
			$stmt = $this->db->prepare($query);

			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':verification_code', $code);

			$stmt->execute();

			$success = $stmt->rowCount();

			return $success;

		} catch(Exception $e) {
			$data['failed'] = $e->getMessage();
			return $e;
		}
	}

	// public function mailChimpPending($email, $list_id, $api_key) {
	// 	$data_center = substr($api_key, strpos($api_key,'-')+1);
		 
	// 	$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';
		 
	// 	$json = json_encode([
	// 	    'email_address' => $email,
	// 	    'status'        => 'pending', //pass 'subscribed' or 'pending'
	// 	]);
		 
	// 	$ch = curl_init($url);
	// 	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	// 	curl_setopt($ch, CURLOPT_POST, 1);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	// 	$result = curl_exec($ch);
	// 	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	// 	curl_close($ch);
	// 	var_dump($status_code);
	// }

		public function mailChimpSubscribe($email, $list_id, $api_key) {
			$data_center = substr($api_key, strpos($api_key,'-')+1);
			 
			$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';
			 
			$json = json_encode([
			    'email_address' => $email,
			    'status'        => 'subscribed', //pass 'subscribed' or 'pending'
			]);
			 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			$result = curl_exec($ch);
			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			var_dump($status_code);
	}

	public function sendVerificationEmail($name, $email, $id, $verificationCode) {

		$this->Mail->SMTPOptions = array(
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

		$this->Mail->Subject = 'WebMasterWill Blog Subscription Email Verification';
		$this->Mail->Body    = '

			<h1>Hello, fellow WebMaster '.$name.'</h1>

			<p> Thanks for signing up to my WebMasterWill blog. Pretty soon you are going to be receiving awesome content and news about on my blog. You just need to verify this email address with the link below and you are on your way to become a more awesome business person/web developer. Once again thank you for signing up and I\'ll talk to you soon. 
			</p>'
			.
			'<a href="/localhost/webmasterwill/subscribe/approve-user/?id='.$id.'&code='.$verificationCode.'"> Click HERE to Activate :) </a>'
			.
			'<p>
				If you have any questions or concerns my blog or I please feel free to message me back any time :).
			</p>

			<a href="www.william@webmasterwill.com">www.william@webmasterwill.com</a>

		';
		
		$this->Mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$this->Mail->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $this->Mail->ErrorInfo;
		   exit;
		}		

	}

	public function sendMeSubscriberEmail($name, $email) {

		$this->Mail->SMTPOptions = array(
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

		$this->Mail->IsSMTP();                                     
		$this->Mail->Host = 'smtp.gmail.com';              
		$this->Mail->Port = 587;                                    
		$this->Mail->SMTPAuth = true;                              
		$this->Mail->Username = 'info4will0618@gmail.com';             
		$this->Mail->Password = 'no1canbreakthispass';               
		$this->Mail->SMTPSecure = 'tls';                           

		$this->Mail->From = 'info4will0618@gmail.com';
		$this->Mail->FromName = 'WebMasterWill';
		$this->Mail->AddAddress('info4will0618@gmail.com', 'William');         

		$this->Mail->IsHTML(true);     

		$this->Mail->Subject = 'You have a new subscriber';
		$this->Mail->Body    = '

			Name of subscriber: '. $name .'
			Subsciber Email: '. $email .'
		';
		$this->Mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$this->Mail->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $this->Mail->ErrorInfo;
		   exit;
		}		

	}

	public function verifyUserCode($code) {

	try {

		$query = "	
			SELECT * FROM blog_subscriber
  			WHERE verification_code = :verification_code	
  			LIMIT 1
  		";
			
		$stmt = $this->db->prepare($query);

		$stmt->execute(
		  array(
		   	':verification_code' => $code
		  )
		 );

		$stmt->execute();

		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$num_of_rows = $stmt->rowCount();

		$row = $stmt->fetch();

		if ((int)$row['verified'] == 0) {

			$update_email = "
		    	UPDATE blog_subscriber 
		    	SET verified = 1
		    	WHERE verification_code = '".$row['verification_code']."'
		    ";

		    $updated = $this->db->prepare($update_email);

		    $updated->execute();


		    if ($updated->rowCount() > 0) {

		    	return $row['email'];

		    } else {

		    	return false;

		    }

		} elseif((int)$row['verified'] == 1) {
			return $row['email'];
		} else {
			return false;
		}

	} catch(Exception $e) {
		$data['failed'] = $e->getMessage();
		echo $e;
	}

	}


}