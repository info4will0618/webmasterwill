<?php 

namespace WebMasterWill\Application\Models;

use PDO;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Core\Database\QueryBuilder;

class ReportComment {
	protected $db;
	
	function __construct()
	{
		$this->db = App::get('databaseConn');
	}
}