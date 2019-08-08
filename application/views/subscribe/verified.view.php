<?php 

	require_once('/../parts/head.view.php');
	
?>

<div class="main-page" id="subscribed-thanks">
	
	<h1>Thank you. You have been verified <?php if (isset($_SESSION['user-info']['name'])): ?>
		<?php echo $_SESSION['user-info']['name'];?>
	<?php endif ?>
		
	</h1>

	<a href="<?php echo $cfg['site']['root']; ?>/blog" id="go-back_subscriber" class="goBackToPreviousPage">Go to blog</a>
		


</div>

<?php 

	require_once('/../parts/foot.view.php');
	
?>