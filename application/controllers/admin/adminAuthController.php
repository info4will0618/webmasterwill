<?php

class adminAuthController extends Controller { 

	protected $validateInput;

	protected function init() {
		$this->validateInput = new UserValidation();
	}

	public function index(){
		$this->setViewPath(MyHelpers::UrlContent("~/views/admin/log_in.php"));
		return $this->view();
	}

	public function logIn() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {

			$user = MyHelpers::sanitize_input($_POST['admin_name']);
			$password = MyHelpers::sanitize_input($_POST['admin_password']);

			$_SESSION['login-error'] = ($this->validateInput->validateName($user) ? false : "true");

			$isAdmin = $this->_model->validateUserAndPass($user, $password);

			if ($isAdmin === true && $_SESSION['login-error'] === false) {

				unset($_SESSION['login-error']);

				session_regenerate_id();

				$_SESSION['loggedin'] = true;
				
				$this->setViewPath(MyHelpers::UrlContent("~/views/admin/controls.php"));

				return $this->view();

			} else {
				header('Location: ' . $this->cfg['site']['root'] . '/admin/log_in.php');
				$_SESSION['user-name'] = $user;
				$_SESSION['login-error'] = "Invalid user or password";
			}

		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_forbidden.php"));
			return $this->view();
		}
	}

	public function logOut() {
		
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
			
			unset($_SESSION['loggedin']);

			$this->setViewPath(MyHelpers::UrlContent("~/views/admin/logged_out.php"));

			return $this->view();

		
		} else {
			echo "Invalid user or password";
		}
	}


}