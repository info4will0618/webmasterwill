<?php

class adminAuthModel extends Model { 


	public function __construct() {
	}

	public function validateUserAndPass($user, $password) {
		switch ($user) {
			case 'William':
				$passwordIsLegit = ($password === "12345" ? true : false);
				return $passwordIsLegit;
				break;
			case 'Luke':
				$passwordIsLegit = ($password === "67890" ? true : false);
				return $passwordIsLegit;
				break;
			default:
				return false;
				break;
		}
	}
}