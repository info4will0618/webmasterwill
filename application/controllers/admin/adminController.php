<?php

class adminController extends Controller { 

	protected $validateInput;
	protected $parseDown;
	protected $Authenticator;
	public $db;

	protected function init() {
		$dbHandler = new DBHandler($this->dbCredentials);
		$this->db = $dbHandler->connect();
		$this->validateInput = new UserValidation();
		$this->parseDown = new Parsedown();
		$this->Authenticator = new Authenticator();
	}

	public function index(){
		if ($this->Authenticator->checkIfUserIsAuthenticated()) {
			$this->setViewPath(MyHelpers::UrlContent("~/views/admin/controls.php"));
			return $this->view();
		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_forbidden.php"));
			return $this->view();
		}
	}


	public function viewRequest() {
		if ($this->Authenticator->checkIfUserIsAuthenticated()) {
			$request = $this->_model->getClientsRequest();
			$this->view->set('request', $request);
			$this->setViewPath(MyHelpers::UrlContent("~/views/admin/view_all_request.php"));
			return $this->view();
		} else {
			
		}
	}

	public function viewPosts($keyword = "") {
		if ($this->Authenticator->checkIfUserIsAuthenticated()) {
			$sortBy = $keyword;
			$posts = $this->_model->getBlogPosts($sortBy);
			$this->view->set('posts', $posts);
			$this->setViewPath(MyHelpers::UrlContent("~/views/admin/view_all_posts.php"));
			return $this->view();
		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_forbidden.php"));
			return $this->view();
		}
	}

	public function viewSinglePost($keyword = "") {
		if ($this->Authenticator->checkIfUserIsAuthenticated()) {
			if (empty($keyword)) {
				$this->viewPosts();
				return $this->view();
			} else {
				$singlePost = $this->_model->getSinglePost($this->dbHandler, $keyword);
				$this->parseDown->setSafeMode(true);
				$singlePost['content'] = $this->parseDown->text($singlePost['content']);
				$this->view->set('post', $singlePost);
				$this->setViewPath(MyHelpers::UrlContent("~/views/admin/view_single_post.php"));
				return $this->view();
			}
			
		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_forbidden.php"));
			return $this->view();
		}

	}

	public function editSinglePost($keyword = "") {

		if ($this->Authenticator->checkIfUserIsAuthenticated()) {

			if (empty($keyword)) {
				$this->viewPosts();
				return $this->view();
			} else {
				$singlePost = $this->_model->getSinglePost($this->dbHandler, $keyword);
				$this->parseDown->setSafeMode(true);
				$singlePost['content'] = $this->parseDown->text($singlePost['content']);
				$this->view->set('post', $singlePost);
				$this->setViewPath(MyHelpers::UrlContent("~/views/admin/edit_single_post.php"));
				return $this->view();
			}
			
		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_forbidden.php"));
			return $this->view();
		}
	}


}