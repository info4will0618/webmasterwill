<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';
?>

<div class="main-page" id="subscribed-thanks">
	
	<h1>Thanks For Subscribing <?php if (isset($_SESSION['user-info']['name'])): ?>
		<?php echo $_SESSION['user-info']['name'];?>
	<?php endif ?></h1>

	<p>
		Thanks for subscribing to my blog fellow future webmaster. I have sent an email verification link to the address you specified: <?php if (isset($_SESSION['user-info']['email'])): ?>
		<?php echo $_SESSION['user-info']['email']?>
		<?php endif; 

			unset($_SESSION['user-info']);

		?>. 
	Make sure you click on that link to verify your email so you can get informed with all the awesome content I will be putting out.
	</p>
	<p>
		Once you verify your email be sure to keep a lookout for any new post. Remember, awareness is the key to victory and keeping up with information that can be vital for your career and/or business!
	</p>

	<a href="#" id="go-back_subscriber" class="goBackToPreviousPage">Go Back To Previous Page</a>
		
	<script type="text/javascript">
		
		var backButton = document.getElementById('go-back_subscriber');

		backButton.addEventListener("click", goBack, false);

		function goBack(e) {
			e.preventDefault();
			window.history.back();
		}
	</script>

</div>