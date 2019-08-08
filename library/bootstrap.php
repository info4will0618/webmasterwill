<?php 
// Ensure we have session
if(session_id() === ""){
    session_start();
}

$configPath = ROOT . DS . 'config' . DS . 'config.php';

// include the config settings
require_once($configPath);

// Autoload any classes that are required
spl_autoload_register(function($className) {

    //$className = strtolower($className);
    $rootPath = ROOT . DS;
    $valid = false;
   
    // check root directory of library
    $valid = file_exists($classFile = $rootPath . 'library' . DS . $className . '.class.php');
    
    // if we cannot find any, then find library/core directory
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'core' . DS . $className . '.class.php');   	
    }

    // if we cannot find any, then find library/mvc directory
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'mvc' . DS . $className . '.class.php');
    }  

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'custom' . DS . 'database' . DS . $className . '.class.php');
    } 
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'custom' . DS . 'mail' . DS . $className . '.php');
    } 
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'custom' . DS . 'validation' . DS . $className . '.class.php');
    } 
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'custom' . DS . 'parsedown-master' . DS . $className . '.php');
    } 

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'custom' . DS . 'admin' . DS . $className . '.php');
    } 

     if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'library' . DS . 'custom' . DS . 'temp' . DS . $className . '.class.php');
    } 

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . $className . '.php');
    } 

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . 'admin' . DS . $className . '.php');
    } 

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'controllers' . DS . 'auth' . DS . $className . '.php');
    } 

    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'models' . DS . 'admin' . DS . $className . '.php');
    }
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'models' . DS . 'auth' . DS . $className . '.php');
    }
    // if we cannot find any, then find application/models directory
    if(!$valid){
        $valid = file_exists($classFile = $rootPath . 'application' . DS . 'models' . DS . $className . '.php');
    }  
  
    // if we have valid field, then include it
    if($valid){
       require_once($classFile); 
    } else {
        /* Error Generation Code Here */
    }


});

MyHelpers::removeMagicQuotes();

MyHelpers::unregisterGlobals();

$router = new Router($route);

$router->dispatch();

session_write_close();