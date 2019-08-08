<?php

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Helpers;
use WebMasterWill\Library\Core\Controller;

class ResourcesController extends Controller {

    public $cfg;

    public function __construct() {

        global $cfg;

        $this->cfg = $cfg;

    }

    public function index() {

        $cfg = $this->cfg;
        
        $title = 'Web Master Will Resources';

        return view('resources/index', ['title' => $title, 'cfg' => $this->cfg]);
    }

}
