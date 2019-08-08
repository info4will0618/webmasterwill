<?php

namespace WebMasterWill\Application\Controllers;

use \DrewM\MailChimp\MailChimp;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Core\Controller;
use WebMasterWill\Library\Custom\Parsedown\Parsedown;

class SubscribeController extends Controller {   

	protected $parseDown;
	protected $list_id = '50e5b29e76';
	protected $api_key = '6d8f0a7ac7b0f124ea1e963a74ab94c7-us3';

	function __construct($model) {
		parent::__construct();
		$this->model = $model;	
		global $cfg;
        $this->cfg = $cfg;
	}


	public function subscribe() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {

			$_SESSION['subscribe-errors'] = array();

			$_SESSION['user-info'] = array();

			$this->model->setPostData($_POST['name'], $_POST['email']);

			$this->model->sanitizeUserInput();

			$_SESSION['subscribe-errors'] = $this->model->verifyUserInput();

			if (!empty($_SESSION['subscribe-errors'])) {

		    	$_SESSION['user-info']['name'] = $this->model->name;

				$_SESSION['user-info']['email'] =  $this->model->email;

				header('Location: ' . $this->cfg['site']['root'] . '/blog/#blog-subscriber_container');

			} else {

				$emailExists = $this->model->checkEmailIsUnique($_POST['email']);

				if ($emailExists === true) {

					$_SESSION['subscribe-errors']['user-exist'] = $this->model->email;

					header('Location: ' . $this->cfg['site']['root'] . '/blog/#blog-subscriber_container');

				} else {

					$verificationCode = md5(uniqid(rand()));

					$userInfo = $this->model->subscribeUser($verificationCode);

					$id = $userInfo['id'];

					$key = base64_encode($id);
					
					$id = $key;

					$this->model->sendVerificationEmail($this->model->name, $this->model->email, $id, $verificationCode);

					$this->model->sendMeSubscriberEmail($this->model->name, $this->model->email);

					$_SESSION['user-info']['name'] = $this->model->name;

					$_SESSION['user-info']['email'] = $this->model->email;

					return view('blog/subscribed', ['cfg' => $this->cfg]);

				}

			}

		} else {
			$_SESSION['subscribe-errors']['fail'] = "Sorry, couldn't process the subscribe form. Please try again or contact me if there are any concerns.";

			header('Location: ' . $this->cfg['site']['root'] . '/blog/#blog-subscriber_container');
		}

	}

	public function approveUser() {

		if(isset($_GET['code'])) {

			$code = $_GET['code'];

			$verifiedEmail = $this->model->verifyUserCode($code);

			if ($verifiedEmail && $verifiedEmail !== false) {

				$this->model->mailChimpSubscribe($verifiedEmail, $this->list_id, $this->api_key);

				$_SESSION['subscriber']['name'] = $this->model->name;

				$_SESSION['subscriber']['email'] = $this->model->email;

				return view('subscribe/verified', ['cfg' => $this->cfg]);

			} else {
				return view('parts/_404', ['cfg' => $this->cfg]);
			}

		} else {
			return view('parts/_404', ['cfg' => $this->cfg]);
		}

	}

	public function pop() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$errors = [];

			$this->model->setPostData($_POST['name'], $_POST['email']);

			$this->model->sanitizeUserInput();

			$errors = $this->model->verifyUserInput();

			if (!empty($errors)) {

				$emailExists = $this->model->checkEmailIsUnique();

				if ($emailExists === true) {

					return "Sorry but you have already signed up for subscription. Please verify email or if you believe this is not true contact me and I'll fix this as soon as possible!";

				}

				$verificationCode = md5(uniqid(rand()));

				$rowCount = $this->model->subscribePopUser($verificationCode);
				if ($rowCount > 0) {
					$this->model->sendVerificationEmail($this->model->name, $this->model->email, $id, $verificationCode);

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
	
}