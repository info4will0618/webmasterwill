<?php
class requestModel extends Model {

	protected $ValidateUserRequestClass;
	protected $Mail;

	public function __construct($db) {
		$this->ValidateUserRequestClass = new RequestValidation();
		$this->Mail = new PHPMailer();
		$this->db = $db;
	}	

	public function validateUserRequestInfo($firstName, $lastName, $email, $phoneNumber, $budget, $timeFrame) {

		$requestErrors = [];

		$errorFirstName = $this->ValidateUserRequestClass->validateName($firstName);
		$errorLastName = $this->ValidateUserRequestClass->validateName($lastName);
		$errorEmail = $this->ValidateUserRequestClass->validateEmail($email);
		$errorPhoneNumber = $this->ValidateUserRequestClass->validatePhoneNumber($phoneNumber);
		$errorBudget = $this->ValidateUserRequestClass->validateBudget($budget);
		$errorTimeFrame = $this->ValidateUserRequestClass->validateDate($timeFrame);

		if ($errorFirstName !== true) {
			$requestErrors['first-name'] = $errorFirstName;
		} 

		if ($errorLastName !== true) {
			$requestErrors['last-name'] = $errorLastName;
		}
		
		if ($errorEmail !== true) {
			$requestErrors['email'] = $errorEmail;
		}

		if ($errorPhoneNumber !== true) {
			$requestErrors['phone-number'] = $errorPhoneNumber;
		}

		if ($errorBudget !== true) {
			$requestErrors['budget'] = $errorBudget;
		}

		if ($errorBudget !== true) {
			$requestErrors['budget'] = $errorBudget;
		}

		if ($errorTimeFrame !== true) {
			$requestErrors['time-frame'] = $errorTimeFrame;
		}

		if (!empty($requestErrors)) {
			return $requestErrors;
		} else {
			return null;
		}
	}

