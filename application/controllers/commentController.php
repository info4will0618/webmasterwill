<?php 

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Controller;

class CommentController extends Controller {

	protected $cfg;

	function __construct($model) {
		$this->model = $model;		

		global $cfg;

        $this->cfg = $cfg;
	}

	public function comment() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$key = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$key = explode('/', $key);
			$post_title = $_POST['post_title'];
			$post_id = (int)$_POST['post_id'];
			$comment = $_POST['comment'];

			// Check if user has logged in

			if (!empty($_SESSION['user']) && $_SESSION['user']['logged-in'] === true) {

				// $lastComment = (int)$_GET['last-comment'];
				$user = $_SESSION['user']['id'];
				// $email = $_SESSION['email'];

				sanitize_input($comment, $post_id, $user);

				if (!empty($comment)) {

					$this->model->postComment($comment, $post_id, $user);
					// redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$post_id.'#comments-'.$lastComment);
					// $replies = $this->model->retrieveReplies($post_id);
					// $data = $this->model->showOne($post_id);
					redirect("/localhost".$this->cfg['site']['root']."/blog/" .$post_title. "?id=".$post_id."#comment-form".$key[5]);

				} else {

					$_SESSION['must-comment'] = "<span class='contact-errors'> * Come on, write at least one word before sending a comment ! * </span>";

					redirect("/localhost".$this->cfg['site']['root']."/blog/" .$post_title. "?id=".$post_id."#comment-form".$key[5]);

				}

			} // If not logged in redirect to page with error message

