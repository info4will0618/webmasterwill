<?php

class logInController extends Controller { 

	protected $validateUser;

	protected function init() {
		$this->validateUser = new ValidateUser();
		$this->db= new DBHandler($this->cfg['db']);
	}

	public function index() {

		$this->setViewPath(MyHelpers::UrlContent("~/views/auth/log_in.php"));

		return $this->view();

	}

	public function signIn() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sign-in'])) {

			$username = MyHelpers::sanitize_input($_POST['user-name']);
			$password = MyHelpers::sanitize_input($_POST['user-password']);

			$user = $this->_model->getUser($username);

			if (!empty($user) && (bool)$user['verified'] !== false) {

				if (password_verify($password, $user['password'])) {

					session_regenerate_id();
					$_SESSION['logged-in'] = true;
					$_SESSION['user'] = $user;
					unset($_SESSION['user']['password']);
					$this->setViewPath(MyHelpers::UrlContent("~/views/users/home.php"));
					return $this->view();

				} else {

					$_SESSION['user-name'] = $username;
					$_SESSION['login-error'] = "Either the username or password are incorrect, or the user does not exists. Also make sure you have verified the email for the account to make sure you are completely registered. Thank you!";
					header('Location: ' . $this->cfg['site']['root'] . '/login');

				}

			} else {
				$_SESSION['user-name'] = $username;
				$_SESSION['login-error'] = "Either the username or password are incorrect, or the user does not exists. Also make sure you have verified the email for the account to make sure you are completely registered. Thank you!";
				header('Location: ' . $this->cfg['site']['root'] . '/login');
			}

		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));
			return $this->view();
		}
	}

	public function signOut() {
		unset($_SESSION['user']);
		unset($_SESSION['logged-in']);
		$_SESSION['message'] = "You have successfully signed out.";
		header('Location: ' . $this->cfg['site']['root'] . '/login');
	}
}