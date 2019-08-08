<?php 

	require_once('/../parts/head.view.php');
	
?>


<div class="login-page">

	<div class="login-form_container">

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
					<label for="email">Email</label>
					<input class="" type="text" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo htmlentities($_POST['email']);} unset($_POST['email']); ?>" />
				</div>
				
				<div class="login-input_cont">
					<label for="password">Password</label>
					<input class="" type="password" name="password" placeholder="Password" value="" />
				</div>
				
				<div class="login-buttons_cont">
					<div>
						<i class="fas fa-sign-in-alt"></i>
						<input type="submit" name="sign-in" value="Log In">
						<a href="<?php echo $cfg['site']['root']; ?>/sign-up"><i class="fas fa-user-plus"></i> Sign Up</a>
					</div>
				</div>
				
			</form>

			<?php unset($_SESSION['login-error']); ?>

		</div>

	</div> <!-- End of login-page -->

</div>

<?php 

	require_once('/../parts/foot.view.php');
	
?>
