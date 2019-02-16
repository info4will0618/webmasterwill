<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';

	$title = "WebMasterWill"; 
?>

<div class="main-page">

	<h1>Viewing All Posts</h1>

	<p>Viewing post by something. Default Desc.</p>

	<div>
		<a href="<?php echo $cfg['site']['root']; ?>/admin/view-posts/category">View by category</a>
	</div>

	<?php foreach ($posts as $posts): ?>
		<p><?php echo $posts['title']; ?></p>
		<a href="<?php echo $cfg['site']['root']; ?>/admin/view-single-post/<?php echo $posts['title_clean']; ?>">view</a>
		<a href="<?php echo $cfg['site']['root']; ?>/admin/edit-single-post/<?php echo $posts['title_clean']; ?>">edit</a>
	<?php endforeach ?>
</div>