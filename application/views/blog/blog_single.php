<?php 

	$this->layout = '~/views/shared/_blogLayout.php';

?>

<div class="main-page">
	<div id="" class="">

		<h1 id="blog-single__post-title">
			<?php echo $post['title']; ?>
		</h1>

		<div class="blog-single__mid-container">
			<div id="single-post_first-container">
				<div class="single-post_meta">
					<div>
						<span>Category:</span>
						<a href="<?php echo $cfg['site']['root']; ?>/blog/category/<?php echo $post['cat_link'];?>">
							<?php echo $post['category'] ?>
						</a>
					</div>
					<div>
						<span>Published:</span>
						<a href="<?php echo $cfg['site']['root']; ?>/blog/date/<?php echo date('M', strtotime($post['date_created'])) ?>-<?php echo date('Y', strtotime($post['date_created'])) ?>"><?php echo date('F/j/Y', strtotime($post['date_created'])); ?></a>
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
				<div class="sinle-post_img">
					<img src="<?php echo $cfg['site']['root'] . '/public/dist/imgs/blog/' . $post['img'] ?>" alt="<?php echo $post['img_alt'] ?>">
				</div>

				<div>
					<?php echo $post['content']; ?>
				</div>
				
			</div> <!-- End Of Post Container -->

			<div class="add-comment_container">
				<form role="form" class="add-comment_form" method="POST" action="<?php echo $cfg['site']['root'] . '/comment'?>">  

					<!-- Must be logged in to comment -->
					<p>
						<?php if (!empty($_SESSION['must-login'])) {
							echo $_SESSION['must-login'];
							unset($_SESSION['must-login']);
						} ?>
					</p>

					<input type="hidden" name="post_id" value=<?php echo $post['id']; ?>>

					<div class="add-comment_comment-contain"> <!-- Container for comment -->

						<p class="">
							<label for="comment">Write a Comment:</label>
						</p>
			
						<p>
							<?php if (!empty($_SESSION['must-comment'])) {
								echo $_SESSION['must-comment'];
								unset($_SESSION['must-comment']);
							} ?>
						</p>

						<textarea name="comment" placeholder="Make Sure to be appropriate" id="comment" rows="10"><?php if(isset($_POST['comment'])){ echo htmlentities($_POST['comment']);}?></textarea>

					</div> <!-- End container for comment -->

					<input type="submit" name="comment-sent" value="Send" class="">

				</form>
			</div>

			<div class="comments_container">
				<h2>Comments</h2>
				<div>
					<?php foreach ($comments as $comment): ?>
						<div class="comment">
							<div class="comment-heading">
								<a class="comment-user"><?php echo $comment['user']; ?> says:</a>
								<p class="comment-date"><?php echo $comment['date_created']; ?></p>
							</div>
							
							<p class="comment-body"><?php echo substr($comment['comment'], 0, 350); ?></p><a href="">read more</a>
							<?php if (!empty($replies)) { 
								foreach ($replies as $reply) { 
									if($reply['repliesTo'] === $comment['id']) { ?>
										<div class="reply">
											<p class="reply-heading"><?php echo $reply['user']; ?> replys:</p>
											<p class="reply-body"><?php echo substr($reply['comment'], 0, 350); ?>	</p>
										</div>
								<?php }  
								} 
							}?>
							<a href="">View more replies</a>
						</div>
						
					<?php endforeach ?>
					<div class="reply-box" id="">
						<p id="reply-to-id">
							
						</p>
						<a class="reply-to-comment"> Reply </a>
						<?php 
							if ((isset($_SESSION['must-type'])) && ($_SESSION['reply-to'] === $comments['id'])) {
								echo $_SESSION['must-type'];
								unset($_SESSION['must-type']);
						}?>
						<?php 
							if ((!empty($_SESSION['comment-must-login'])) && ($_SESSION['reply-to'] === $comments['id'])) {
								echo $_SESSION['comment-must-login'];
								unset($_SESSION['comment-must-login']);
							}
					 	?>
					</div>
				</div>
			</div> <!-- End of comments container -->

		</div> <!-- End of post flex container -->
	</div>
</div>
