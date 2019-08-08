<?php

namespace WebMasterWill\Application\Controllers;

use Carbon\Carbon;
use WebMasterWill\Library\Core\App;
use WebMasterWill\Library\Core\Controller;
use WebMasterWill\Library\Custom\Parsedown\Parsedown;

class BlogController extends Controller {   

	protected $parseDown;
	public $timeElapse;

	function __construct($model) {
		parent::__construct();
		$this->model = $model;	
		$this->parseDown = new Parsedown();
	}

	public function index() {

		$title = "WebMasterWill Blog";

		if (!empty($_GET['cat_id'])) {
			$categoryID = $_GET['cat_id'];
		} else {
			$categoryID = false;
		}

		$data = $this->model->getMostRecentPosts($categoryID);

		$totalPages = $data['total_pages'];

		$posts = $data['posts'];

		$categories = $this->model->getCategories();

		if (!empty($posts)) {

			// $this->parseDown->setSafeMode(true);

			foreach ($posts as $key => $value) {
				$posts[$key]['content'] = $this->parseDown->text($posts[$key]['content']);
			}

			foreach ($posts as $key => $value) {
				$posts[$key]['tags'] = array_filter(explode(',', $posts[$key]['tags']));
			}

			// $this->db = $this->db->close();
			
			return view('blog/index', ['title' => $title, 'blog_posts' => $posts, 'categories' => $categories, 'total_pages' => $totalPages, 'cfg' => $this->cfg]);

		} else {
			return view('blog/index', ['title' => $title, 'categories' => $categories, 'total_pages' => $totalPages, 'cfg' => $this->cfg]);
		}

	}

	public function show() {

		$id = $_GET['id'];

		$categories = $this->model->getCategories();

		$data['posts'] = $this->model->getSpecificPost($id);

		$comments = $this->model->getComments($id);

		foreach ($comments as &$comment) {

			$dt = Carbon::parse($comment['date_created']);

			$comment['date_created'] = $dt->diffForHumans();

		}

		$commentCount = count($comments);

		$replies = $this->model->getReplies($id);

		// $data['related_articles'] = $this->model->getRelatedArticles($keyword);

		if (!empty($data)) {

				$title = $data['posts']['title'] . " | WebMasterWill";

				$data['posts']['content'] = $this->parseDown->text($data['posts']['content']);

				$post = $data['posts'];

				return view('blog/single', ['post' => $post, 'comments' => $comments, 'comment_count' => $commentCount, 'replies' => $replies, 'cfg' => $this->cfg]);

			} else {
				return view('parts/_404', ['cfg' => $this->cfg]);
			}
	}

	public function post($keyword = false) {

		if (empty($keyword)) {
			$title = "WebMasterWill Posts Search";
			$categories = $this->model->getCategories();
			$dates = $this->model->getDates();
			$this->view->set('dates', $dates);
			$this->view->set('categories', $categories);
			$this->view->set('title', $title);
			$this->setViewPath(MyHelpers::UrlContent("~/views/blog/post_general.php"));
			return $this->view();
		} else {

			$data['posts'] = $this->model->getSpecificPost($keyword);

			$data['related_articles'] = $this->model->getRelatedArticles($keyword);

			$comments = $this->model->getComments($data['posts']['id']);

			$replies = $this->model->getReplies($data['posts']['id']);

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

	public function category() {


		if (isset($_GET['id'])) {

    		$cat_id = $_GET['id'];
	    
	    	$data = $this->model->getPostsByCategory($cat_id);

	    	$posts = $data['posts'];

	    	$totalPages = $data['total_pages'];

	    	$categories = $this->model->getCategories();

	    	if (!empty($posts)) {
	    		foreach ($posts as $key => $value) {
				$posts[$key]['content'] = $this->parseDown->text($posts[$key]['content']);
				}

				foreach ($posts as $key => $value) {
					$posts[$key]['tags'] = explode(',', $posts[$key]['tags']);
				}
	    	}

	    	return view('blog/category', ['cfg' => $this->cfg, 'blog_posts' => $posts, 'categories' => $categories, 'total_pages' => $totalPages]);

		} 
		// if (isset($_GET['page_num'])) {
  //   		$page_num = $_GET['page_num'];
	 //    } else {
	 //        $page_num = 1;
	 //    }

		// $data = $this->model->getPostsByCategory($keyword);

		// $posts = $data['posts'];

		// $categories = $this->model->getCategories();

		// if (!empty($posts)) {

		// 	$title = "WebMasterWill Blog Category " . ucfirst($keyword);

		// 	$totalPages = $data['total_pages'];

		// 	$this->parseDown->setSafeMode(true);

			// foreach ($posts as $key => $value) {
			// 	$posts[$key]['content'] = $this->parseDown->text($posts[$key]['content']);
			// }

			// foreach ($posts as $key => $value) {
			// 	$posts[$key]['tags'] = explode(',', $posts[$key]['tags']);
			// }

		// 	$categories = $this->model->getCategories();

		// 	$this->view->set('blog_posts', $posts);

		// 	$this->view->set('categories', $categories);

		// 	$this->view->set('total_pages', $totalPages);

		// 	$this->view->setTitle($title);

		// 	return $this->view();

		else {
			return view('parts/_404', ['cfg' => $this->cfg]);
		}
	}

	public function date($keyword = false) {

		if (empty($keyword)) {
			$title = "WebMasterWill Blog Dates";
			$dates = $this->model->getDates();
			$this->view->set('dates', $dates);
			$this->view->set('title', $title);
			return $this->view();
		}

		$keyword = strtotime($keyword);

		$nextMonth = strtotime('+1 month', $keyword);

		$date[0] = date('Y-m-d H:i:s', $keyword);

		$date[1] = date('Y-m-d H:i:s', $nextMonth);

		$data = $this->model->getPostsByDate($date);

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

			$categories = $this->model->getCategories();

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
			$searchResults = $this->model->search($user_input);
			$this->view->set('searchResults', $searchResults);
			$this->setViewPath(MyHelpers::UrlContent("~/views/shared/_404.php"));

		}
	}

	
}