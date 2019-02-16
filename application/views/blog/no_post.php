<?php 
	$this->layout = '~/views/shared/_blogLayout.php';
?>

<div class="main-page">
	<div id="no-post_container">
		<h1>Oh No! No posts yet here :O.</h1>

		<p class="paragraph-margin_gen">
			I'm so sorry. Either something is wrong with my backend system or I have not written any post yet on this category I created (so embarrassing).
		</p>

		<p class="paragraph-margin_gen">
			Please contact me and let me know about the problem and I'll fix it as soon as I can. Thank you!
		</p>

		<a href="<?php echo $cfg['site']['root']; ?>/contact" id="no-post_contact"> Contact me! </a>

		<p class="paragraph-margin_gen">Or go back to previous page :).</p>

		<a href="#" id="go-back_category" class="goBackToPreviousPage">Go Back To Previous Page</a>
		
	</div>


	<script type="text/javascript">
		
		var backButton = document.getElementById('go-back_category');

		backButton.addEventListener("click", goBack, false);

		function goBack(e) {
			e.preventDefault();
			window.history.back();
		}

	</script>

</div>