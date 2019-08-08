<?php 

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Controller;

class SignupController extends Controller {

	protected $cfg;

	function __construct($model) {

		$this->model = $model;

		global $cfg;

        $this->cfg = $cfg;
		
	}

	public function index() {

		$title = 'WebMasterWill Login Form';

		return view('auth/signup', ['title' => $title, 'cfg' => $this->cfg]);

	}

	public function success() {
		if ( isset( $_SESSION['user']) !== "" ) {
	  		header("Location: home.php");
	  		exit;
		}
	}

	public function register() {


		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sign-up'])) {

			$firstName = $_POST['first-name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirm = $_POST['confirm'];

			sanitize_input($firstName, $email, $password, $confirm);

			$_SESSION['errors'] = $this->model->validate($firstName, $email, $password, $confirm);

			var_dump($_SESSION['errors']);

			if(!empty($_SESSION['errors'])) {

				return view('auth/signup', ['cfg' => $this->cfg]);
			} 

			$emailUnique = $this->model->emailUnique($email);


			if( $emailUnique === true) {

				$code = md5(uniqid(rand()));

				$data = $this->model->register($firstName, $email, $password, $code);

				$id = $data['id'];
				var_dump($id);
				$key = base64_encode($id);
				$id = $key;

				// $this->model->sendVerificationMail($firstName, $email, $code, $id);

				$title = 'WebMasterWill Website Authentication';

				return view('auth/success', ['title' => $title, 'data' => $data, 'cfg' => $this->cfg]); 

			} else {

				$_SESSION['errors']['email'] = "Sorry, but email is taken";
				
				return view('auth/signup', ['cfg' => $this->cfg]); 
			}

		} else {
			return view('parts/_404', ['cfg' => $this->cfg]);
		}

	}

	public function approveAccount() {

		if (isset($_GET['code']) && isset($_GET['id'])) {
			$code = $_GET['code'];

			$id = base64_decode($_GET['id']);

	        $message = $this->model->checkVerification($code, $id); 

	        var_dump($message);

	        exit;
	        
	        return view('auth/approved');

		} else {
			return view('parts/_404', ['cfg' => $this->cfg]);
		}

		
    }

}