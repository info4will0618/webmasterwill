<?php

class RequestValidation {

	public function validateName($name) {

		$name = preg_replace('/[^a-zA-Z0-9-_\.]/','', $name);

	    if (empty($name)) { return "The name field is required. Thank you."; } 
	    
	    elseif (strlen($name) < 2) {return "The name you entered was too short. Please try again. Thank you.";}

	    elseif (strlen($name) > 26) {return "The name cannot be longer than 26 characters. Thank you!";}

	    elseif (!preg_match('~^[a-z]{2}~i', $name)) { return "The name you entered must start with two letters. Please try again. Thank you.";}
   
	    elseif (preg_match('~[^a-z]+~i', $name)) { return "The name you entered can only contain letters. Please try again. Thank you.";}
 
	    return true;

	}

	public function validateEmail($email) {
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  		return true;
		} else {
	 		return "The type of Email your entered is not valid or empty.";
		}
	} 

	public function validatePhoneNumber($phoneNumber) {

		if (isset($phoneNumber) && !empty($phoneNumber)) {
			$filtered_phone_number = filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT);
 			// Remove "-" from number
 			$phone_to_check = str_replace("-", "", $filtered_phone_number);
	    	 // Check the lenght of number
	     	// This can be customized if you want phone number from a specific country
	    	 if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {

	        	return "Invalid Number!";

	    	 } else {
	      	 	return true;
	    	 }
		} 

		return true;
	}

	public function validateBudget($budget) {     

		if (isset($budget) && !empty($budget)) {
			if (preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $budget)) {
				return true;
			} else {
				return "Please enter a valid amount. Either a whole number or a two digit decimal number.";
			}
		} else {
			return true;
		}
	}

	public function validateDate($date) {
	$date_now = new DateTime();
	$date = new DateTime($date); 
	
	if (isset($date)) {
		if (($date_now > $date)) {
			return "Please enter a time frame that's in future reference";
		}
	} 

	return true;
	
	}
}

?>