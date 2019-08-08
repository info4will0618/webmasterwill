<?php 

namespace WebMasterWill\Application\Models;

use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Custom\UserValidation;
use WebMasterWill\Library\Core\Database\QueryBuilder;


class Signin {

	protected $validator;

	function __construct() {
	    $this->validator = new UserValidation();
	}

	public function validate($email) {

		$checkEmail = $this->validator->validateEmail($email);

		if ($checkEmail !== true) {
	    	return "Hey, you forgot the @ symbol or something? Your email is not in the proper format. Please enter a proper email to continue. Thanks.";
	    } else {
	    	return null;
	    } 
	}

	public function checkIfUserExists($email) {
		try {

			$database = App::get('databaseConn');

			$sql = "SELECT * FROM user WHERE email='$email' LIMIT 1";

			$stmt = $database->prepare($sql);

			$stmt->bindParam(':email', $email);

			$stmt->execute();

			$num = $stmt->rowCount();

			if ( $num == 0) {
				return false;
			}

			$user = $stmt->fetch();

			return $user;

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
		}

	}

	public function checkIfUserEmailVerified($email) {
		try {

			$database = App::get('databaseConn');

			$sql = "SELECT verified FROM user WHERE email='$email' LIMIT 1";

			$stmt = $database->prepare($sql);

			$stmt->bindParam(':email', $email);

			$stmt->execute();

			$verified = $stmt->fetchColumn();

			return $verified;

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
		}

	}

	public function checkIfUserIsBanned($email) {
		try {

			$database = App::get('databaseConn');

			$sql = "SELECT status_id FROM user WHERE email='$email' LIMIT 1";

			$stmt = $database->prepare($sql);

			$stmt->bindParam(':email', $email);

			$stmt->execute();

			$status = $stmt->fetchColumn();

			return (bool)$status;

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
		}

	}


	public function signinUser($email, $password) {

 	// 	if ( isset($_SESSION['user'])!== "" ) {
		// 	header("Location: /custommvc2/");
		// 	exit;
		// }

		$errors = [];

		try {

			$database = App::get('databaseConn');

			$sql = "SELECT * FROM user WHERE email='$email' LIMIT 1";

			$stmt = $database->prepare($sql);

			$stmt->bindParam(':email', $email);

			$stmt->execute();

			$num = $stmt->rowCount();

			if ( $num == 0) {
				return false;
			}

			$user = $stmt->fetch();

			if ($password === $user['password']) {

				session_start();

				$_SESSION['user']['id'] = $user['id'];
				$_SESSION['user']['email'] = $user['email'];
		        $_SESSION['user']['name'] = $user['first_name'];
		        
		        // This is how we'll know the user is logged in
		        $_SESSION['user']['logged_in'] = true;

		        var_dump($_SESSION['user']);

		        return view('user/home');


			} else {
				$errors['user-error'] = '* Sorry, but the email or password you entered does not match *';
				return view('auth/login', ['errors' => $errors]);
			}

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
		}
	}
}

