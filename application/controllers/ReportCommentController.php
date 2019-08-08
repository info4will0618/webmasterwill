<?php 

namespace WebMasterWill\Application\Controllers;

use WebMasterWill\Library\Core\Controller;

class ReportCommentController extends Controller {

	protected $cfg;

	function __construct($model) {
		$this->model = $model;		

		global $cfg;

        $this->cfg = $cfg;
	}

	function deleteReport() {

		$post_id = sanitize_input($_POST['post_id']);

		$comment_id = sanitize_input($_POST['comment_id']);

		$user_id = sanitize_input($_POST['user_id']);

		$this->model->deleteReportComment($post_id, $comment_id, $user_id);

	}
}