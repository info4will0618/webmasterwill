<?php

class Model {

	protected $_model;
    public $db, $controller;
    
	public function __construct() {
		$this->_model = get_class($this);
        $defaultModel = ($this->_model == 'Model');
        
        if(!$defaultModel){
            $this->table = preg_replace('/Model$/', '', $this->_model); // remove ending Model        
        }

        $this->init();
	}

	protected function init() { 
         
    }
}
