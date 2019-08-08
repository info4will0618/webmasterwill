
<?php 

	$this->layout = '~/views/shared/_defaultLayout.php';
	
?>

<div class="main-page">

	<h1>Self Portraits</h1>

	<div>
		<?php foreach ($portraitPics as $portraitFileName) { ?>
			<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/me/<?php echo $portraitFileName; ?>.jpg"></img>
		<?php } ?>
	</div>
	
</div>