
<?php 
	$this->layout = '~/views/shared/_blogLayout.php';
?>

<div class="main-page" id="by-group_date-page">
	<div id="by-group_header">
		<h1 id="">WebMasterWill Post Dates</h1>
		<p>Sorting Dates by <i><b>Month</b></i></p>
	</div>
	<div id="by-group_dates">
		<?php foreach ($dates as $key => $value) {
			$dateObj   = DateTime::createFromFormat('!m', $value['month']);
			$monthName = $dateObj->format('F'); ?>
			<a href="<?php echo $cfg['site']['root']; ?>/blog/date/<?php echo date('M', strtotime($value['date_created'])) ?>-<?php echo date('Y', strtotime($value['date_created'])) ?>"><?php echo $monthName . " " . $value['year']?>;  </a>
			<p><?php echo $value['num_per_month'];?> posts for this month.</p>
		<?php } ?>
	</div>
	
</div>