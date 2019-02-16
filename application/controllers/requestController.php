  <?php

class requestController extends Controller {    

	protected $dbHandler; 

    protected function init(){    
		$this->dbHandler = new DBHandler($this->dbCredentials);
		$this->db = $this->dbHandler->connect();
    }
	
	public function index(){
		$this->view->setTitle(
			"WebMasterWill | Request Web Services"
		);
		return $this->view();
	}
	
	public function sent(){

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request-sent'])) {

			// function localize_us_number($phone) {
			//  	$numbers_only = preg_replace("/[^\d]/", "", $phone);
			//   	return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
			// }

			// $this->_model->getUserRequest();

			$firstName = $_POST['first-name'];
			$lastName = $_POST['last-name'];
			$email = $_POST['email'];

			if (isset($_POST['phone-number']) && !empty($_POST['phone-number'])) {
				$phoneNumber = $_POST['phone-number'];
			} else {
				$phoneNumber = '000-000-0000';
			}

			$project_description = $_POST['project_description'];

			if (isset($_POST['budget']) && !empty($_POST['budget'])) {
				$budget = $_POST['budget'];
			} else {
				$budget = '00.00';
			}

			$timeFrame = $_POST['time-frame'];

			if (isset($_POST['special_features_list']) && !empty($_POST['special_features_list'])) {
				$specialFeatures = $_POST['special_features_list'];
			} else {
				$specialFeatures = [];
			}
			
			if ($timeFrame === "") {
				// $timeFrame = new DateTime();
				date_default_timezone_set("America/Los_Angeles");
				$timeFrame = date('Y-m-d G:i:s');
			}

			$firstName = MyHelpers::sanitize_input($firstName);
			$lastName = MyHelpers::sanitize_input($lastName);
			$email = MyHelpers::sanitize_input($email);
			$phoneNumber = MyHelpers::sanitize_input($phoneNumber);
			$project_description = MyHelpers::sanitize_input($project_description);
			$budget = MyHelpers::sanitize_input($budget);
			$timeFrame = MyHelpers::sanitize_input($timeFrame);

			$requestErrors = $this->_model->validateUserRequestInfo($firstName, $lastName, $email, $phoneNumber, $budget, $timeFrame);

			if (!empty($requestErrors)) {
				$_SESSION['requestErrors'] = $requestErrors;
				$_SESSION['first-name'] = $firstName;
				$_SESSION['last-name'] = $lastName;
				$_SESSION['email'] = $email;
				$_SESSION['phone-number'] = $phoneNumber;
				$_SESSION['project_description'] = $project_description;
				$_SESSION['budget'] = $budget;
				$_SESSION['time-frame'] = $timeFrame;
				$_SESSION['special_features_list'] = $specialFeatures;
				header('Location: ' . $this->cfg['site']['root'] . '/request');
			} else {
				$rowInserted = $this->_model->insertUserRequestInfo($firstName, $lastName, $email, $project_description, $phoneNumber, $budget, $timeFrame, $specialFeatures);

				if ($rowInserted > 0) {
					// $this->_model->sendRequestApprovedMail($firstName, $lastName, $email, $project_description, $phoneNumber, $budget, $timeFrame, $specialFeatures);
					// $this->_model->sendMeNotificationMail($firstName, $lastName, $email, $project_description, $phoneNumber, $budget, $timeFrame, $specialFeatures);
					$this->view->set('firstName', $firstName);
					$this->view->set('email', $email);
					$this->setViewPath(MyHelpers::UrlContent("~/views/request/request_success.php"));
					return $this->view();
				} else {
					echo "couldn't get the request.";
				}
			}
		}
	}
}