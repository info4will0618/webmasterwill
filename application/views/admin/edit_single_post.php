<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';

	$title = "WebMasterWill"; 
?>

<div class="main-page">

	<input type="text" value="<?php echo $post['title']; ?>"></input>
	<textarea>
		<?php echo $post['content']; ?>
	</textarea>
</div>