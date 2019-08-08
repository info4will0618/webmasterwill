<?php

namespace WebMasterWill\Library\Custom;

class UserValidation {

	public function validateName($name) {

		$name = preg_replace('/[^a-zA-Z0-9-_\.]/','', $name);

	    if (empty($name)) { return "The name field is required. Thank you!"; } 
	    
	    elseif (strlen($name) < 2) {return "The username should at least have two chracters. Thank you!";}

	    elseif (strlen($name) > 26) {return "The name cannot be longer than 26 characters. Thank you!";}

	    elseif (!preg_match('~^[a-z]{2}~i', $name)) { return "The name you entered must start with two letters. Please try again. Thank you.";}
   
	    elseif (preg_match('~[^a-z]+~i', $name)) { return "The name you entered can only contain letters. Please try again. Thank you.";}
 
	    return null;

	}

	public function validateEmail($email) {
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  		return null;
		} else {
	 		return "Please enter a valid email address, thank you!";
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
	      	 	return null;
	    	 }
		} 

		return null;
	}

	public function validatePassword($password) {
		if
		(
		  strlen($password) > 8   &&     // enforce length
		  preg_match('/[a-z]/', $password) &&     // contains lowercase
		  preg_match('/[A-Z]/', $password)    // contains uppercase
		) {
		    $passed_count = 0;
		    $min_passed = 1;
		    if( preg_match('/[0-9]/', $password) ) { $passed_count++; }  // contains digit
		    if( preg_match('/[^a-zA-Z0-9]/', $password) ) { $passed_count++; }  // contains symbol
		    if( $passed_count >= $min_passed ) {
		        return null;
		    } else {
		    	return "Your Password must contain at least 8 characters with at least one uppercare, one lowercase, and one number or symbol. Thank you!";
		    }
		} else {
			return "Your Password must contain at least 8 characters with at least one uppercare, one lowercase, and one number or symbol. Thank you!";
		}
	}

}

?>