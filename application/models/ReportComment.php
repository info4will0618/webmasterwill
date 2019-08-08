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

	function deleteReportComment($post_id, $comment_id, $user_id) {
		try {

			$db = App::get('databaseConn');

			$sql =

			"
				DELETE FROM `comment_report` 

				WHERE 
					`user_id` = :user_id AND
					`comment_id` = :comment_id AND
					`post_id` = :post_id

			";

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':comment_id', $comment_id);
			$stmt->bindParam(':post_id', $post_id);
			$stmt->bindParam(':user_id', $user_id);

			$stmt->execute();


		} catch (Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	}

}