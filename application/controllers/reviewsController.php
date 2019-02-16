<?php

class reviewsController extends Controller {   

	protected function init() {
		
	}

	public function index() {
		$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_maintenance.php"));
		return $this->view();
	}

	
}