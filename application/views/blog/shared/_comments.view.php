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

		<input id="post_id" type="hidden" name="post_id" value=<?php echo $post['id']; ?>>

		<input id="post_title" type="hidden" name="post_title" value=<?php echo $post['title_clean']; ?>>

		<div class="add-comment_comment-contain"> <!-- Container for comment -->

			<div class="add-comment_label">
				<label for="comment">
					Write a Comment (Don't be shy)
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
				<h2>Comments</h2>
				<div id="comments">
					<?php foreach ($comments as $comment): ?>
						
						<div class="comment">
							<div class="comment-heading">
								<p class="comment-user">
									<a href="#"><?php echo $comment['user_name']; ?> says:</a>
								</p>
								<p class="comment-date">
									<?php echo date('F/j/Y', strtotime($post['date_created'])); ?>
								</p>
							</div>
							<div class="comment_inner">
								<input id="<?php echo $comment['id'];?>" type="hidden" name="comment_id" value=<?php echo $comment['id'];?>>
								<p class="comment-body" id="<?php echo 'comment_'.$comment['id'] ?>">

									<?php $message = (strlen($comment['comment']) > 350) ? substr($comment['comment'], 0, 350) . ' <a href="#">read more</a>' : $comment['comment']; ?>


									<?php echo $message ?>
										
								</p>

								<?php if(!empty($_SESSION['user']) && $comment['user_id'] === $_SESSION['user']['id']) { ?>
									<div>
										<a href="<?php echo $cfg['site']['root']; ?>/blog/comments/delete-comment?comment_id=<?php echo $comment['id'] ?>">
											Delete My Comment
										</a>
									</div>
								<?php } ?>

								<?php if(!empty($_SESSION['user']) && $comment['user_id'] === $_SESSION['user']['id']) { ?>
									<div>
										<input id="<?php echo $comment['id'];?>" type="hidden" name="comment_id" value=<?php echo $comment['id'];?>>
										<a class="edit-button" href="<?php echo $cfg['site']['root']; ?>/blog/comments/update-comment?comment_id=<?php echo $comment['id'] ?>&comment=">
											Edit My Comment
										</a>
									</div>
								<?php } ?>
						
								<?php if (!empty($replies)) { 
									foreach ($replies as $reply) { 
										if($reply['repliesTo'] === $comment['id']) { ?>
											<div class="reply">
												<p class="reply-heading">
													<?php echo $reply['user_name']; ?> replys:
												</p>
												<p class="reply-body" id="<?php echo 'comment_'.$reply['id'] ?>">
													<?php echo substr($reply['comment'], 0, 350); ?>	
												</p>
												<?php if(!empty($_SESSION['user']) && $comment['user_id'] === $_SESSION['user']['id']) { ?>
												<div>
													<a href="<?php echo $cfg['site']['root']; ?>/blog/comments/delete-comment?comment_id=<?php echo $reply['id'] ?>">
														Delete My Reply
													</a>
												</div>
												<?php } ?>
												<?php if(!empty($_SESSION['user']) && $comment['user_id'] === $_SESSION['user']['id']) { ?>
												<div>
													<input id="<?php echo $reply['id'];?>" type="hidden" name="comment_id" value=<?php echo $reply['id'];?>>
													<a class="edit-button" href="<?php echo $cfg['site']['root']; ?>/blog/comments/update-comment?comment_id=<?php echo $comment['id'] ?>&comment=">
														Edit My Reply
													</a>
												</div>
												<?php } ?>
											</div>
									<?php }  
									} 
								} ?>
								<?php if(!empty($_SESSION['user']) && $comment['user_id'] === $_SESSION['user']['id']) { ?>
								<div class="reply_container">
									<input id="<?php echo $comment['id'];?>" type="hidden" name="comment_id" value=<?php echo $comment['id'];?>>
									<a href="#" class="reply-button"> 
										reply 
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
										Must be logged in to reply or edit a comment
									</p>
								</div>
							<?php } ?>
							<!-- <a href="">View more replies</a> -->
						</div>
					</div>
						
					<?php endforeach ?>
					</div>
				</div>
			</div> <!-- End of comments container -->

		</div> <!-- End of post flex container -->
	</div>
</div>

<script type="text/javascript" src="<?php echo $cfg['site']['root']; ?>/public/dist/comment.js"></script>