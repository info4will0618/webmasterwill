<?php 

namespace WebMasterWill\Application\Models;

use PDO;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Core\Database\QueryBuilder;

class Blog {
	
	protected $db;

	function __construct()
	{
		$this->db = App::get('databaseConn');
	}

	public function getMostRecentPosts($categoryID = false) {

		$q = null;

		if(!empty($categoryID)){
			$q = "WHERE `category_id`='{$categoryID}'";
		}

		$pagination = [];

		if (isset($_GET['page_num'])) {
    		$page_num = $_GET['page_num'];
	    } else {
	        $page_num = 1;
	    }

		$data = [];

		$num_of_records_per_page = 7;

        $total_pages_sql = "SELECT COUNT(*) AS count FROM post";
		$count = $this->db->prepare($total_pages_sql);
		$count->execute();
		$count->setFetchMode(PDO::FETCH_ASSOC);
		$total_rows = $count->fetch();

		$total_rows = (int)$total_rows['count'];

		$totalPages = ceil($total_rows / $num_of_records_per_page);

        $offset = ($page_num-1) * $num_of_records_per_page;

        $data['total_pages'] = $totalPages;
        
		$query = "

			SELECT post.id, 
				   post.title, 
				   post.title_clean, 
				   category.id AS cat_id,
				   category.name AS cat_name, 
				   category.link AS cat_link, 
				   GROUP_CONCAT(DISTINCT tag.name) AS tags, 
				   post.content, 
				   post.img_name, 
				   post.img_path, 
				   post.img_ext, 
				   post.img_alt, 
				   post.date_created AS date_created, 
				   post.date_updated,
				   COUNT(comment.id) AS comment_count

			FROM post 
			
			/* 
				First link the post table to the interlink table, and then the other other to the interlink table. 
				We are linking our post table to the linking table, and then the category table to the linking table.
			*/

			INNER JOIN `category` ON post.category_id = category.id

			LEFT JOIN `post_tag` ON post.id = post_tag.post_id
			LEFT JOIN `tag` ON post_tag.tag_id = tag.id

			LEFT JOIN comment ON post.id = comment.post_id

			{$q}

			GROUP BY post.id
			ORDER BY post.id DESC

			LIMIT {$offset}, {$num_of_records_per_page}
			
		";

		$result = $this->db->prepare($query);

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);

        if(!empty($id)){
        	$data['post'] = $result->fetch();
        } else {
        	$data['posts'] = $result->fetchAll();
        }
		
