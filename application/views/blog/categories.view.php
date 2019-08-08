<?php 
	$this->layout = '~/views/shared/_blogLayout.php';
?>

<div class="main-page" id="by-group_category-page">
	<div id="by-group_header">
		<h1 id="">WebMasterWill Categories</h1>
		<p>Displaying all WebMasterWill <i><b>Categories</b></i></p>
	</div>
	
		<?php if (!empty($_SESSION['no-category'])): ?>
		<div class="margin-bottom_gen">
			<?php echo $_SESSION['no-category']; unset($_SESSION['no-category'])?>
		</div>
		<?php endif;?>
	
	<div id="by-group_categories">
		<?php foreach ($categories as $categories): ?>
			<a href="<?php echo $cfg['site']['root']; ?>/blog/category/<?php echo $categories['cat_link'];?>"><?php echo $categories['category']; ?></a>
			<p><?php echo $categories['category_description']; ?></p>
		<?php endforeach ?>
	</div>
</div>