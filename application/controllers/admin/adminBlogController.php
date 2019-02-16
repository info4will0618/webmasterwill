<?php

class adminBlogController extends Controller { 
	protected function init() {
		$this->dbHandler = new DBHandler($this->cfg);
		$this->validateInput = new UserInputValidation();
	}

	public function edit($title = "") {
		
	}
}