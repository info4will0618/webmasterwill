<?php 

	require_once('/../parts/head.view.php');
	
?>

<div id="contact-success" class="main-page">

	<h1>Thank you for your message <?php echo $name; ?>!</h1>
	<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/74-delivery-3.png">
	<div class="success_intro">
		<p>
			I have received your message and have sent you a confirmation email to your inbox.
		</p>

		<p>
			I will reach you as soon as I can with the contact info you provided me with.
		</p>

		<p>
			Here is the contact information you provided me with:
		</p>
	</div>

	<div class="success_info">
		<h3>
			Email: 
		</h3>
		<p>
			<?php echo $email; ?>
		</p>
		<h3>
			Message:
		</h3>
		<p>
			<?php echo $message; ?>
		</p>
	</div>

	<div>
		<p>
			If there is any mistake, please don't hesitate to message me again. 
		</p>
		<p>
			I will gladly respond to your most recent message. Once again thank you. Talk to you soon.
		</p>
	</div>

</div>


<?php 

	require_once('/../parts/foot.view.php');
	
?>