<?php 
	$this->layout = '~/views/shared/_blogLayout.php';
?>

<div class="main-page">
	
	<h1 id="blog-index_h1">WebMasterWill Blog</h1>
	
	<div id="blog-index_container">

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
						<?php echo substr($post['content'], 0, 350).' <a href='.$cfg['site']['root'].'/blog/post/'.$post['title_clean'].'>[...] Read More </a>';?>
					</p>
				</div>
				<div class="tags">
					<span>Tags:</span>
					<?php if (!empty($post['tags'])) { ?>
						<?php foreach ($post['tags'] as $key => $value): ?>
							<a href="#"><?php echo $value; ?></a>
						<?php endforeach ?>
					<?php } else { ?>
						<p><?php echo "No Tags"; ?></p>
					<?php } ?>
				</div>
				
			</div> <?php endforeach ?>

			<?php include(MyHelpers::UrlContent('~/views/shared/components/_blog_pagination.php')); ?>

		</div> <!-- End Of Posts Container -->

		<div id="blog-subscriber_container">
			<?php include(MyHelpers::UrlContent('~/views/blog/components/subscribe.php')); ?>
		</div>

	</div>
</div>