	public function insertUserRequestInfo($firstName, $lastName, $email, $project_description, $phoneNumber, $budget, $timeFrame, $arr) {

		try {

		$specialFeatures = implode(', ', $arr);

		$sql = "INSERT INTO website_request
				(first_name, last_name, email, project_description, phone_number, budget, expected_duration, special_features) 
				VALUES 
				(:first_name, :last_name, :email, :project_description, :phone_number, :budget, :expected_duration, :special_features)";

			
			$stmt = $this->db->prepare($sql);

			$stmt->bindParam(':first_name', $firstName);
			$stmt->bindParam(':last_name', $lastName);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':project_description', $project_description);
			$stmt->bindParam(':phone_number', $phoneNumber);
			$stmt->bindParam(':budget', $budget);
			$stmt->bindParam(':expected_duration', $timeFrame);
			$stmt->bindParam(':special_features', $specialFeatures);
			$stmt->execute();

			$rowCount = $stmt->rowCount();

			return $rowCount;

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
			echo $e;
		}
		
		
	}

	public function sendRequestApprovedMail($firstName, $lastName, $email, $project_description, $phoneNumber, $budget, $timeFrame, $specialFeatures) {



		if ($budget = "00.00") {
			$budget = "No budget specified.";
		}

		$timeFrame = date('F/j/Y', strtotime($timeFrame));


		$this->Mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);


		$this->Mail->IsSMTP();                                      // Set mailer to use SMTP
		$this->Mail->Host = 'smtp.gmail.com';               // Specify main and backup server
		$this->Mail->Port = 587;                                    // Set the SMTP port
		$this->Mail->SMTPAuth = false;                               // Enable SMTP authentication
		$this->Mail->Username = 'info4will0618@gmail.com';                // SMTP username
		$this->Mail->Password = 'no1canbreakthispass';                  // SMTP password
		$this->Mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

		$this->Mail->From = 'info4will0618@gmail.com';
		$this->Mail->FromName = 'WebMasterWill';
		$this->Mail->AddAddress($email, $firstName. " ". $lastName);               // Name is optional

		$this->Mail->IsHTML(true);                                  // Set email format to HTML

		$this->Mail->Subject = 'WebMasterWill Website Request';
		$this->Mail->Body    = '

			<h1>WebMasterWill</h1>

			<h2>Thank you for sending me a web request' .$firstname .'</h2>

			<p>I will be getting back to you as soon as I can. I can\'t wait to start working in your website or project!</p>

			<p>Here is the information that you sent me:</p>

			<p>Review the information. If you believe that there are any mistakes in your web request you can contact me at <b>william@webmasterwill.com</b></p>

			<h3>Web Request Info:</h3>

			<p>Name: '.$firstName. ' '.$lastName.'</p>

			<p>Email: '.$email.'</p>

			<p>Project Description: '.$project_description.'</p>

			<p>Contact Number: '.$phoneNumber.'</p>

			<p>Budget specified: '.$budget.'</p>

			<p>Date: '.$timeFrame.'</p>';

			$this->Mail->Body .= '<p>Special Features: </p><ul>';

			foreach ($specialFeatures as $key => $value) {
				$this->Mail->Body .= '<li>'.$specialFeatures[$key].'</li>';
			}

			$this->Mail->Body .= '</ul>';

			'<p>
				Thank you again for sending me a web request. I\'ll be talking to you soon.
			</p>

		';
		$this->Mail->AltBody = '
						

	
		';

		if(!$this->Mail->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $this->Mail->ErrorInfo;
		   exit;
		}		
	}

	// public function sendMeNotificationMail($firstName, $lastName, $email, $project_description, $phoneNumber, $budget, $timeFrame, $specialFeatures) {

	// 	if ($budget = "00.00") {
	// 		$budget = "No budget specified.";
	// 	}

	// 	$timeFrame = date('F/j/Y', strtotime($timeFrame));


	// 	$this->Mail->IsSMTP();                                      // Set mailer to use SMTP
	// 	$this->Mail->Host = 'smtp.gmail.com';               // Specify main and backup server
	// 	$this->Mail->Port = 587;                                    // Set the SMTP port
	// 	$this->Mail->SMTPAuth = true;                               // Enable SMTP authentication
	// 	$this->Mail->Username = 'info4will0618@gmail.com';                // SMTP username
	// 	$this->Mail->Password = 'no1canbreakthispass';                  // SMTP password
	// 	$this->Mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

	// 	$this->Mail->From = 'info4will0618@gmail.com';
	// 	$this->Mail->FromName = 'WebMasterWill';
	// 	$this->Mail->AddAddress('info4will0618@gmail.com', 'William'. " ". 'Sanchez');               // Name is optional

	// 	$this->Mail->IsHTML(true);                                  // Set email format to HTML

	// 	$this->Mail->Subject = 'You Got a Web Development Proposal!';
	// 	$this->Mail->Body    = '

	// 		<h1> Web Development Proposal! </h1>

	// 		<p> Web Client Information: </p>

	// 		<p>Name: '.$firstName. ' '.$lastName.'</p>

	// 		<p>Email: '.$email.'</p>

	// 		<p>Project Description: '.$project_description.'</p>

	// 		<p>Contact Number: '.$phoneNumber.'</p>

	// 		<p>Budget specified: '.$budget.'</p>

	// 		<p>Date: '.$timeFrame.'</p>';

	// 		$this->Mail->Body .= '<p>Special Features: </p><ul>';

	// 		foreach ($specialFeatures as $key => $value) {
	// 			$this->Mail->Body .= '<li>'.$specialFeatures[$key].'</li>';
	// 		}

	// 		$this->Mail->Body .= '</ul>';

	// 		'<p>
	// 			If you have any concerns or want to change anything about the information you provided you can send me an email directly
	// 			and I will be sure to follow up. 
	// 		</p>

	// 	';

	// 	$this->Mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	// 	if(!$this->Mail->Send()) {
	// 	   echo 'Message could not be sent.';
	// 	   echo 'Mailer Error: ' . $this->Mail->ErrorInfo;
	// 	   exit;
	// 	}		
	// }

}