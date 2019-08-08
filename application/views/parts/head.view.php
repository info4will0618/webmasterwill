<!DOCTYPE HTML>
<html dir='ltr' xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<link rel="SHORTCUT ICON" href="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/components/webmasterwill2.ico" type="image/x-icon" />
	<link rel="ICON" href="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/components/webmasterwill2.ico" type="image/ico" />
	<?php if (empty($title)): $title = "WebMasterWill"; endif; ?>
	<?php if (empty($metaDesc)): $metaDesc = "A very awesome website"; endif; ?>
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $metaDesc; ?>"></meta>
	<meta http-equiv="Content-Type" content="Type=text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0;">
	<link href='<?php echo $cfg['site']['root']; ?>/public/dist/styles.css' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Rammetto+One' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Song+Myung" rel="stylesheet">
	<div id="fb-root"></div>
</head>
<body id="body">
<!-- <div class="testing">
	ok
</div> -->
<header>
<!-- 
	<div class="call-to-action_cont">
		<a href="<?php echo $cfg['site']['root']; ?>/web-designer-los-angeles-contact" id="call-to-action">
			<i class="fas fa-address-card"></i>
			<span></span>
		</a>
	</div> -->

	<div id="auth_cont">

		<?php if(isset($_SESSION['user']['logged-in'])) { ?>
			<div id="members_cont">
				<a href="" id="members-button">
					<i class="far fa-user"></i> WebMaster <?php echo $_SESSION['user']['first_name'] ?>
				</a> 
			</div>
			<div id="auth-button_cont">
				<a class="auth-buttons" href="<?php echo $cfg['site']['root']; ?>/user/sign-out"><i class="fas fa-home"></i> Profile</a>
				<a class="auth-buttons" href="<?php echo $cfg['site']['root']; ?>/user/sign-out"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
			</div>
		<?php } else { ?>
			<div id="members_cont">
				<a id="members-button" href="<?php echo $cfg['site']['root']; ?>/login"><i class="fas fa-users-cog"></i>Members</a>
			</div>
			<div id="auth-button_cont">
				<a class="auth-buttons" href="<?php echo $cfg['site']['root']; ?>/login"><i class="fas fa-sign-in-alt auth-icons"></i>log in</a>
				<a class="auth-buttons" href="<?php echo $cfg['site']['root']; ?>/sign-up"><i class="fas fa-user-plus auth-icons"></i>register</a>
			</div>
		<?php } ?>
	
	</div>
 	

	<div id="header_nav-button_div">

		<button id="header_nav-button_button">
			<p id="menu-w" class="menu_w">W</p>
			<!-- <i class="fas fa-bars"></i> -->
		</button>

	</div>
	
	
	<?php
		$pages = array();
		$pages["index"]="Home";
		$pages["about"]="About";
		$pages["blog"]="Blog";
		$pages["contact"]="Contact";	
		$pages["services"]="Services";
		$pages["reviews"]="Reviews";
	?>
	<nav id="header_nav-menu_nav">
		<ul id="header_nav-menu_ul">
			<li>
				<a href="/webmasterwill">
					<button id="header_nav-button_button">
						<p id="menu-w" class="menu_w">W</p>
						<!-- <i class="fas fa-bars"></i> -->
					</button>
				</a>
			</li>
			<li>
			</li>
			<li>
				<a href="/webmasterwill/web-designer-los-angeles-about">
					About
				</a>
			</li>
			<li>
				<a href="/webmasterwill/blog">
					Blog
				</a>
			</li>
			<li>
				<a href="/webmasterwill/website-design-resources">
					Resources
				</a>
			</li>
			<!-- <li>
				<a href="/webmasterwill/los-angeles-web-design-services">
					Services
				</a>
			</li> -->
			<li>
				<a href="/webmasterwill/web-designer-los-angeles-contact">
					Contact
				</a>
			</li>
		</ul>	
	</nav>	
	
</header>

<div id="wrapper_entire-body">

<div id="social-media_div">
	<div id="social-media_button-container">
		<a href="https://www.facebook.com/WebMasterWill1" target="_blank" class="social-media_buttons-a"><i class="fab fa-facebook-square social-icons"></i></a>
<!-- 		<a href="https://twitter.com/William36905222" class="social-media_buttons-a"><i class="fab fa-twitter-square social-icons"></i></a>
 --><!-- 		<a href="https://plus.google.com/108997567788519026365" class="social-media_buttons-a"><i class="fab fa-google-plus-square social-icons"></i></a>
 -->		<a href="https://www.instagram.com/webmasterwill/?hl=en" class="social-media_buttons-a"><i class="fab fa-instagram social-icons"></i></a>
	</div>
	<div id="social-handles">
		<a href="#" class="social-media_arrows social-media_handles-a" id="verticle_social-media_arrow">
			<i class="fas fa-angle-left social-media_handles-i"></i>
		</a>
		<a href="#" id="horizontal_social-media_arrow" class="social-media_arrows ">
			<i class="fas fa-arrow-alt-circle-down social-media_handles-i handle-icons "></i>
		</a>
		<a class="social-media_handles-a" href="#">
			<i class="fas fa-times-circle handle-icons"></i>
		</a>
	</div>
</div>		

<div id="middle">