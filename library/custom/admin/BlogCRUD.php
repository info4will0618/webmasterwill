<?php

class BlogCRUD {

	protected $db;

	public function __construct($db) {
		$this->db = $db;
	}	

	public function viewAllPosts() {

		try {

			$request = [];

			$sql = "

				SELECT * FROM `post`

				ORDER BY `id` DESC

			";

				
			$stmt = $this->db->prepare($sql);

			$stmt->execute();

			$request = $stmt->fetchAll();

			return $request;

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
			echo $e;
		}
	}

	public function viewPostsByCategory() {

	}

	public function viewSinglePost($keyword = "") {

		$title = $keyword;

		try {

			$request = [];

			$sql = "

				SELECT post.id, post.title, post.title_clean, category.name AS category, category.link AS cat_link, GROUP_CONCAT(DISTINCT tag.name) AS tags, post.content, post.img, post.img_alt, post.date_created, post.date_updated

				FROM post 
				
				/* 
					First link the post table to the interlink table, and then the other other to the interlink table. 
					We are linking our post table to the linking table, and then the category table to the linking table.
				*/

				INNER JOIN `category` ON post.category_id = category.id

				LEFT JOIN `post_tag` ON post.id = post_tag.post_id
				LEFT JOIN `tag` ON post_tag.tag_id = tag.id
				
				WHERE post.title_clean ='{$keyword}'

				LIMIT 1

			";

			$stmt = $this->db->prepare($sql);

			$stmt->execute();

			$request = $stmt->fetch();

			return $request;

		} catch (Exception $e) {
			$messages['fail'] = $e->getMessage();
			echo $e;
		}
	}

}