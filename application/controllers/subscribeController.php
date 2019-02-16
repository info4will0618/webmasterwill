<?php

class subscribeController extends Controller {   

	protected $dbHandler;  

	protected function init() {
		$this->dbHandler = new DBHandler($this->dbCredentials);
		$this->db = $this->dbHandler->connect();
	}


	public function index() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {

			$_SESSION['subscribe-errors'] = array();

			$_SESSION['user-info'] = array();

			$this->_model->setPostData($_POST['name'], $_POST['email']);

			$this->_model->sanitizeUserInput();

			$_SESSION['subscribe-errors'] = $this->_model->verifyUserInput();

			if (!empty($_SESSION['subscribe-errors']['name']) || !empty($_SESSION['subscribe-errors']['email'])) {

		    	$_SESSION['user-info']['name'] = $this->_model->name;

				$_SESSION['user-info']['email'] =  $this->_model->email;

				header('Location: ' . $this->cfg['site']['root'] . '/blog/#blog-subscriber_container');

			} else {

				$emailExists = $this->_model->checkEmailIsUnique();

				if ($emailExists === true) {

					$_SESSION['subscribe-errors']['user-exist'] = $this->_model->email;

					header('Location: ' . $this->cfg['site']['root'] . '/blog/#blog-subscriber_container');

				} else {

					$verificationCode = md5(uniqid(rand()));

					$userInfo = $this->_model->subscribeUser($verificationCode);

					$id = $userInfo['id'];

					$key = base64_encode($id);
					
					$id = $key;

					$this->_model->sendVerificationEmail($this->_model->name, $this->_model->email, $id, $verificationCode);

					$this->_model->sendMeSubscriberEmail($this->_model->name, $this->_model->email);

					$_SESSION['user-info']['name'] = $this->_model->name;

					$_SESSION['user-info']['email'] = $this->_model->email;

					$this->setViewPath(MyHelpers::UrlContent("~/views/blog/subscribed.php"));

					$this->dbHandler->close();

					return $this->view();

				}

			}

		} else {
			$_SESSION['subscribe-errors']['fail'] = "Sorry, couldn't process the subscribe form. Please try again or contact me if there are any concerns.";

			header('Location: ' . $this->cfg['site']['root'] . '/blog/#blog-subscriber_container');
		}

	}

	public function pop() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$errors = [];

			$this->_model->setPostData($_POST['name'], $_POST['email']);

			$this->_model->sanitizeUserInput();

			$errors = $this->_model->verifyUserInput();

			if (!empty($errors)) {

				$emailExists = $this->_model->checkEmailIsUnique();

				if ($emailExists === true) {

					return "Sorry but you have already signed up for subscription. Please verify email or if you believe this is not true contact me and I'll fix this as soon as possible!";

				}

				$verificationCode = md5(uniqid(rand()));

				$rowCount = $this->_model->subscribePopUser($verificationCode);
				if ($rowCount > 0) {
					$this->_model->sendVerificationEmail($this->_model->name, $this->_model->email, $id, $verificationCode);

					return "";
				} else {
					return "Sorry but we couldn't process your subscribe request. Please contact me if there are any concerns and I'll make sure to fix this as soon as possible. Thank you.";
				}
			} 

		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));
			return $this->view();
		}


	}

	public function approveUser() {

		if(isset($_GET['code'])) {

			$code = $_GET['code'];

			$verified = $this->_model->verifyUserCode($code);

			if ($verified === true) {

				$_SESSION['subscriber']['name'] = $this->_model->name;

				$_SESSION['subscriber']['email'] = $this->_model->email;

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