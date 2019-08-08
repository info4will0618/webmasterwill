
<?php 

	require_once('/../parts/head.view.php');
	
?>

<div class="main-page">

	<h1 id="blog-index_h1">WebMasterWill Blog</h1>

	<?php if (isset($date)) { ?>
		<p id="displaying-info">
			Displaying post in <?php echo $date['month']. ', ' . $date['year'];?>
		</p>	
	<?php } else { ?>
		
		<!-- <p id="displaying-info">
			Displaying post in category: <?php echo !empty($blog_posts[0]['category']) ? $blog_posts[0]['category'] : "Oops! I have not written any articles in the category you selected yet :/. Pretty soon I will though so don't be discouraged or disappointed. ;)."?> 
		</p>	
 -->
 	
		<?php if (empty($blog_posts[0])): ?>
			<p>
				No posts have been created for this category yet.
			</p>
			<a href="#" id="go-back_category" class="goBackToPreviousPage">
				Go Back To Previous Page
			</a>
		<?php endif ?>

	<?php }; ?>

	<script type="text/javascript">
		

		var backButton = document.getElementById('go-back_category');

		backButton.addEventListener("click", goBack, false);

		function goBack(e) {
			e.preventDefault();
			window.history.back();
		}


	</script>
	
	<div id="blog-index_container">

		<div class="blog-categories">
			<h3 id="blog_categories-header">Blog Categories</h3>
			<?php foreach ($categories as $categories): ?>
				<a href="<?php echo $cfg['site']['root']; ?>/blog/category/<?php echo $categories['cat_link'];?>?id=<?php echo $categories['cat_id'] ?>"><?php echo $categories['category']; ?></a>
			<?php endforeach ?>
		</div>

		<?php if (!empty($blog_posts)): ?>
			<div id="posts_container">

				<?php foreach ($blog_posts as $key => $post): ?>

				<div class="post_container">
					<h2 class="post-title">
						<a href="<?php echo $cfg['site']['root']; ?>/blog/<?php echo $post['title_clean'] ?>?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ; ?></a>
					</h2>
					<div class="post-meta_container">
						<div>
							<span>Category:</span>
							<a href="<?php echo $cfg['site']['root']; ?>/blog/category/<?php echo $post['cat_link'];?>">
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
						<?php foreach ($post['tags'] as $key => $value): ?>
							<?php echo $value; ?>
						<?php endforeach ?>
					</div>
					
				</div>

				<?php endforeach ?>
				
			</div>
			<?php endif ?>
			
			<div id="blog-subscriber_container">
				<?php require_once('/components/subscribe.php'); ?>
			</div> 
				

	</div>
</div>

<?php 

	require_once('/../parts/foot.view.php');
	
?>
