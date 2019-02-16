<?php

class adminModel extends Model { 

	protected $RequestClass,
			  $BlogCRUD;

	public function __construct($db) {
		$this->db = $db;
		$this->RequestClass = new RequestClass($this->db);
		$this->BlogCRUD = new BlogCRUD($this->db);
	}

	public function validateUserAndPass($user, $password) {
		switch ($user) {
			case 'William':
				$passwordIsLegit = ($password === "12345" ? true : false);
				return $passwordIsLegit;
				break;
			case 'Luke':
				$passwordIsLegit = ($password === "67890" ? true : false);
				return $passwordIsLegit;
				break;
			default:
				return false;
				break;
		}
	}

	public function getClientsRequest() {
		$request = $this->RequestClass->getrequest($id = null);
		return $request;
	}

	public function getBlogPosts($sortBy) {

		switch($sortBy) {
		    case (''): 
		    	$data = $this->BlogCRUD->viewAllPosts();
		    	return $data;
		    	break;

		    case ('category'): 
		    	$data = $this->BlogCRUD->viewPostsByCategory();
		    	return $data;
		    	break;

		    default: 
		    	$data = $this->BlogCRUD->viewAllPosts();
		    	return $data;
		   		break;

		}
	}

	public function getSinglePost($db, $title) {
		$singlePost = $this->BlogCRUD->viewSinglePost($db, $title);
		return $singlePost;
	}
}