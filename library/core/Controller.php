<?php 

namespace WebMasterWill\Library\Core;

use Exception;

class Controller {

	protected $model, 
			  $cfg;


	function __construct() {
		
		$this->setConfig();

	}

	public function setConfig() {

		global $cfg;

		$this->cfg = $cfg;

	}

}