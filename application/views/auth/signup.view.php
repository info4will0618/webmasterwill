<?php 

	require_once('/../parts/head.view.php');
	
?>


<div class="main-page login-page">

	<div class="login-inner">

		<div class="login-logo_cont">
			<a href="<?php echo $cfg['site']['root']; ?>/about" id="">
				<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/<?php echo $cfg['site']['logo']; ?>">
			</a>
		</div>

		<div class="login-info_cont">
			<p>
				"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
			</p>
		</div>

		<div class="login-form_cont">

			<?php if (isset($_SESSION['message'])) { ?>
				<div>
					<p>
						<?php echo $_SESSION['message']; ?>
					</p>
				</div>
			<?php } ?>

			<form action='<?php echo $cfg['site']['root']; ?>/sign-up/register' method="POST">
				<?php if (isset($_SESSION['errors']['mismatch'])): ?>
					<p class="form-error"><?php echo $_SESSION['errors']['mismatch']; ?></p>
				<?php endif; ?>
				<div class="login-input_cont">
					<label for="email">
						<span>E-mail: </span>
						<!-- <i class="fa fa-asterisk" aria-hidden="true"></i> -->
						<?php if (isset($_SESSION['errors']['email'])) {echo '<p class="form-error">'.$_SESSION['errors']['email'].'</p>';} ?>
					</label>
					<input type="email" name="email" placeholder="Email" id="email" value="<?php if(isset($_POST['email'])){ echo htmlentities($_POST['email']);}?>" />
					
				</div>
				<?php if (isset($_SESSION['errors']['first-name'])): ?>
					<p class="form-error"><?php echo $_SESSION['errors']['first-name']; ?></p>
				<?php endif; ?>
				<div class="login-input_cont">
					<label for="first-name">First Name</label>
					<input class="" type="text" name="first-name" placeholder="First Name" value="<?php if(isset($_POST['first-name'])){ echo htmlentities($_POST['first-name']);} ?>" />
				</div>
				<?php if (isset($_SESSION['errors']['password'])): ?>
					<p class="form-error"><?php echo $_SESSION['errors']['password']; ?></p>
				<?php endif; ?>
				<div class="login-input_cont">
					<label for="password">Password</label>
					<input class="" type="password" name="password" placeholder="Password" value="" />
				</div>
				<?php if (isset($_SESSION['errors']['confirm'])): ?>
					<p class="form-error"><?php echo $_SESSION['errors']['confirm']; ?></p>
				<?php endif; ?>
				<div class="login-input_cont">
					<label for="confirm">Confirm Password</label>
					<input class="" type="password" name="confirm" placeholder="Confirm Password" value="" />
				</div>
				<div class="login-buttons_cont">
					<div>
						<input type="submit" name="sign-up" value="Register">
					</div>
				</div>
				
			</form>

			<?php unset($_POST); ?>

			<?php unset($_SESSION['errors']); ?>

		</div>

	</div> <!-- End of login-page -->

</div>

<?php 

	require_once('/../parts/foot.view.php');
	
?>
