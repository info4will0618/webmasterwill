<?php

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Helpers;
use WebMasterWill\Library\Core\Controller;

class ServicesController extends Controller {

    public $cfg;

    public function __construct() {

        global $cfg;

        $this->cfg = $cfg;

    }

    public function index() {

        $cfg = $this->cfg;
        
        $title = 'WebMasterWill Web Design Services';

        $services['selling_strategy'] = "This is the first step to creating or doing anything on a website. This step determines the best way to use your website to represent whatever you have to offer and do it\'s best to sell it. I run your business through the WebMasterWill selling framework that will give me a good foundation to start building a website selling strategy.";

        $services['website_build'] = 'Once your business goes through the website selling strategy it\'s time to determine how many pages \and what design we can implement on your website. \And don\'t worry, your website will be up to date with the newest web standards. That means mobile friendly, secure, beautiful, and even the basics foundation of SEO built in.';

        $services['copywriting'] = 'Knowing the exact words to choose and how you put them together can make a huge selling difference in your website. Using the WebMasterWill selling strategy results, we will create effective selling copy that will make your visitors more interested and more likely to buy from you.';

        $services['involvement_devices'] = 'With involvement devices, you can engage with your customers';

        $services['analytical_research'] = 'How do know that the WebMasterWill selling strategy is working and making you more money? You track it and keep records! I will help you set up website tracking software like Google analytics to measure how much more engagement you will be getting on your website from people. I will also teach you how to use it so you will be able to track your website progress over time.';

        $services['website_build'] = 'How do know that the WebMasterWill selling strategy is working and making you more money? You track it and keep records! I will help you set up website tracking software like Google analytics to measure how much more engagement you will be getting on your website from people. I will also teach you how to use it so you will be able to track your website progress over time.';

        return view('services/index', ['title' => $title, 'cfg' => $this->cfg, 'services' => $services]);
    }

}
