<?php

class blogController extends Controller {   

	protected $parseDown;

	protected function init() {
		$this->db= new DBHandler($this->cfg['db']);
		$this->parseDown = new Parsedown();
	}

	public function index() {

		$title = "WebMasterWill Blog";

		$data = $this->_model->getMostRecentPosts();

		$totalPages = $data['total_pages'];

		$posts = $data['posts'];

		if (!empty($posts)) {

			$this->parseDown->setSafeMode(true);

			foreach ($posts as $key => $value) {
				$posts[$key]['content'] = $this->parseDown->text($posts[$key]['content']);
			}

			foreach ($posts as $key => $value) {
				$posts[$key]['tags'] = array_filter(explode(',', $posts[$key]['tags']));
			}

			$categories = $this->_model->getCategories();

			$this->view->set('blog_posts', $posts);

			$this->view->set('categories', $categories);

			$this->view->set('total_pages', $totalPages);

			$this->view->set('title', $title);

			$this->db = $this->db->close();

			return $this->view();

		} else {
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_maintenance.php"));
			$this->view->setTitle("WebMasterWill Maintenance");
			return $this->view();
		}

	}

	public function post($keyword = false) {

		if (empty($keyword)) {
			$title = "WebMasterWill Posts Search";
			$categories = $this->_model->getCategories();
			$dates = $this->_model->getDates();
			$this->view->set('dates', $dates);
			$this->view->set('categories', $categories);
			$this->view->set('title', $title);
			$this->setViewPath(MyHelpers::UrlContent("~/views/blog/post_general.php"));
			return $this->view();
		} else {

			$data['posts'] = $this->_model->getSpecificPost($keyword);

			$data['related_articles'] = $this->_model->getRelatedArticles($keyword);

			$comments = $this->_model->getComments($data['posts']['id']);

			$replies = $this->_model->getReplies($data['posts']['id']);

			array_shift($data['related_articles']);

			if (!empty($data)) {

				$title = $data['posts']['title'] . " | WebMasterWill";

				$data['posts']['content'] = $this->parseDown->text($data['posts']['content']);

				$data['posts']['tags'] = array_filter(explode(',', $data['posts']['tags']));

				$this->view->set('related_articles', $data['related_articles']);

				$this->view->set('post', $data['posts']);

				$this->view->set('title', $title);

				$this->view->set('comments', $comments);

				$this->view->set('replies', $replies);

				$this->setViewPath(MyHelpers::UrlContent("~/views/blog/blog_single.php"));

				return $this->view();

			} else {
				$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));
				return $this->view();
			}

		}


	}

	public function category($keyword = false) {

		if (empty($keyword)) {
			$categories = $this->_model->getCategories();
			$this->setViewPath(MyHelpers::UrlContent("~/views/blog/categories.php"));
			$this->view->set('categories', $categories);
			$this->view->setTitle("WebMasterWill Blog Categories");
			return $this->view();
		}

		if (isset($_GET['page_num'])) {
    		$page_num = $_GET['page_num'];
	    } else {
	        $page_num = 1;
	    }

		$data = $this->_model->getPostsByCategory($keyword);

		$posts = $data['posts'];

		$categories = $this->_model->getCategories();

		if (!empty($posts)) {

			$title = "WebMasterWill Blog Category " . ucfirst($keyword);

			$totalPages = $data['total_pages'];

			$this->parseDown->setSafeMode(true);

			foreach ($posts as $key => $value) {
				$posts[$key]['content'] = $this->parseDown->text($posts[$key]['content']);
			}

			foreach ($posts as $key => $value) {
				$posts[$key]['tags'] = explode(',', $posts[$key]['tags']);
			}

			$categories = $this->_model->getCategories();

			$this->view->set('blog_posts', $posts);

			$this->view->set('categories', $categories);

			$this->view->set('total_pages', $totalPages);

			$this->view->setTitle($title);

			return $this->view();

		} else {
			$_SESSION['no-category'] = 'I have not written any post for that category yet. Soon I will though so be weary :).';
			$categories = $this->_model->getCategories();
			$this->setViewPath(MyHelpers::UrlContent("~/views/blog/categories.php"));
			$this->view->set('categories', $categories);
			$this->view->setTitle("WebMasterWill Blog Categories");
			return $this->view();
			
		}
	}

	public function date($keyword = false) {

		if (empty($keyword)) {
			$title = "WebMasterWill Blog Dates";
			$dates = $this->_model->getDates();
			$this->view->set('dates', $dates);
			$this->view->set('title', $title);
			return $this->view();
		}

		$keyword = strtotime($keyword);

		$nextMonth = strtotime('+1 month', $keyword);

		$date[0] = date('Y-m-d H:i:s', $keyword);

		$date[1] = date('Y-m-d H:i:s', $nextMonth);

		$data = $this->_model->getPostsByDate($date);

		if (!empty($data)) {

			$posts = $data['posts'];

			$totalPages = $data['total_pages'];

			$this->parseDown->setSafeMode(true);

			foreach ($posts as $key => $value) {
				$posts[$key]['content'] = $this->parseDown->text($posts[$key]['content']);
			}

			foreach ($posts as $key => $value) {
				$posts[$key]['tags'] = explode(',', $posts[$key]['tags']);
			}

			$date[0] = date('M', $keyword);

			$date[1] = date('Y', $keyword);

			$date = ['month'=> $date[0], 'year' => $date[1]];

			$title = "WebMasterWill Blog Posts by Date " . $date['month'] . " " . $date['year'];

			$this->view->set('title', $title);

			$this->view->set('date', $date);

			$categories = $this->_model->getCategories();

			$this->view->set('blog_posts', $posts);

			$this->view->set('categories', $categories);

			$this->view->set('total_pages', $totalPages);

			$this->setViewPath(MyHelpers::UrlContent("~/views/blog/category.php"));

			return $this->view();
		} else {

			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));
			return $this->view();
			
		}

		
	}

	public function search() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blog-search_button'])) {
			$user_input = $_POST['blog-search_user-input'];
			$searchResults = $this->_model->search($user_input);
			$this->view->set('searchResults', $searchResults);
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));

		}
	}

	
}