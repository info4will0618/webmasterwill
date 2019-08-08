<?php 

/*=================================================================== General Pages */

$key = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$key = explode('/', $key);


/* Pages */

$router->GET('', 'BlogController@index');

$router->GET('web-designer-los-angeles', 'PagesController@home');

$router->GET('/web-designer-los-angeles-about', 'PagesController@about');

$router->GET('/web-designer-los-angeles-contact', 'ContactController@index');

$router->POST('/contact/sent', 'ContactController@sent');
$router->GET('/contact/verify-captcha', 'ContactController@');


/* Services */


$router->GET('/los-angeles-web-design-services', 'ServicesController@index');

/* Resources */


$router->GET('/website-design-resources', 'ResourcesController@index');

/* Landing Pages */

$router->GET('/freelance web design los angeles', 'LandingPagesController@webDesignerLosAngeles');



/* ==================================================================================== BLOG FUNCTIONALITY */

$router->GET('/blog', 'BlogController@index');

$router->GET('/blog/{$id}', 'BlogController@show');


$router->GET("/blog/first-post/like", 'BlogController@PostLiked');

/* User Auth */

$router->GET("/sign-up", 'SignupController@index');
$router->GET("/login", 'SigninController@index');

$router->POST("/login/sign-in", 'SigninController@signin');
$router->GET("/user/sign-out", 'SigninController@signout');

$router->POST("/sign-up/register", 'SignupController@register');
$router->GET("/sign-up/approved", 'SignupController@approveAccount');


$router->GET("/user/profile", 'UserController@profile');

$router->POST("/subscribe", 'SubscribeController@subscribe');
$router->GET("/subscribe/approve-user", 'SubscribeController@approveUser');

// $router->POST('/blog/post-comment', 'CommentController@comment');


/* ==================================================================== JSON Pages */

$router->GET('/json', 'PagesController@json');

$router->POST('/blog/post-comment', 'CommentController@comment');

$router->POST('/blog/post-comment/ajax', 'CommentController@commentAjax');

$router->POST('/blog/reply-to-comment', 'CommentController@replyToComment');

$router->GET('/blog/comments/delete-comment', 'CommentController@deleteComment');

$router->POST('/blog/comments/edit-comment', 'CommentController@editComment');

$router->GET('/blog/comments/load-more-comments', 'CommentController@loadMoreComments');


/* Reporting Comments */

$router->POST('/blog/comments/report-comment', 'CommentController@reportComment');
$router->POST('/blog/comments/report-delete', 'ReportCommentController@deleteReport');

/* End Reporting Comments */

/* AJAX */

$router->POST('/blog/comments/ajax-edit', 'CommentController@ajaxEditComment');


if (count($key) > 4) {

	$router->POST("/blog/{$key[2]}/comments/{$key[4]}/reply", 'CommentsController@replyToComment');

}

if (count($key) > 3) {

	$router->GET("/blog/category/{$key[3]}", 'BlogController@category');

}

if (count($key) > 2) {

	$router->GET("/blog/{$key[2]}", 'BlogController@show');

}



