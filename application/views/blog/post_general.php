<?php 
	$this->layout = '~/views/shared/_blogLayout.php';
?>

<div class="main-page" id="by-group_both">
	<h1 id="">WebMasterWill Post</h1>

	<div class="by-group_about">
		<p>WebMasterWill Posts By: <i><b>Categories</b></i></p>
	</div>
	<div id="by-group_categories" class="by-group_sections">
		<?php foreach ($categories as $categories): ?>
			<a href="<?php echo $cfg['site']['root']; ?>/blog/category/<?php echo $categories['cat_link'];?>"><?php echo $categories['category']; ?></a>
			<p><?php echo $categories['category_description']; ?></p>
		<?php endforeach ?>
	</div>

	<div class="by-group_about">
		<p>WebMasterWill Posts By: <i><b>Month and Year</b></i></p>
	</div>
	<div id="by-group_dates" class="by-group_sections">
		<?php foreach ($dates as $key => $value) {
			$dateObj   = DateTime::createFromFormat('!m', $value['month']);
			$monthName = $dateObj->format('F'); ?>
			<a href="<?php echo $cfg['site']['root']; ?>/blog/date/<?php echo date('M', strtotime($value['date_created'])) ?>-<?php echo date('Y', strtotime($value['date_created'])) ?>"><?php echo $monthName . " " . $value['year']?>;  </a>
			<p><?php echo $value['num_per_month'];?> posts for this month.</p>
		<?php } ?>
	</div>
</div>

