<?php 

namespace WebMasterWill\Application\Models;

use PDO;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Custom\UserValidation;
use WebMasterWill\Library\custom\mail\VerifyUserMail;
use WebMasterWill\Library\Core\Database\QueryBuilder;
use WebMasterWill\Library\Custom\Mail\PHPMailer;

class Signup {

	protected   $database,
				$validator,
				$mail;

	function __construct() {
        $this->validator = new UserValidation();
        $this->mail = new VerifyUserMail();
	}

	public function validate($firstName, $email, $password, $confirm) {

		$errors = [];

		$checkFirst = $this->validator->validateName($firstName);

		$checkEmail = $this->validator->validateEmail($email);

		$checkPass = $this->validator->validatePassword($password);

		$checkPassC = $this->validator->validatePassword($confirm);

		if ($checkFirst !== true) {
	    	$errors['first-name'] = $checkFirst;
	    } 
	    
	    if ($checkEmail !== true) {
	    	$errors['email'] = $checkEmail;
	    } 
	    if ($checkPass !== true) {
	    	$errors['password'] = $checkPass;
	    }
	    if ($checkPassC !== true) {
	    	$errors['confirm-password'] = $checkPassC;
	    }
	    if ($password !== $confirm) {
	    	$errors['mismatch'] = "Sorry the passwords need to match";
	    }

	    return $errors;
		
	}

	public function register($firstName, $email, $password, $code) {

		$password = password_hash($password, PASSWORD_DEFAULT);

		$data = [];

		try {

			$database = App::get('databaseConn');

			$sql = "INSERT INTO `user` 
				(first_name, email, password, verification_code) 
				VALUES 
				(:first_name, :email, :password, :verification_code)";
			
			$stmt = $database->prepare($sql);

			$stmt->bindParam(':first_name', $firstName);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':verification_code', $code);
			$stmt->execute();
			if ( $stmt ) {
				$data['id'] = $database->lastInsertId();
				$data['user_name'] = $firstName;
			}
		} catch(Exception $e) {
			$data['fail'] = $e->getMessage();
		}

		return $data;

	}

	public function emailUnique($email) {
		
		try {

			$database = App::get('databaseConn');

			$sql = "SELECT `email` FROM `user` 
					WHERE email = '{$email}'
					LIMIT 1";
			
			$stmt = $database->prepare($sql);

			$stmt->bindParam(':email', $email);

			$stmt->execute();

			$result = $stmt->fetch();

			if ( $result ) {
				return false;
			} else {
				return true;
			}

		} catch(Exception $e) {
			$data = [];
			$data['fail'] = $e->getMessage();
			return $data;
		}

	}

	public function sendVerificationMail($firstname, $email, $code, $id) {
		$this->mail->sendVerificationMail($firstname, $email, $code, $id);
		var_dump($id);
	}

	public function checkVerification($code, $id) {

			$db = App::get('databaseConn');
			$sql = "SELECT id, verified FROM `user` WHERE id = :id AND verification_code=:code LIMIT 1";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':code', $code);
 			$stmt->execute();
 			$row = $stmt->fetch(PDO::FETCH_ASSOC);
 			if($stmt->rowCount() > 0) {

 				if($row['verified']=='0') {
  				$verified = 1; 
  				$db = App::get('databaseConn');
   				$sql = "UPDATE `user` SET verified=:verified WHERE verification_code=:code";
   				$stmt = $db->prepare($sql);
   				$stmt->bindParam(':code', $code);
   				$stmt->bindParam(':verified', $verified);
   				$stmt->execute(); 
   
				   $message = "
							<div class='alert alert-success'>
								<button class='close' data-dismiss='alert'>&times;</button>
								<strong>WoW !</strong>  Your Account is Now Activated : <a href='index.php'>Login here</a>
							</div>
						"; 
  				} else {
  					 $message = "
						<div class='alert alert-error'>
							<button class='close' data-dismiss='alert'>&times;</button>
							<strong>sorry !</strong>  Your Account is allready Activated : <a href='index.php'>Login here</a>
						</div>";
						
				}
 			} 

 			else {
				$message = "
				<div class='alert alert-error'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
				</div>
				";
			} 
			return $message;
	}

		
		
}

