<?php

class servicesController extends Controller {   

	protected function init() {
		
	}

	public function index() {
		$title = "WebMasterWill Services";
		$this->view->set('title', $title);
		$this->setViewPath(MyHelpers::UrlContent("~/views/services/index.php"));
		return $this->view();
	}

	public function webDevelopment() {
		$title = "WebMasterWill Services | Web Development";
		$this->view->set('title', $title);
		$this->setViewPath(MyHelpers::UrlContent("~/views/services/web_development.php"));
		return $this->view();
	}

	public function webDesign() {
		$title = "WebMasterWill Services | Web Design";
		$this->view->set('title', $title);
		$this->setViewPath(MyHelpers::UrlContent("~/views/services/web_design.php"));
		return $this->view();
	}

	public function prices() {
		$title = "WebMasterWill Services | Prices";
		$this->view->set('title', $title);
		$this->setViewPath(MyHelpers::UrlContent("~/views/services/prices.php"));
		return $this->view();
	}

	public function technologies() {
		$title = "WebMasterWill Services | Technologies";
		$this->view->set('title', $title);
		$this->setViewPath(MyHelpers::UrlContent("~/views/services/technologies.php"));
		return $this->view();
	}

	public function howIWork() {
		$title = "WebMasterWill Services | How I Work";
		$this->view->set('title', $title);
		$this->setViewPath(MyHelpers::UrlContent("~/views/services/how_I_work.php"));
		return $this->view();
	}

	
}