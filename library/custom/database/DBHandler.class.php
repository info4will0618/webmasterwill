<?php 

class DBHandler {

    protected $cfg;

	function __construct($cfg) {
        $this->cfg = $cfg;
    }


	public function connect() {

		try {

    		$dbConnection = new PDO("mysql:host=".$this->cfg['hostname'].";dbname=".$this->cfg['database']."", $this->cfg['username'], 
        	$this->cfg['password']);
        	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $dbConnection;

    	} catch(PDOException $e) {

    		echo 'ERROR: ' . $e->getMessage();
            
    	}
        
	}

    public function close() {
        $this->db = null;
    }

}