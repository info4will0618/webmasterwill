	<div id="home-page_main">

		<div id="home-page_main-section">
			
			<div>
				<a href="<?php echo $cfg['site']['root']; ?>/about" id="site-logo">
					<img id="wmw_logo" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/<?php echo $cfg['site']['logo']; ?>">
				</a>
			</div>
			
			<h1>
				<?php echo $cfg['site']['name']; ?>
			</h1>	

			<h3 class="hero-quote">
				<i><b>"Building websites that bring more customers to your business"</b></i>
			</h3>

			<ul id="home-page_links">
				<li>
					<a class="home-page_links" id="hp_link-1" href="#">How I can make you a lot of money with your website</a>
				</li>
				<li>
					<a class="home-page_links" href="<?php echo $cfg['site']['root']; ?>/">How much do I charge?</a>
				</li>
				<li>
					<a class="home-page_links" href="<?php echo $cfg['site']['root']; ?>/">What skills or technology do I use?</a>
				</li>
				<li>
					<a class="home-page_links" href="<?php echo $cfg['site']['root']; ?>/">Resources and References</a>
				</li>
			</ul>
		</div>

		<div id="home-page_imgs">
		
			<a class="home-imgs_click" href="<?php echo $cfg['site']['root']; ?>/blog">
				<div class="home-imgs_inner" id="img_box-one">
					<div class="home-imgs_heading">
						<h3>My Blog</h3>
					</div>
					<img class="home-page_img" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/home_page/the_blog_one.jpg">
					<p class="home-page_img-desc">
						(Coming soon!)
					</p>
				</div>
			</a>

			<a class="home-imgs_click" href="<?php echo $cfg['site']['root']; ?>/resources">
				<div class="home-imgs_inner" id="img_box-two">
					<div class="home-imgs_heading">
						<h3>Resources</h3>
						<!-- <p>Click For More Info</p> -->
					</div>
					<img class="home-page_img" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/home_page/gallery.jpg">
					<p class="home-page_img-desc">
						(Pictures I have taken)
					</p>
				</div>
			</a>
			
		</div>

		<a class="main_more-info">
			<span>More Info...</span>
			<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
		</a>
		
	</div>