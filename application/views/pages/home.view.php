
<?php 

	require_once('/../parts/head.view.php');
	
?>

<div id="home-page">

	<button id="back-to-top">
		<i class="far fa-hand-point-up" id="to-top_i"></i>
	</button>

	<div id="home-page_main">

		<div id="home-page_main-section">
			
			<div>
				<a href="<?php echo $cfg['site']['root']; ?>/web-designer-los-angeles-about" id="site-logo">
					<img id="wmw_logo" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/<?php echo $cfg['site']['logo']; ?>">
				</a>
			</div>
			
			<h1>
				<?php echo $cfg['site']['name']; ?>
			</h1>	

			<div class="hero-quote">
				<h2>
					Not Just Websites, Websites That Sell
				</h2>
				<h3>
					<b>Websites That Make People Want To Buy From You, Guaranteed Or Your Money Back</b>
				</h3>
			</div>

		</div>

		<div class="home-page_ul_container">
			<ul class="home-page_ul">
				<li>
					<div class="home-page_icon_cont">
						<i class="fas fa-dollar-sign home-page_icon"></i>
					</div>
					<b>Selling strategies that get people highly interested in your products/services and make them want to buy from you</b>
				</li>
				<li>
					<div class="home-page_icon_cont">
						<i class="fas fa-ban home-page_icon"></i>
					</div>
					<b>No need to know anything technical about websites. I'll make everything as simple as possible.</b>
				</li>
				<li>
					<div class="home-page_icon_cont">
						<i class="fas fa-chart-line home-page_icon"></i>
					</div>
					<b>100% money back guarantee - If no results or value, I'll give you your money back.</b>
				</li>
			</ul>
		</div>
<!-- 
		<div class="main_cartoon">
			<figure class="">
				<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/home_page/dollar.png">
				<figcaption>"Don't just settle for any website, get a website that sells!"</figcaption>
			</figure>
		</div> -->
		
		<div class="home-buttons">
			<div class="home-consultation">
				<a href="<?php echo $cfg['site']['root']; ?>/web-designer-los-angeles-contact">
					<i class="far fa-calendar-check action_icon"></i>
					Free Advice - Call Me Now
				</a>
				<a href="<?php echo $cfg['site']['root']; ?>/los-angeles-web-design-services">
					<i class="fas fa-file-contract action_icon"></i>
					My Service
				</a>
			</div>
		</div>
		<!-- <div class="keep_reading">
			<a id="hp_link-1" href="">
				<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
			</a>
		</div> -->

	</div>

	<div id="home-page_content">
		

		<?php require_once('home_content.view.php'); ?>
		
			
	</div> <!-- home-page_content -->

</div> <!-- home-page -->



<?php 

	require_once('/../parts/foot.view.php');
	
?>


