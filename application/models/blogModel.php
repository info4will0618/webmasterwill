<?php
class blogModel extends Model {

	function __construct($db) {
		$this->db = $db->connect();
	}

	public function getMostRecentPosts() {

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
				   category.name AS category, 
				   category.link AS cat_link, 
				   GROUP_CONCAT(DISTINCT tag.name) AS tags, 
				   post.content, 
				   post.img, 
				   post.img_alt, 
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
			
			GROUP BY post.id

			ORDER BY post.id DESC

			LIMIT {$offset}, {$num_of_records_per_page}
			
		";

		$result = $this->db->prepare($query);

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);

        if(!empty($keyword)){
        	$data['post'] = $result->fetch();
        } else {
        	$data['posts'] = $result->fetchAll();
        }
		
		return $data;

	}

	public function getSpecificPost($keyword) {

		$query = "SELECT post.id, post.title, post.title_clean, category.name AS category, category.link AS cat_link, GROUP_CONCAT(DISTINCT tag.name) AS tags, post.content, post.img, post.img_alt, post.date_created, post.date_updated

		FROM post 
		
		/* 
			First link the post table to the interlink table, and then the other other to the interlink table. 
			We are linking our post table to the linking table, and then the category table to the linking table.
		*/

		INNER JOIN `category` ON post.category_id = category.id

		LEFT JOIN `post_tag` ON post.id = post_tag.post_id
		LEFT JOIN `tag` ON post_tag.tag_id = tag.id
		
		WHERE post.title_clean ='{$keyword}'

		LIMIT 1";

		$result = $this->db->prepare($query);

        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $data = $result->fetch();
       
		return $data;

	}

	public function getCategories() {

		$data = [];

		$query = "SELECT category.name AS category, category.link AS cat_link, category.description AS category_description

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

	public function getPostsByCategory($keyword) {

		if (isset($_GET['page_num'])) {
    		$page_num = $_GET['page_num'];
	    } else {
	        $page_num = 1;
	    }

		$data = [];

		$q = "";

		if(!empty($keyword)){
			$q = "WHERE category.link ='{$keyword}'";
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

	public function getRelatedArticles($keyword) {

		$query = "SELECT DISTINCT post.title, title_clean

		FROM post

		WHERE category_id = (
			
			SELECT post.category_id FROM post WHERE post.title_clean ='{$keyword}' LIMIT 1

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

	public function getcomments($keyword) {

		if(!empty($keyword)){
			$q = "WHERE `title`='{$keyword}'";
		}

		$sql = 
		"
			SELECT 
				comment.id AS id,
	  			comment.comment AS comment,
	  			comment.date_created AS date_created,
	  			user.email as user
	 
	  		FROM `comment` AS comment
		
			INNER JOIN `user`
			ON comment.user_id = user.id

			WHERE `post_id`='{$keyword}'
			-- AND `parent_id` IS NULL

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
	  			comment.comment AS comment,
	  			user.email AS user,
	  			parent.id AS repliesTo
	 
	  			FROM `comment` AS comment
		
				INNER JOIN `user`
				ON comment.user_id = user.id

				LEFT JOIN comment AS parent ON comment.parent_id = parent.id
				
				WHERE comment.post_id = {$postID}
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