<?php

// Ensure we have session

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../library/core/bootstrap.php';

use WebMasterWill\Library\Core\Router;
use WebMasterWill\Library\Core\Request;

if(session_id() === ""){
    session_start();
}

define('DS', DIRECTORY_SEPARATOR);

define('ROOT', dirname(dirname(__FILE__)));

Router::load('../application/routes.php')
	->direct(Request::keys(), Request::method());
