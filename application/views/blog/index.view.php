<?php 

	require_once('/../parts/head.view.php');
	
?>

<div class="main-page">
	
	<h1 id="blog-index_h1">WebMasterWill Blog</h1>
	
	<div id="blog-index_container">

		<div class="blog-categories">
			<h3 id="blog_categories-header">Blog Categories</h3>
			<?php foreach ($categories as $categories): ?>
				<a href="<?php echo $cfg['site']['root']; ?>/blog/?cat_id=<?php echo $categories['cat_id'] ?>"><?php echo $categories['category']; ?></a>
			<?php endforeach ?>
		</div>

		<div id="posts_container">
			<?php if (!empty($blog_posts )) {
				
			foreach ($blog_posts as $key => $post): ?>

			<div class="post_container">
				<h2 class="post-title">
					<a href="<?php echo $cfg['site']['root']; ?>/blog/<?php echo $post['title_clean'] ?>?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ; ?></a>
				</h2>
				<div class="post-meta_container">
					<div>
						<span>Category:</span>
						<a href="<?php echo $cfg['site']['root']; ?>/blog/?category_id=<?php echo $categories['cat_id'] ?>">
							<?php echo $post['cat_name'] ?>
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

				<div class="post_content">
					<a href="<?php echo $cfg['site']['root']; ?>/blog/<?php echo $post['title_clean'] ?>" class="post-img">
						<img src="<?php echo $cfg['site']['root'] . '/public/dist/imgs' . $post['img_path'] . '/' .  $post['img_name'] . '.' . $post['img_ext']?>" alt="<?php echo $post['img_alt'] ?>">
					</a>
					<p>
						<?php echo substr($post['content'], 0, 350).' <a href='.$cfg['site']['root'].'/blog/'.$post['title_clean'].'?id='.$post['id'].'> [Read More ...] </a>';?>
					</p>
				</div>
				<div class="tags">
					<span>Tags:</span>
					<?php if (!empty($post['tags'])) { ?>
						<?php foreach ($post['tags'] as $key => $value): ?>
							<a href="#"><?php echo $value; ?></a>
						<?php endforeach ?>
					<?php } else { ?>
						<span><?php echo "No Tags"; ?></span>
					<?php } ?>
				</div>
				<div>
					
					<?php if (!empty($post['comment_count'])) { ?>
							<a href="<?php echo $cfg['site']['root']; ?>/blog/<?php echo $post['title_clean'] ?>?id=<?php echo $post['id'] ?>#comments">
								<span>Comments: </span><?php echo $post['comment_count']; ?></a>
					<?php } else { ?>
						<span><?php echo "No comments yet"; ?></span>
					<?php } ?>
				</div>
				
			</div> <?php endforeach ?>
			<?php } else { ?>
				<div class="post_container">
					<h2>No blog post for this category</h2>
				</div>
		<?php } ?>

		</div> <!-- End Of Posts Container -->

		<div id="blog-subscriber_container">
			<?php require_once('/components/subscribe.php'); ?>
		</div>  

	</div>
</div>


<?php 

	require_once('/../parts/foot.view.php');
	
?>