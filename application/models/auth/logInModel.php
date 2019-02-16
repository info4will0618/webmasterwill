<?php

class logInModel extends Model { 

	public function __construct($db) {
		$this->db = $db->connect();
	}

	public function getUser($username) {

		try {
			
			$sql = 

				"
					SELECT * FROM user WHERE `email` = :username
				";

			$stmt = $this->db->prepare($sql);

			$stmt->bindParam(':username', $username);

			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$results = $stmt->fetch();

			// var_dump($results);

			// if (password_verify($password, $results['password'])) {
   //  			echo "verified";
			// } else {
			// 	echo "false!";
			// }

			// exit;

			return $results;

		} catch (Exception $e) {
			
		}
	}
}