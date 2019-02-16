<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';

	$title = "WebMasterWill"; 
?>

<div class="main-page">

	<h1><?php echo $post['title']; ?></h1>
	<div>
		<?php echo $post['content']; ?>
	</div>
</div>