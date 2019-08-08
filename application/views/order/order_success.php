
<?php 

	$this->layout = '~/views/shared/_defaultLayout.php';
	
?>

<div id="home-page">
	<h1>
		Thank You For Placing Your Order At WebMasterWill
	</h1>
	<div>
		<h3>
			Here are your detail.
		</h3>

		<p>
			<?php echo $first_name; ?>
		</p>

		<p>
			<?php echo $last_name; ?>
		</p>

		<p>
			<?php echo $email; ?>
		</p>

		<p>
			<?php echo $payment_amount; ?>
		</p>
	</div>
</div>