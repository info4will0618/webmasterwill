
<?php 

	require_once('/../parts/head.view.php');
	
?>

<div class="main-page" id="">
	<?php if (!empty($_SESSION['user'])) { ?>
		<input id="user_logged_in" type="hidden" name="user_on_post_page" value=<?php echo $_SESSION['user']['id']; ?>>
		<input id="post_title" type="hidden" name="post_title" value=<?php echo $post['title_clean']; ?>>
	<?php } ?>
	<input id="post_id" type="hidden" name="post_id" value=<?php echo $post['id']; ?>>
	<div id="" class="blog-single">

		<h1 id="blog-single__post-title">
			<?php echo $post['title']; ?>
		</h1>

		<div class="blog-single__mid-container">
			<div id="single-post_first-container">
				<div class="single-post_meta">
					<div>
						<span>Category:</span>
						<a href="<?php echo $cfg['site']['root']; ?>/blog/category/<?php echo $post['cat_link'];?>">
							<?php echo $post['cat_name'] ?>
						</a>
					</div>
					<div>
						<span>Published:</span>
						<a href="<?php echo $cfg['site']['root']; ?>/blog/date/<?php echo date('M', strtotime($post['date_created'])) ?>-<?php echo date('Y', strtotime($post['date_created'])) ?>">
							<?php echo date('F/j/Y', strtotime($post['date_created'])); ?>
						</a>
					</div>
					<div>
						<span>Author:</span>
						<a href="<?php echo $cfg['site']['root']; ?>/about">William</a>
					</div>
				</div>
				<!-- <div class="single-post_tags">
					<span>Tags:</span>
					<?php foreach ($post['tags'] as $key => $value): ?>
						<?php echo $value; ?>
					<?php endforeach ?>
				</div> -->
				<div class="single-post_img">
					<img src="<?php echo $cfg['site']['root'] . '/public/dist/imgs' . $post['img_path'] . '/' .  $post['img_name'] . '.' . $post['img_ext']?>" alt="<?php echo $post['img_alt'] ?>">
				</div>

				<div class="single_post-content">
					<?php echo $post['content']; ?>
				</div>
				
			</div> <!-- End Of Post Container -->

			<p>
				<?php if (empty($_SESSION['user'])): ?>
					Log in to comment 
					<a href="<?php echo $cfg['site']['root']; ?>/login">
						log in
					</a>
				<?php endif ?>
			</p>

			<div class="add-comment_container" id="comment-form">
				<form role="form" class="add-comment_form" method="POST" action="<?php echo $cfg['site']['root'] . '/blog/post-comment' ?>">  

					<!-- Must be logged in to comment -->
					<p>
						<?php if (!empty($_SESSION['must-login'])) {
							echo $_SESSION['must-login'];
							unset($_SESSION['must-login']);
						} ?>
					</p>

					<!-- <input id="post_id" type="hidden" name="post_id" value=<?php echo $post['id']; ?>> -->

					<div class="add-comment_comment-contain"> <!-- Container for comment -->

						<div class="add-comment_label">
							<label for="comment">

								<p>Write a Comment</p>
								<p>(Don't be shy)</p>
								<p><i class="fas fa-pen"></i></p>
							</label>
						</div>
			
						<p>
							<?php if (!empty($_SESSION['must-comment'])) {
								echo $_SESSION['must-comment'];
								unset($_SESSION['must-comment']);
							} ?>
						</p>

						<textarea id="comment" name="comment" placeholder="Make Sure to be appropriate"  rows="10"><?php if(isset($_POST['comment'])){ echo htmlentities($_POST['comment']);}?></textarea>

					</div> <!-- End container for comment -->

					<button id="comment-button" class="comment-sent">
						<p >W</p>
						<input type="hidden" name="comment-sent">
					</button>

				</form>
			</div>

			<div class="comments_container">
				<h2><i class="fas fa-comments"></i> Comments <i class="fas fa-comments"></i></h2>
				<div id="comments">
					<?php foreach ($comments as $comment): ?>
						
						<div class="comment">
							<div class="comment-heading">
								<p class="comment-user">
									<a href="#"><i class="far fa-comment"></i> <?php echo $comment['user_name']; ?> says:</a>
								</p>
								<p class="comment-date">
									<?php echo $comment['date_created']; ?>
								</p>
							</div>
							<div class="comment_inner">
								<div class="reply-inner">
									<input id="<?php echo $comment['id'];?>" type="hidden" name="comment_id" value=<?php echo $comment['id'];?>>
									<p class="reply-body" id="<?php echo 'comment_'.$comment['id'] ?>">

										<?php $message = (strlen($comment['comment']) > 350) ? substr($comment['comment'], 0, 350) . ' <a href="#">read more</a>' : $comment['comment']; ?>


										<?php echo $message ?>
											
									</p>
									<div class="user-comment_functions">
										<?php if(!empty($_SESSION['user']) && $comment['user_id'] === $_SESSION['user']['id']) { ?>
										<div>
											<a class="delete-button" href="<?php echo $cfg['site']['root']; ?>/blog/comments/delete-comment?comment_id=<?php echo $comment['id'] ?>">
												Delete My Reply
											</a>
										</div>
										
										<div>
											<input id="<?php echo $comment['id'];?>" type="hidden" name="comment_id" value=<?php echo $comment['id'];?>>
											<a class="edit-button" href="<?php echo $cfg['site']['root']; ?>/blog/comments/update-comment?comment_id=<?php echo $comment['id'] ?>&comment=">
												Edit My Reply
											</a>
										</div>
										<?php } ?>
									</div>
									<?php if(!empty($_SESSION['user']) && ($comment['user_id'] === $_SESSION['user']['id'])) { ?>
									<div class="user-comment_functions-button">
										<a href="#" class="reply-icon-down comment-functions-icon">
											W
										</a>
									</div>
									<?php } ?>
									<?php if (!empty($_SESSION['user']) && ($comment['user_id'] !== $_SESSION['user']['id'])) { ?>
									<div class="user-comment_functions-button">
										<a href="#" class="report-icon comment-functions-icon">
											W
										</a>
									</div>
									<?php } ?>
								</div>

								<?php if (!empty($replies)) { ?>
									<div class="replies_container">
									<?php foreach ($replies as $reply) { 
										if($reply['repliesTo'] === $comment['id']) { ?>
											<div class="reply">
												<div class="comment-heading">
													<a>
														<i class="far fa-comments"></i> <?php echo $reply['user_name']; ?> replys:
													</a>
													<p class="comment-date">
														<?php echo $comment['date_created']; ?>
													</p>
												</div>
												
												<div class="reply-inner">
													<input id="<?php echo $reply['id'];?>" type="hidden" name="comment_id" value=<?php echo $reply['id'];?>>
													<p class="reply-body" id="<?php echo 'comment_'.$reply['id'] ?>">
														<?php echo substr($reply['comment'], 0, 350); ?>	
													</p>
													
													<div class="user-comment_functions">
														<?php if(!empty($_SESSION['user']) && $reply['user_id'] === $_SESSION['user']['id']) { ?>
														<div>
															<a class="delete-button" href="<?php echo $cfg['site']['root']; ?>/blog/comments/delete-comment?comment_id=<?php echo $reply['id'] ?>">
																Delete My Reply
															</a>
														</div>
														
														<div>
															<input id="<?php echo $reply['id'];?>" type="hidden" name="comment_id" value=<?php echo $reply['id'];?>>
															<a class="edit-button" href="<?php echo $cfg['site']['root']; ?>/blog/comments/update-comment?comment_id=<?php echo $comment['id'] ?>&comment=">
																Edit My Reply
															</a>
														</div>
														<?php } ?>
													</div>

													<?php if(!empty($_SESSION['user']) && ($reply['user_id'] === $_SESSION['user']['id'])) { ?>
													<div class="user-comment_functions-button">
														<a href="#" class="reply-icon-down comment-functions-icon">
															W
														</a>
													</div>
													<?php } ?>
													<?php if (!empty($_SESSION['user']) && ($reply['user_id'] !== $_SESSION['user']['id'])) { ?>
													<div class="user-comment_functions-button">
														<!-- <input type="hidden" name="report-id" value="<?php echo $reply['reportID']; ?>"> -->
														<a href="#" class="report-icon comment-functions-icon">
															W
														</a>
													</div>
													<?php } ?>
												</div>
											</div>
										<?php }  
									} ?>
									</div>
								<?php } ?>
								<?php if(!empty($_SESSION['user'])) { ?>
									<div class="reply_container">
										<input id="<?php echo $comment['id'];?>" type="hidden" name="comment_id" value=<?php echo $comment['id'];?>>
								<!-- 		<input id="<?php echo $_SESSION['user']['id'];?>" type="hidden" name="user_id" value=<?php echo $_SESSION['user']['id'];?>> -->
										<a href="#" class="reply-button"> 
											Reply To Comment
										</a>
										<?php 
											if ((isset($_SESSION['must-type'])) && ($_SESSION['reply-to'] === $comment['id'])) {
												echo $_SESSION['must-type'];
												unset($_SESSION['must-type']);
										}?>
										<?php 
											if ((!empty($_SESSION['comment-must-login'])) && ($_SESSION['reply-to'] === $comment['id'])) {
												echo $_SESSION['comment-must-login'];
												unset($_SESSION['comment-must-login']);
											}
									 	?>
									</div>
									<?php } else { ?>
									<div class="reply_container">
										<p>
											Must be <a href="<?php echo $cfg['site']['root']; ?>/login"><i class="far fa-user"></i> logged in </a> to reply or edit a comment
										</p>
									</div>
								<?php } ?>
							<!-- <a href="">View more replies</a> -->
						</div>
					</div><!-- End of Comment Container -->
						
					<?php endforeach ?>


						<!-- <div id="load-more-comments-container">
							<input type="hidden" name="comment_count" value="<?php echo $comment_count; ?>">
							<a id="load-more-comments-button" href="<?php echo $cfg['site']['root']; ?>/blog/comments/load-more/?lastCommentId=<?php echo $comment_count ?>">
								Load More Comments
							</a>
						</div>
 -->
					</div><!-- End of comments container -->
				</div> 
			</div> 

		</div> <!-- End of post flex container -->
	</div>
</div>

<script type="text/javascript" src="<?php echo $cfg['site']['root']; ?>/public/dist/comment.js"></script>

<?php 

	require_once('/../parts/foot.view.php');
	
?>


