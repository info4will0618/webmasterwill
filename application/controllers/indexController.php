 <?php

class indexController extends Controller {   
	public function index(){
		$this->view->setTitle('WebMasterWill');
		// $this->view->setMetaDesc('Lololol');
		return $this->view();
	}
}