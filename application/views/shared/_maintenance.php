<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';
?>

<?php $title = "WebMasterWill Maintenance"; ?>

<div class="main-page" id="maintenance-page">
	<h1>Page Under Maintainance</h1>
	<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/shared/page_maintenance">
	<p>
		Hello there. If you are seeing this page it's because I'm still working on this page. Sorry for the inconvenience. If you have any concerns please message me. Thank you for understanding.
	</p>
	<a href="<?php echo $cfg['site']['root']; ?>/contact"> Contact Me </a>
<!-- 	<a href="<?php echo $cfg['site']['root']; ?>">Home Sweet Home</a>
 -->	<a href="" id="backButtonMaintenance">Back to previous page</a>
	
	<script type="text/javascript">

		var backButton = document.getElementById('backButtonMaintenance');
		backButton.addEventListener("click", goBack, false);
		function goBack(e) {
			e.preventDefault();
			window.history.back();
		}
	</script>
</div>