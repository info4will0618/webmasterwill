<?php

class ValidateUser {

	protected $validator;

	public function __construct() {
		$this->validator = new UserValidation();
	}

	public function validate($email, $password, $confirm) {

		$boolean;

		$validEmail = $this->validator->validateEmail($email);
		$validPassword = $this->validator->validatePassword($password);

		if ($validEmail !== true) {
			$boolean = false;
			$_SESSION['errors']['email'] = "Please enter a valid email address, thank you!";
		}

		if ($password !== $confirm) {
			$boolean = false;
			$_SESSION['errors']['password'] = "Your passwords don't match!";
		} elseif($validPassword !== true) {
			$boolean = false;
			$_SESSION['errors']['password'] = $validPassword;
		} else {
			return;
		}

		if ($boolean === false) {
			return false;
		} else {
			return true;
		}
	}

	public function validateLogInInput($email, $password) {

		$boolean;

		$validEmail = $this->validator->validateEmail($email);
		$validPassword = $this->validator->validatePassword($password);

		if ($validEmail !== true || $validPassword !== true) {
			return false;
		}

	}

}