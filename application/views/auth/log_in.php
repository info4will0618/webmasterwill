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
				Sign up to join all the action! At webmasterwill I plan to get all the nerds together and make a huge impact in the tehcnology world.
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

			<form action='<?php echo $cfg['site']['root']; ?>/login/sign-in' method="POST">

				<?php if (isset($_SESSION['login-error'])): ?>
					<p class="form-error"><?php echo $_SESSION['login-error']; ?></p>
				<?php endif; ?>
				<div class="login-input_cont">
					<label for="user-name">User Name</label>
					<input class="" type="text" name="user-name" placeholder="User Name" value="<?php if(isset($_SESSION['user-name'])){ echo htmlentities($_SESSION['user-name']);} unset($_SESSION['user-name']); ?>" />
				</div>
				
				<div class="login-input_cont">
					<label for="password">Password</label>
					<input class="" type="password" name="user-password" placeholder="Password" value="" />
				</div>
				
				<div class="login-buttons_cont">
					<div>
						<input type="submit" name="sign-in" value="Log In">
						<a href="<?php echo $cfg['site']['root']; ?>/sign-up">Sign Up</a>
					</div>
				</div>
				
			</form>

			<?php unset($_SESSION['login-error']); ?>

		</div>

	</div> <!-- End of login-page -->

</div>
