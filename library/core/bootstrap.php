<?php 

use WebMasterWill\Library\Core\App;

use WebMasterWill\Library\Core\Database\Connection;
use WebMasterWill\Library\Core\Database\QueryBuilder;

function view($name, $data = []) {

    extract($data);

    return require "/../application/views/{$name}.view.php";
}

function redirect($path) {
	header("Location: /{$path}");
}

function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// App::bind('validate', new ValidateContact());

// App::bind('mailContactInfo', new ContactMail());

App::bind('config', require '../config/config.php');

App::bind('databaseCred', require '../database/database.php');

App::bind('databaseConn', Connection::make(App::get('databaseCred')['database']));