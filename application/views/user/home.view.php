<?php 

	require_once('/../parts/head.view.php');
	
?>

<h1>Welcome <?php echo $_SESSION['user']['first_name']; ?></h1>

<?php 

	require_once('/../parts/foot.view.php');
	
?>