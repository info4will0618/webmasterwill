<!-- 
<img id="" src="/webmasterwill/public/dist/imgs/lines.png" style="width: 300px; height: 300px; position: absolute; right: 0; top: 0; z-index: 100;"> -->

<header>

<!-- 	<a href="<?php echo $cfg['site']['root']; ?>/contact" id="call-to-action">
		<i class="fas fa-phone"></i>
		<span>Contact Me</span>
	</a> -->

	<div id="auth_cont">

		<?php if(isset($_SESSION['logged-in'])) { ?>
			<div>
				<a href="">
					Welcome <?php $x = isset($_SESSION['user']['user-name']) ? $_SESSION['user']['user-name'] : 'Master'; echo $x;?>
				</a>
				<a href="<?php echo $cfg['site']['root']; ?>/login/signout">Sign Out</a>
			</div>
		<?php } else { ?>
			<div id="members_cont">
				<a id="members-button" href="<?php echo $cfg['site']['root']; ?>/login"><i class="fas fa-users-cog"></i>Members</a>
			</div>
			<div id="auth-button_cont">
				<a href="<?php echo $cfg['site']['root']; ?>/login"><i class="fas fa-sign-in-alt auth-icons"></i>log in</a>
				<a href="<?php echo $cfg['site']['root']; ?>/sign-up"><i class="fas fa-user-plus auth-icons"></i>register</a>
			</div>
		<?php } ?>
	
	</div>

	<div id="header_nav-button_div">

		<button id="header_nav-button_button">
			<p id="menu-w" class="menu_w">W</p>
			<!-- <i class="fas fa-bars"></i> -->
		</button>

	</div>
	
	<?php include(MyHelpers::UrlContent('~/views/shared/_menuPart.php')); ?>
	
</header>	

