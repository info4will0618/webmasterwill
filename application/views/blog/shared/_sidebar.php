
<div id="related-articles">
	<h3>Related Articles</h3>
	<ul>
		
		<?php foreach ($related_articles as $key => $value): ?>
		<li>	
			<a href="<?php echo $cfg['site']['root']; ?>/blog/post/<?php echo $post['title_clean'] ?>"><?php echo $value['title']; ?></a>
		</li>
		<?php endforeach ?>
	</ul>
	
</div>


<div class="blog-subscriber_container">
	<?php include(MyHelpers::UrlContent('~/views/shared/components/_subscription_form.php')); ?>
</div>
	
<!-- <div class="single-post_tags">
	<span>Tags:</span>
	<?php foreach ($post['tags'] as $key => $value): ?>
		<?php echo $value; ?>
	<?php endforeach ?>
</div> -->
	
