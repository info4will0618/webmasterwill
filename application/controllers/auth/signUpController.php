<?php

class signUpController extends Controller { 

	protected $mailer;
	protected $registerUser;

	protected function init() {
		$this->db = new DBHandler($this->cfg['db']);
		$this->mailer = new NewUserMail();
		$this->registerUser = new ValidateUser();
	}

	public function index() {
		$this->setViewPath(MyHelpers::UrlContent("~/views/auth/sign_up.php"));
		return $this->view();
	}

	public function register() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sign-up'])) {

			$email = MyHelpers::sanitize_input($_POST['email']);
			$password = MyHelpers::sanitize_input($_POST['password']);
			$confirm = MyHelpers::sanitize_input($_POST['confirm']);

			$_SESSION['user']['email'] = $email;

			$boolean = $this->registerUser->validate($email, $password, $confirm);

			if ($boolean === false) {

				header('Location: ' . $this->cfg['site']['root'] . '/sign-up');
				
			} else {

				$userExist = $this->_model->checkIfUserExists($email);

				if ($userExist === true) {
					$_SESSION['errors']['email'] = "Sorry, but the email you have entered already registered. Please check your email to verify your account or click on forgot password to create a new password. Thank you.";
					header('Location: ' . $this->cfg['site']['root'] . '/sign-up');
				} else {
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
					$code = substr(md5(mt_rand()),0,15);
					$this->_model->registerUser($email, $hashedPassword, $code);
					echo "paused";
					exit;
					$this->mailer->sendWelcomeEmail($email, $code);
				}

			}

		}
	}

	public function approve() {

		if(isset($_GET['code'])) {

			$code = $_GET['code'];

			$verifiedEmail = $this->_model->verifyUserCode($code);

			if ($verifiedEmail !== false) {

				// $_SESSION['subscriber']['email'] = $verifiedEmail;

				var_dump($verifiedEmail);

				exit;

				$this->setViewPath(MyHelpers::UrlContent("~/views/subscribe/approved.php"));

				return $this->view();

			} else {
				$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));
				return $this->view();
			}

		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));
			return $this->view();
		}
	}


}