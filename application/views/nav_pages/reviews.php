<?php 

	$this->layout = '~/views/shared/_defaultLayout.php';

?>

<div class="main-page" id="reviews-page">

	<h1>Reviews</h1>

	<p>
		Hey there. There are currently no reviews at the moment. I am working on getting this functionality started. Thanks for stopping by though!
	</p>

	<a href="" id="review_back" class="back-button">Back to previous page</a>

	<a href="<?php echo $cfg['site']['root']; ?>">Home</a>

	<script type="text/javascript">

		var backButton = document.getElementById('review_back');
		backButton.addEventListener("click", goBack, false);
		function goBack(e) {
			e.preventDefault();
			window.history.back();
		}
		

	
	</script>

</div>