		return $data;

	}

	public function getSpecificPost($id) {

		$query = "SELECT 
					post.id, 
					post.title, 
					post.title_clean, 
					category.name AS cat_name, 
					category.link AS cat_link, 
					GROUP_CONCAT(DISTINCT tag.name) AS tags, 
					post.content, 
					post.img_name, 
					post.img_alt, 
					post.img_ext, 
					post.img_path, 
					post.date_created, 
					post.date_updated

		FROM post 
		
		/* 
			First link the post table to the interlink table, and then the other other to the interlink table. 
			We are linking our post table to the linking table, and then the category table to the linking table.
		*/

		INNER JOIN `category` ON post.category_id = category.id

		LEFT JOIN `post_tag` ON post.id = post_tag.post_id
		LEFT JOIN `tag` ON post_tag.tag_id = tag.id
		
		WHERE post.id ='{$id}'

		LIMIT 1";

		$result = $this->db->prepare($query);

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $data = $result->fetch();
       
		return $data;

	}

	public function getCategories() {

		$data = [];

		$query = "SELECT category.id AS cat_id, category.name AS category, category.link AS cat_link, category.description AS category_description

		FROM category

		ORDER BY category.id ASC
	
		";

		$result = $this->db->prepare($query);

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);
		
        $data = $result->fetchAll();

		return $data;	

        $this->db = null;

	}

	public function getPostsByCategory($id) {

		if (isset($_GET['page_num'])) {
    		$page_num = $_GET['page_num'];
	    } else {
	        $page_num = 1;
	    }

		$data = [];

		$q = "";

		if(!empty($id)){
			$q = "WHERE category.id ='{$id}'";
		}

		$num_of_records_per_page = 7;

        $total_pages_sql = "SELECT COUNT(*) AS count FROM post INNER JOIN `category` ON post.category_id = category.id {$q} ";
		$count = $this->db->prepare($total_pages_sql);
		$count->execute();
		$count->setFetchMode(PDO::FETCH_ASSOC);
		$total_rows = $count->fetch();

		$total_rows = (int)$total_rows['count'];

		$totalPages = ceil($total_rows / $num_of_records_per_page);

        $offset = ($page_num-1) * $num_of_records_per_page;

        $data['total_pages'] = $totalPages;
        
		$query = "

		SELECT
			   post.id, 
			   post.title, 
			   post.title_clean, 
			   category.name AS cat_name, 
			   category.link AS cat_link, 
			   GROUP_CONCAT(DISTINCT tag.name) AS tags, 
			   post.content, 
			   post.img_name, 
			   post.img_alt, 
			   post.img_ext, 
			   post.img_path, 
			   post.date_created, 
			   post.date_updated
			   
		FROM post 
		
		/* 
			First link the post table to the interlink table, and then the other other to the interlink table. 
			We are linking our post table to the linking table, and then the category table to the linking table.
		*/

		INNER JOIN `category` ON post.category_id = category.id

		LEFT JOIN `post_tag` ON post.id = post_tag.post_id
		LEFT JOIN `tag` ON post_tag.tag_id = tag.id
		
		{$q}

		GROUP BY post.id

		ORDER BY post.id DESC

		LIMIT {$offset}, {$num_of_records_per_page}";

		$result = $this->db->prepare($query);

        $result->execute();

        $count = $result->rowCount();

        if ($count === 0) {

        	return false;

        } else {

			$result->setFetchMode(PDO::FETCH_ASSOC);

			$data['posts'] = $result->fetchAll();

			return $data;
        }

        $this->db = null;
	}

	public function getPostsByDate($date) {

		if (isset($_GET['page_num'])) {
    		$page_num = $_GET['page_num'];
	    } else {
	        $page_num = 1;
	    }

		$data = [];

		$q = "";

		if(!empty($date)){
			$q = "WHERE post.date_created >= CAST('{$date[0]}' AS DATE) AND post.date_created < CAST('{$date[1]}' AS DATE) ";
		}

		$num_of_records_per_page = 7;

        $total_pages_sql = "SELECT COUNT(*) AS count FROM post {$q} ";
		$count = $this->db->prepare($total_pages_sql);
		$count->execute();
		$count->setFetchMode(PDO::FETCH_ASSOC);
		$total_rows = $count->fetch();

		$total_rows = (int)$total_rows['count'];

		$totalPages = ceil($total_rows / $num_of_records_per_page);

        $offset = ($page_num-1) * $num_of_records_per_page;

        $data['total_pages'] = $totalPages;
        
		$query = "SELECT post.id, post.title, post.title_clean, category.name AS category, category.link AS cat_link, GROUP_CONCAT(DISTINCT tag.name) AS tags, post.content, post.img, post.img_alt, post.date_created, post.date_updated

		FROM post 
		
		/* 
			First link the post table to the interlink table, and then the other other to the interlink table. 
			We are linking our post table to the linking table, and then the category table to the linking table.
		*/

		INNER JOIN `category` ON post.category_id = category.id

		LEFT JOIN `post_tag` ON post.id = post_tag.post_id
		LEFT JOIN `tag` ON post_tag.tag_id = tag.id
		
		{$q}

		GROUP BY post.id

		ORDER BY post.id DESC

		LIMIT {$offset}, {$num_of_records_per_page}";

		$result = $this->db->prepare($query);

        $result->execute();

        $count = $result->rowCount();

        if ($count === 0) {

        	return false;
        	
        } else {

        	$result->setFetchMode(PDO::FETCH_ASSOC);

        	$data['posts'] = $result->fetchAll();
        
			return $data;

        }  

	}

	public function getDates() {

		$data = [];

		$query = "SELECT DISTINCT MONTH(date_created) AS month, YEAR(date_created) AS year, date_created AS date_created, COUNT(MONTH(date_created)) AS num_per_month

		FROM post

		GROUP BY MONTH(date_created)

		ORDER BY date_created  DESC
	
		";

		$result = $this->db->prepare($query);

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);
		
        $data = $result->fetchAll();

		return $data;	

        $this->db = null;



	}

	public function search($input) {

		$input = '%' . $input . '%'; 

		var_dump($input);

		$data;

		$query = "
					SELECT *
					FROM post
					WHERE post.content OR post.title OR MONTH(date_created) OR YEAR(date_created) LIKE :input

				";

		$result = $this->db->prepare($query);

		$result->bindParam(':input', $input);

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);
		
        $data = $result->fetchAll();

        var_dump($data);

		return $data;	

        $this->db = null;

	}

	public function getRelatedArticles($id) {

		$query = "SELECT DISTINCT post.title, title_clean

		FROM post

		WHERE category_id = (
			
			SELECT post.category_id FROM post WHERE post.title_clean ='{$id}' LIMIT 1

		)

		ORDER BY date_created  DESC

		LIMIT 5
	
		";

		$result = $this->db->prepare($query);

		$result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);
		
        $data = $result->fetchAll();

        return $data;

	}

	public function getcomments($postID) {

		if(!empty($id)){
			$q = "WHERE `title`='{$id}'";
		}

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

			WHERE comment.post_id = '{$postID}'
			AND `parent_id` IS NULL

			GROUP BY comment.id

			LIMIT 1

	  	";

		$result = $this->db->prepare($sql);

		$result->execute();

		$result->setFetchMode(PDO::FETCH_ASSOC);



		$comments = $result->fetchAll();

		return $comments;
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
	  			comment.date_created AS date_created,
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

	// public function getLikes() {

	//   	$sql = "SELECT 
	//   			posts.id,
	//   			posts.post_title,
	//   			users.user_alias,
	  			
	//   			COUNT(post_likes.id) AS likes

	//   			FROM posts

	//   			LEFT JOIN post_likes
	//   			ON posts.id = post_likes.post_id

	//   			LEFT JOIN users
	//   			ON post_likes.user_name = users.user_alias

	//   			GROUP BY posts.id
	//   	";

	//   	$result = $this->db->prepare($sql);

	//   	$result->execute();

	//   	$likes = $result->fetch(PDO::FETCH_OBJ);

	//   	return $likes;

	//   }

}