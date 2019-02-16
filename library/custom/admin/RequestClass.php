<?php

class RequestClass {

	protected $db;

	function __construct($db) {

		$this->db = $db;

	}

	public function getAllRequest($id) {

		try {

			$request = [];

			$sql = "

				SELECT * FROM `website_request`

				ORDER BY `id` DESC

			";

				
			$stmt = $this->db->prepare($sql);

			$stmt->execute();

			$request = $stmt->fetchAll();

			return $request;

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
			echo $e;
		}
	}

}