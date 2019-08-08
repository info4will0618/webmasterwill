<?php 

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Controller;

class SigninController extends Controller {

	protected $cfg;

	function __construct($model) {

		$this->model = $model;

		global $cfg;

        $this->cfg = $cfg;
		
	}

	public function index() {

		$title = 'WebMasterWill Login';

		return view('auth/login', ['title' => $title, 'cfg' => $this->cfg]);
	}

	public function signin() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sign-in'])) {

			$email = $_POST['email'];
			$password = $_POST['password'];

			sanitize_input($email, $password);

			$error = $this->model->validate($email);

			if(!empty($error)) {
				$_SESSION['login-error'] = $error;
				return view('auth/login', ['cfg' => $this->cfg]);
			} 

			$user = $this->model->checkIfUserExists($email);

			if($user === false) {
				$_SESSION['login-error'] = 'Sorry, but the email you entered is not registered';
				return view('auth/login', ['cfg' => $this->cfg]);
			}

			$banned = (bool)$this->model->checkIfUserIsBanned($email);

			if ($banned === true) {
				$_SESSION['login-error'] = "You have been banned by an administrator. <a href=". $this->cfg['site']['root'] . "/web-designer-los-angeles-contact#contact-form>Contact me</a> if you believe there is something wrong with your account";

				return view('auth/login', ['cfg' => $this->cfg]);
			}

			$verified = (bool)$this->model->checkIfUserEmailVerified($email);


			if ($verified === false) {
				$_SESSION['login-error'] = 'Your email is registered but not verified. Please check your email to verify it, thank you.';
				return view('auth/login', ['cfg' => $this->cfg]);
			}

			$checkPass = password_verify($_POST['password'], $user['password']);

			if ($checkPass === false) {
				$_SESSION['login-error'] = 'Sorry, but your email or password is not correct';
				return view('auth/login', ['cfg' => $this->cfg]);
			}

			$_SESSION['user'] = $user;

			$_SESSION['user']['logged-in'] = true;

			return view('user/home', ['cfg' => $this->cfg]);

			
		} else {
			return view('parts/_404', ['cfg' => $this->cfg]);
		}
	}

	public function signout() {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		return view('pages/about', ['cfg' => $this->cfg]);

	}

}