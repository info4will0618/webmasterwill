<?php 
$this->layout = '~/views/shared/_defaultLayout.php';
?>

<?php $title = "WebMasterWill Page Not Found" ?>

<div class="main-page fill-page" id="not-found_page">

	<div id="not-found_inner">

		<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/shared/404.jpg" alt="Oops! Page not found in this website." id="not-foung_img" />

		<p>Oh no! The URL or link does not exist in this website. You can go back to the previous page here:</p>
		<a href="<?php echo $cfg['site']['root']; ?>/contact">Contact Me</a>
		<a href="" id="backButton404">Back to previous page</a>

<!-- 		<p>Or go back to home sweet home here :-) : </p><a href="<?php echo $cfg['site']['root']; ?>">Home Sweet Home</a>
 -->
	</div>
	
	<script type="text/javascript">

	var backButton = document.getElementById('backButton404');
	backButton.addEventListener("click", goBack, false);
	function goBack(e) {
		e.preventDefault();
		window.history.back();
	}

	</script>
	
</div>