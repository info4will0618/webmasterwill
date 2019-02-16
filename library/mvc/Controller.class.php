<?php

class Controller {
    
    protected $_model,
              $_controller,
              $_action;
    
    public    $cfg,
              $view,
              $table,
              $id,
              $db;

    public function __construct($model="Model", $controller="Controller", $action="index") {

        global $cfg;

        $this->cfg = $cfg;

        $this->_controller = $controller;

        $this->_action = $action;

        $this->view = new Template($controller, $action);   
		  
        $this->init();
        // Call the concrete model
        $this->_model = new $model($this->db);
        $this->_model->controller = $this;
        $this->table = $controller;
    }
    
    protected function init() {
     /* Put your code here*/
    }

    protected function setViewPath($path) {

        $this->view->viewPath = $path;
        
    }
    
    public function redirectToAction($action, $controller = false, $params = array()){        
        if($controller === false) {
            $controller = get_called_class();  
        } else if(is_string($controller) && class_exists($controller.'Controller')) {
            $controller = $controller.'Controller';
            $controller = new $controller();
        }

        return call_user_func_array(array($controller, $action), $params);
        
    }

    public function defaultAction($params = null){
    	// make the default action path
		$path = MyHelpers::UrlContent("~/views/{$this->_controller}/{$this->_action}.php");		
        // if we have action name
		if(file_exists($path)) {
            $this->view->viewPath = $path;
        } else {
        	$this->unknownAction();
        }
		// if we have paramaters
		if(!empty($params) && is_array($params)){
	        // assign local variables
	        foreach($params as $key=>$value){
	         $this->view->set($key, $value);   
	        }
		}
        // dispatch the result
        return $this->view();
    }
    /**
    * unknownAction
    */
    public function unknownAction($params = array()){
    	// feed 404 header to the client
        header("HTTP/1.0 404 Not Found");
		// find custom 404 page
		$path = MyHelpers::UrlContent("~/views/shared/_404.php");
		// if we have custom 404 page, then use it
		if(file_exists($path)){
			$this->view->viewPath = $path;
			return $this->view();
		} else {
			exit; //Do not do any more work in this script.	
		}
    }
    
    public function set($name, $value) {
    	
        $this->view->set($name, $value);
    }

    public function view(){

        return $this->view;

    }
}
