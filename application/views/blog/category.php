<?php 
$this->layout = '~/views/shared/_blogLayout.php';
//$this->section['head']='<script src="http://code.jquery.com/jquery-latest.min.js"></script>'; 
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
		<?php if (!isset($blog_posts[0]['category'])): ?>
			<a href="#" id="go-back_category" class="goBackToPreviousPage">Go Back To Previous Page</a>
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
	
	<div id="blog-body_container">

		<div class="blog-categories">
			<h3 id="blog_categories-header">Blog Categories</h3>
			<?php foreach ($categories as $categories): ?>
				<a href="<?php echo $cfg['site']['root']; ?>/blog/category/<?php echo $categories['cat_link'];?>"><?php echo $categories['category']; ?></a>
			<?php endforeach ?>
		</div>

		<div id="posts_container">

			<?php foreach ($blog_posts as $key => $post): ?>

			<div class="post_container">
				<h2 class="post-title">
					<a href="<?php echo $cfg['site']['root']; ?>/blog/post/<?php echo $post['title_clean'] ?>"><?php echo $post['title'] ; ?></a>
				</h2>
				<div class="post-meta_container">
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

				<div class="post_content">
					<a href="<?php echo $cfg['site']['root']; ?>/blog/post/<?php echo $post['title_clean'] ?>" class="post-img">
						<img src="<?php echo $cfg['site']['root'] . '/public/dist/imgs/blog/' . $post['img'] ?>" alt="<?php echo $post['img_alt'] ?>">
					</a>
					<p>
						<?php echo substr($post['content'], 0, 350).', <a href='.$cfg['site']['root'].'/blog/post/'.$post['title_clean'].'>[...] Read More </a>';?>
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

			<?php include(MyHelpers::UrlContent('~/views/shared/components/_blog_pagination.php')); ?>
			
		</div>

	</div>
</div>