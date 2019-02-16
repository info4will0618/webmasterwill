<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';

	$title = "WebMasterWill Admin Login"; 
?>

<div class="main-page">
	<h1>Viewing All Request</h1>

	<?php foreach ($request as $requests): ?>
		<p><?php echo $requests['first_name']; ?></p>
	<?php endforeach ?>
</div>