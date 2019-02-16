<?php

class Validator {

	public function checkName($name) {

		if (filter_input(INPUT_POST, $name)) {
			return "Name was left blank";
		} 

		elseif (strlen($name) < 2) {return "The name you entered was too short. It should at least have 2 letters or more. ";}

	    elseif (strlen($name) > 26) {return "Name was too long";}

	    elseif (!preg_match('~^[a-z]{2}~i', $name)) { return "Name must start with two letters";}
   
	    elseif (preg_match('~[^a-z]+~i', $name)) { return "Name can only contain letters.";}
 
	    return null;
	}

	public function checkEmail($email) {
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  return null;
		} else {
		  return "The type of Email your inserted is not valid.";
		}
	}

	public function checkPass($password) {
		// Password must be strong
		if(!empty($password)) {
		    if (strlen($password) <= '8') {
		        return "Your Password Must Contain At Least 8 Characters!";
		    }
		    elseif(!preg_match("#[0-9]+#", $password)) {
		        return "Your Password Must Contain At Least 1 Number!";
		    }
		    elseif(!preg_match("#[A-Z]+#", $password)) {
		        return "Your Password Must Contain At Least 1 Capital Letter!";
		    }
		    elseif(!preg_match("#[a-z]+#", $password)) {
		        return "Your Password Must Contain At Least 1 Lowercase Letter!";
		    } else {
		    	return null;
		    }
		}

		elseif(empty($password)) {
		    return "Password was left empty";
		}

	}
}