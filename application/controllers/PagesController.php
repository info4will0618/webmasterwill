<?php

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Helpers;
use WebMasterWill\Library\Core\Controller;

class PagesController extends Controller {

    public function __construct() {

        parent::__construct();

    }

    public function home() {
        
        $title = 'WebMasterWill | Los Angeles Web Design | Websites That Sell';

        return view('pages/home', ['title' => $title, 'cfg' => $this->cfg]);
    }

    public function about() {

        $title = 'WebMasterWill About';

        return view('pages/about', ['title' => $title, 'cfg' => $this->cfg]);

    }

    public function contact() {
        $title = 'WebMasterWill Contact';

        return view('pages/contact', ['title' => $title, 'cfg' => $this->cfg]);
    }

    public function json() {
        return view('json');
    }

}