			else {

				$_SESSION['must-login'] = "<p class='must-login'> * Sorry, but you must be logged in in order to do this! * <a href='".$this->cfg['site']['root']."/login'> Log In </a></p>";

				redirect("/localhost".$this->cfg['site']['root']."/blog/" .$post_title.'?id='.$post_id."#comment-form");

			}
		} else {
			return view('parts/_404', ['cfg' => $this->cfg]);
		}
		
	}

	public function commentAjax() {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$key = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$key = explode('/', $key);
			$post_title = $_POST['post_title'];
			$post_id = (int)$_POST['post_id'];
			$comment = $_POST['comment'];


			// Check if user has logged in

			if (!empty($_SESSION['user']) && $_SESSION['user']['logged-in'] === true) {

				// $lastComment = (int)$_GET['last-comment'];
				$user = $_SESSION['user']['id'];
				// $email = $_SESSION['email'];

				sanitize_input($comment, $post_id, $user);

				if (!empty($comment)) {

					$this->model->postComment($comment, $post_id, $user);
					// redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$post_id.'#comments-'.$lastComment);
					// $replies = $this->model->retrieveReplies($post_id);
					// $data = $this->model->showOne($post_id);

				} else {

					$_SESSION['must-comment'] = "<span class='contact-errors'> * Come on, write at least one word before sending a comment ! * </span>";

					echo "a string";

					// redirect("/localhost".$this->cfg['site']['root']."/blog/" .$post_title. "?id=".$post_id."#comment-form".$key[5]);

				}

			} // If not logged in redirect to page with error message

			else {

				$_SESSION['must-login'] = "<p class='must-login'> * Sorry, but you must be logged in in order to do this! * <a href='".$this->cfg['site']['root']."/login'> Log In </a></p>";

				echo $_SESSION['must-login'];


			}

		} else {
			return view('parts/_404', ['cfg' => $this->cfg]);
		}
	}

	public function replyAjax() {

		

		// $key = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		// $key = explode('/', $key);
		
		// $post_id = $_POST['post_id'];
		// $parent_id = $_GET['reply_id'];
		// $_SESSION['reply-to'] = $_GET['reply_id'];

		// print_r($key);

		// // Check if user has logged in

		// if (!empty($_SESSION['user']) && ($_SESSION['user']['logged-in'] === true)) {
		// 	if ($_POST['sent-reply'] && (!empty($_POST['reply_body'])) ) {
		// 		$reply = $_POST['reply_body'];
		// 		$user_id = $_SESSION['user_id'];
		// 		sanitize_input($user_id, $post_id, $parent_id, $reply);
		// 		$this->model->insertReply($user_id, $post_id, $parent_id, $reply);
		// 		redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$_POST['post_id'].'#comments-'.$parent_id);
		// 	} else {
		// 		$_SESSION['must-type'] = "<p class='must-type'> * You must at least type something! *";
		// 		redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$_POST['post_id'].'#replybox-'.$parent_id);
		// 	}
		// } 

		// // If not logged in redirect to page with error message

		// else {
		// 	$_SESSION['comment-must-login'] = "<p class='must-login_2 must-login_addMargin'> * Sorry, but you must be logged in in order to do this! * <a href='/custommvc2/signin'> Log In </a></p>";
		// 	redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$_POST['post_id'].'#replybox-'.$parent_id);
		// }
		

	}



	public function editComment() {

		if (!empty($_SESSION['user']) && $_SESSION['user']['logged-in'] === true) {

			$id = sanitize_input($_POST['comment_id']);

			$comment = sanitize_input($_POST['comment_body']);

			$this->model->updateMyComment($id, $comment);
		} else {
			echo "you need to log in ij order to do this";
		}

	}

	public function ajaxEditComment() {

		if (!empty($_SESSION['user']) && $_SESSION['user']['logged-in'] === true) {

			$id = sanitize_input($_POST['comment_id']);

			$comment = sanitize_input($_POST['comment_body']);

			$this->model->updateMyComment($id, $comment);

			echo "true";
		} else {
			$_SESSION['must-login'] = "<p class='must-login'> * Sorry, but you must be logged in in order to do this! * <a href='".$this->cfg['site']['root']."/login'> Log In </a></p>";
			echo false;
		}

	}

	public function deleteComment() {

		$id = sanitize_input($_GET['comment_id']);

		$didItWork = $this->model->deleteMyComment($id);

	}


	public function replyToComment() {


		$key = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$key = explode('/', $key);
		
		$post_id = $_POST['post_id'];
		$parent_id = $_POST['reply_id'];
		$post_title = $_POST['post_title'];
		$_SESSION['reply-to'] = $_POST['reply_id'];

		// Check if user has logged in

		if (!empty($_SESSION['user']) && ($_SESSION['user']['logged-in'] === true)) {
			if ((!empty($_POST['reply_body'])) ) {
				$reply = $_POST['reply_body'];
				$user_id = $_SESSION['user']['id'];
				sanitize_input($user_id, $post_id, $parent_id, $reply);
				$this->model->insertReply($user_id, $post_id, $parent_id, $reply);
				// redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$_POST['post_id'].'#comments-'.$parent_id);
			} else {
				$_SESSION['must-type'] = "<p class='must-type'> * You must at least type something! *";
				// redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$_POST['post_id'].'#replybox-'.$parent_id);
			}
		} 

		else {

			$_SESSION['comment-must-login'] = "<p class='must-login_2 must-login_addMargin'> * Sorry, but you must be logged in in order to do this! * <a href='/custommvc2/signin'> Log In </a></p>";
			// redirect('/localhost/webmasterwill/blog/'.$post_title.'?id='.$_POST['post_id'].'#replybox-'.$parent_id);

		}
		

	}

	public function reportComment() {
		
		if (!empty($_SESSION['user']) && $_SESSION['user']['logged-in'] === true) {

			$post_id = sanitize_input($_POST['post_id']);

			$comment_id = sanitize_input($_POST['comment_id']);

			$user_id = sanitize_input($_POST['user_id']);

			$reportedAlready = $this->model->checkReport($post_id, $comment_id, $user_id);

			if ($reportedAlready > 0) {

				echo "Your have already reported this comment. Want to change your reason or delete report?";

			} else {

				$this->model->reportComment($post_id, $comment_id, $user_id);

			}
 
		}
	}

	public function loadMoreComments() {

		$comment_count = $_GET['comment_count'];
		$post_id = $_GET['post_id'];

		$comments = $this->model->loadMoreComments($post_id, $comment_count);

		$replies = $this->model->getReplies($post_id);

		$data = ['comments' => $comments, 'replies' => $replies];

		extract($data);

		echo json_encode($data);

// 		foreach ($comments as $comment) {
// 		$string = <<< EOT
// 				Hye {$comment['id']}
// EOT;
// 		}

// 		echo $string;

		// echo json_encode($comments);

		// echo json_encode($replies);

	}

}

