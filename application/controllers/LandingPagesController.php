<?php

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Helpers;
use WebMasterWill\Library\Core\Controller;

class LandingPagesController extends Controller {

    public $cfg;

    public function __construct() {
        global $cfg;

        $this->cfg = $cfg;
    }

    public function webDesignerLosAngeles() {
        
        $title = 'Web Design Los Angeles';

        return view('landing_pages/web_designer_los_angeles', ['title' => $title, 'cfg' => $this->cfg]);
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
