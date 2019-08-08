<?php 

namespace WebMasterWill\Application\Models;

use PDO;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Core\Database\QueryBuilder;

class Comment {

	protected $db;
	
	function __construct()
	{
		$this->db = App::get('databaseConn');
	}

	public function postComment($comment, $post, $user) {

		if(!empty($post)) {
			$q = "WHERE `post_id`='{$post}'";
		}

		$sql = "INSERT INTO `comment` (`user_id`, `post_id`,`comment`, `last_updated`) VALUES('{$user}','{$post}','{$comment}', NOW())";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':user_id', $user);
		$stmt->bindParam(':post_id', $post);
		$stmt->bindParam(':comment', $comment);

		$stmt->execute();

		$num = $stmt->rowCount();
	}

	public function insertReply($user_id, $post_id, $parent_id, $reply) {
		try {
			$db = App::get('databaseConn');
			$sql = "INSERT INTO `comment` 
				(user_id, post_id, parent_id, comment) 
				VALUES 
				(:user_id, :post_id, :parent_id, :comment)";

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':post_id', $post_id);
			$stmt->bindParam(':parent_id', $parent_id);
			$stmt->bindParam(':comment', $reply);

			$stmt->execute();

		} catch (Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	}

	public function getReplies($postID) {

		$replies = [];

		 $q = 

		 "
		 	SELECT 
				comment.id AS id,
				comment.user_id AS user_id,
	  			comment.comment AS comment,
	  			user.first_name AS user_name,
	  			parent.id AS repliesTo
	  			-- comment_report.id AS reportID
	 
	  			FROM comment
		
				INNER JOIN user
				ON comment.user_id = user.id

				-- LEFT JOIN comment_report
				-- ON comment.id = comment_report.comment_id

				LEFT JOIN comment AS parent ON comment.parent_id = parent.id
				
				WHERE comment.post_id = '{$postID}'
				AND parent.id IS NOT NULL
				
			";

			$r = $this->db->prepare($q);

			$r->execute();

			$row = $r->rowCount();

			$r->setFetchMode(PDO::FETCH_ASSOC);

			if( $row > 0 ) {
				$replies = $r->fetchAll();
			}

		 return $replies;
	}

	public function deleteMyComment($id) {

		try {

			$db = App::get('databaseConn');

			$sql = "

				DELETE FROM `comment` 

				WHERE `id` = :id;

			";

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':id', $id);

			$stmt->execute();

		} catch (Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	}

	public function updateMyComment($id, $comment) {

		try {

			$db = App::get('databaseConn');

			$sql = "

				UPDATE `comment` 

				SET `comment` = :comment

				WHERE `id` = :id

			
			";

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':comment', $comment);

			$stmt->bindParam(':id', $id);

			$stmt->execute();

		} catch (Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	}

	public function checkReport($post_id, $comment_id, $user_id) {
		try {

			$db = App::get('databaseConn');

			$sql = 

			"
				SELECT 

					`id` 

				FROM `comment_report`

				WHERE 
					`user_id` = :user_id AND
					`comment_id` = :comment_id AND
					`post_id` = :post_id

				LIMIT 1

			";

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':comment_id', $comment_id);
			$stmt->bindParam(':post_id', $post_id);

			$stmt->execute();

			$stmt = $stmt->rowCount();

			return $stmt;

		} catch (Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	}

	public function reportComment($post_id, $comment_id, $user_id) {

		try {

			$db = App::get('databaseConn');

			$sql =

			"
				INSERT INTO `comment_report` 

					(user_id, comment_id, post_id)

				VALUES
					(:user_id, :comment_id, :post_id)
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

	public function loadMoreComments($post_id, $comment_count) {

		try {
			$sql = 
				"
				SELECT 
					comment.id AS id,
					comment.parent_id AS parent_id,
					comment.user_id AS user_id,
		  			comment.comment AS comment,
		  			comment.date_created AS date_created,
		  			user.first_name AS user_name,
		  			user.email as user
		 
		  		FROM `comment` AS comment
			
				INNER JOIN `user`
				ON comment.user_id = user.id

				WHERE comment.post_id = '{$post_id}'
				AND `parent_id` IS NULL

				GROUP BY comment.id

				LIMIT {$comment_count}, 2
	
	  		";

		$result = $this->db->prepare($sql);

		$result->execute();

		$result->setFetchMode(PDO::FETCH_ASSOC);

		$comments = $result->fetchAll();

		return $comments;

		} catch (Exception $e) {
			echo $e;
		}
	}
}