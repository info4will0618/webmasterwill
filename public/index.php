<?php

// Ensure we have session

if(session_id() === ""){
    session_start();
}

define('DS', DIRECTORY_SEPARATOR);

define('ROOT', dirname(dirname(__FILE__)));

$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

require_once(ROOT . DS . 'library' . DS . 'bootstrap.php');