<?php 

	require_once('/../parts/head.view.php');
	
?>

<div class="main-page" id="services-page">
	<div id="services-page_inner">
		<div class="services_headline">
			<h1>
				WebMasterWill Web Design Services
			</h1>
			<!-- <p class="services_tag-line">
				(At WebMasterWill we build more than just websites. <b><i>We build websites that sell)</i> </b>
			</p> -->
		</div>
		<div>
	 		<p>
	 			It's not just about having a website but having one that helps your business move forward and make you feel proud.
	 		</p>
	 		<p>
	 			Our services are designed to get your business to be more professional, credible, and stand out from the crowd.
	 		</p>
	 		<p>
	 			Go ahead and check them out. See which ones you believe your business will benefit the most from or <a href="<?php echo $cfg['site']['root']; ?>/web-designer-los-angeles-contact">contact me</a> and we can discuss what can be the best choice for your business.
	 		</p>
		</div>
		<!-- <h2>
			WebMasterWill Individual Services
		</h2> -->
		<div class="service_box_container">
			<div class="service_box">
				<div>
					<h3>
						WebMasterWill Selling Strategy (Free!)
					</h3>
					<div class="service-box_img">
						<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/91-sign-1.png">
					</div>
				</div>
				
				<p>
					<?php echo substr($services['selling_strategy'], 0, 150) ?> <a href="#">[read more...]</a>
				</p>
			</div>
			<div class="service_box">
				<div>
					<h3>
						Website Build / Remodel
					</h3>
					<div class="service-box_img">
						<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/31-workman-1.png">
					</div>
				</div>
				
				<p>
					<?php echo substr($services['website_build'], 0, 150) ?> <a href="#">[read more...]</a>
				</p>
			</div>
			<div class="service_box">
				<div>
					<h3>
						Copywriting
					</h3>
					<div class="service-box_img">
						<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/50-notepad.png">
					</div>
				</div>
				
				<p>
					<?php echo substr($services['copywriting'], 0, 150) ?> <a href="#">[read more...]</a>
				</p>
			</div>
			<div class="service_box">
				<div>
					<h3>
						Involvement Devices
					</h3>
					<div class="service-box_img">
						<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/85-game.png">
					</div>
				</div>
				
				<p>
					<?php echo substr($services['involvement_devices'], 0, 150) ?> <a href="#">[read more...]</a>
				</p>
			</div>

			<div class="service_box">
				<div>
					<h3>
						Website Analytical Research
					</h3>
					<div class="service-box_img">
						<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/48-search.png">
					</div>
				</div>
				
				<p>
					<?php echo substr($services['analytical_research'], 0, 150) ?> <a href="#">[read more...]</a> 
				</p>
			</div>
			<!-- <div class="service_box">
				<div>
					<h3>
						Website Analytical Research
					</h3>
					<div class="service-box_img">
						<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/48-search.png">
					</div>
				</div>
				<p>
					<?php echo substr($services['selling_strategy'], 0, 150) ?> <a href="#">[read more...]</a> 
				</p>
			</div> -->

		</div>
	</div> <!-- End Of Services Inner -->

</div> <!-- End Of Services Page -->

<?php 

	require_once('/../parts/foot.view.php');
	
?>


