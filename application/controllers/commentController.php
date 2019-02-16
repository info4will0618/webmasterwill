<?php 

class commentController extends Controller {

	protected function init() {
		$this->db= new DBHandler($this->cfg['db']);
	}

	public function comment() {
		echo "commenting!";
		var_dump($_POST);
	}

	public function reply() {

	}

	
}