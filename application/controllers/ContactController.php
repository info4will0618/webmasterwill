<?php

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Helpers;
use WebMasterWill\Library\Core\Controller;
use WebMasterWill\Library\Custom\Security\Captcha;



class ContactController {   

	protected $cfg,
			  $captcha;

	function __construct($model) {
		$this->model = $model;		

		global $cfg;

        $this->cfg = $cfg;

        $this->captcha = new Captcha();


	}

    public function index() {

    	$title = 'WebMasterWill Contact';

    	$string_length = 6;
		$permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$captcha_string = $this->captcha->generate_string($permitted_chars, $string_length);

    	$img = $this->captcha->generateImg($captcha_string);

    	$_SESSION['captcha_text'] = $captcha_string;

        return view('pages/contact', ['title' => $title, 'cfg' => $this->cfg, 'img' => $img]);

    }

	public function sent() {

		$title = "WebMasterWill | Contact | Success";

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact-sent'])) {

			$contactName = sanitize_input($_POST['name']);

			$email = sanitize_input($_POST['email']);

			if (isset($_POST['number']) && !empty($_POST['number'])) {
				$number = sanitize_input($_POST['number']);
			} else {
				$number = '000-000-0000';
			}

			$message = sanitize_input($_POST['message']);

			$captcha = $_POST['captcha_challenge'];

			$captchaIsGood = $this->model->checkCaptcha($captcha);

			if ($captchaIsGood === false) {
				$_SESSION['captcha-error'] = 'Captcha has to be right before you send a message';
			}

			$inputErrors = $this->model->validateUserInput($contactName, $email, $number);

			if (!empty($inputErrors)) {
				
				$_SESSION['inputErrors'] = $inputErrors;
				$_SESSION['input']['contactName'] = $contactName;
				$_SESSION['input']['email'] = $email;
				$_SESSION['input']['number'] = $number;
				$_SESSION['input']['message'] = $message;
				header('Location: ' . $this->cfg['site']['root'] . '/web-designer-los-angeles-contact#contact-form');

			} else {

				$rowInserted = $this->model->insertContact($contactName, $email, $number, $message);

				if ($rowInserted > 0) {

					$this->model->thankYouMail($contactName, $email, $message);
					$this->model->sendMeMail($contactName, $email, $message);

					if (empty($message)) {
						$message = 'no message written';
					}

					return view('contact/success', ['title' => $title, 'contactName' => $contactName, 'email' => $email, 'message' => $message, 'cfg' => $this->cfg]);

				} else {
					$_SESSION['inputErrors']['error'] = 'Sorry, can\'t send a message at the moment. Please contact my number or email and let me know about the problem, I will really appreciate it.';
					header('Location: ' . $this->cfg['site']['root'] . '/contact');
				}

			}

		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));
			return $this->view();
		}
	}
}