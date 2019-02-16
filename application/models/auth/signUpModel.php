<?php

class signUpModel extends Model { 

	public function __construct($db) {
		$this->db = $db->connect();
	}


	public function checkIfUserExists($email) {
		try {
			
			$sql = 
				"
					SELECT * FROM user WHERE `email` = :email
					LIMIT 1
				";

			$stmt = $this->db->prepare($sql);

			$stmt->bindParam(':email', $email);

			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$results = $stmt->fetch();

			if ($results) {
				return true;
			} else {		
				return false;
			}

		} catch (Exception $e) {
			
		}
	}

	public function registerUser($email, $password, $code) {
			
		try {
			
			$sql = 

				"
					INSERT INTO `user` (email, password, verification_code) VALUES (:email, :password, :verification_code)

				";

			$stmt = $this->db->prepare($sql);

			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':verification_code', $code);

			$stmt->execute();

		} catch (Exception $e) {
			echo $e;
		}
	}

	public function verifyUserCode($code) {

		try {

			$sql = 

				"	
					SELECT email, verified, verification_code FROM user
		  			WHERE verification_code = :verification_code	
		  			LIMIT 1 

		  		";
				
			$stmt = $this->db->prepare($sql);

			$stmt->execute(
			  array(
			   	':verification_code' => $code
			  )
			 );

			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$num_of_rows = $stmt->rowCount();

			if ($num_of_rows > 0) {

				$row = $stmt->fetch();
				
				if($row['verified'] == 0) {

					$update = 

						"
					    	UPDATE user 
					    	SET verified = 1
					    	WHERE verification_code = '".$row['verification_code']."'
					    	
					    ";

				    $updated = $this->db->prepare($update);

				    $updated->execute();

				    if ($updated->rowCount() > 0) {
				    	return $row['email'];
				    } else {
				    	return false;
				    }
				}
			} else {
				return false;
			}

		} catch(Exception $e) {
			$data['failed'] = $e->getMessage();
			echo $e;
		}

	}

}