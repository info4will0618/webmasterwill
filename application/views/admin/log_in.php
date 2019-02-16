<?php 
	$this->layout = '~/views/shared/_defaultLayout.php';

	$title = "WebMasterWill Admin Login"; 
?>

<div class="main-page">

	<h1>Admin Login</h1>

	<p>
		If you are not an admin, please respect this page and leave.
	</p>

	<div id="admin_form">

		<form action='<?php echo $cfg['site']['root']; ?>/admin-auth/log-in' method="POST">

			<?php if (isset($_SESSION['login-error'])): ?>
				<p class="form-error"><?php echo $_SESSION['login-error']; ?></p>
			<?php endif; ?>

			<label for="user_name">User Name</label>
			
			<input class="form-input_general admin-form_input" type="text" name="admin_name" placeholder="User Name" value="<?php if(isset($_SESSION['user-name'])){ echo htmlentities($_SESSION['user-name']);} unset($_SESSION['user-name']); ?>" />

			<input class="form-input_general admin-form_input" type="password" name="admin_password" placeholder="Password" value="" />

			<input type="submit" name="admin_login" value="Log In">

		</form>

		<?php unset($_SESSION['login-error']); ?>

	</div>
</div>