<?php 

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Controller;

class UserController extends Controller {

	protected $cfg;

	function __construct($model) {

		$this->model = $model;

		global $cfg;

        $this->cfg = $cfg;
		
	}

	public function SignUp() {

		$title = 'WebMasterWill Login Form';

		return view('Auth/signup', ['title' => $title, 'cfg' => $this->cfg]);
	}


	function profile() {
		return view('users/profile');
	}

	function logout() {
		 session_start();

		 // if (!isset($_SESSION['user'])) {
		 // 	header("Location: index.php");
		 // } else if(isset($_SESSION['user'])!=="") {
		 // 	header("Location: home.php");
		 // }
		 
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		return view('auth/logout', 'cfg' => $this->cfg]);
		exit;
	}
}