<?php 

	$this->layout = '~/views/shared/_defaultLayout.php';

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

			<form action='<?php echo $cfg['site']['root']; ?>/signup/register' method="POST">

				<?php if (isset($_SESSION['errors']['email'])): ?>
					<p class="form-error"><?php echo $_SESSION['errors']['email']; ?></p>
				<?php endif; ?>
				<div class="login-input_cont">
					<label for="user-name">User Name</label>
					<input class="" type="text" name="user-name" placeholder="User Name" value="<?php if(isset($_SESSION['user-name'])){ echo htmlentities($_SESSION['user-name']);} unset($_SESSION['user-name']); ?>" />
				</div>
				<?php if (isset($_SESSION['errors']['password'])): ?>
					<p class="form-error"><?php echo $_SESSION['errors']['password']; ?></p>
				<?php endif; ?>
				<div class="login-input_cont">
					<label for="password">Password</label>
					<input class="" type="password" name="user-password" placeholder="Password" value="" />
				</div>
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

			<?php unset($_SESSION['errors']); ?>

		</div>

	</div> <!-- End of login-page -->

</div>
