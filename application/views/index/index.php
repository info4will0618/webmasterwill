
<?php 

	$this->layout = '~/views/shared/_defaultLayout.php';
	
?>

<div id="home-page">

	<button id="back-to-top">
		<i class="far fa-hand-point-up" id="to-top_i"></i>
	</button>

	<div id="home-page_main">

		<div id="hp_main-intro">
			
			<div>
				<a href="<?php echo $cfg['site']['root']; ?>/about" id="site-logo">
					<img id="wmw_logo" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/<?php echo $cfg['site']['logo']; ?>">
				</a>
			</div>
			
			<h1>
				<?php echo $cfg['site']['name']; ?>
			</h1>	

			<h3 class="hero-quote">
				<i>"Creating and showing you how to make websites built for success"</i>
			</h3>

			<ul id="hp_intro-links">
				<li>
					<a class="intro-links" id="hp_link-1" href="">What can I do for you?</a>
				</li>
				<li>
					<a class="intro-links" href="<?php echo $cfg['site']['root']; ?>/services/prices">What service do I provide?</a>
				</li>
				<li>
					<a class="intro-links" href="<?php echo $cfg['site']['root']; ?>/services/technologies">What skills or technology do I use?</a>
				</li>
				<li>
					<a class="intro-links" href="<?php echo $cfg['site']['root']; ?>/services/how">Resources and References</a>
				</li>
			</ul>
		</div>

		<div id="home-page_imgs">

			<div class="home-imgs_container">
				<a href="<?php echo $cfg['site']['root']; ?>/services" class="hp-img_box" id="img_box-one">
					<div class="hp-img_description">
						<p>Gallery</p>
						<!-- <p>Click For More Info</p> -->
					</div>
					<img class="hp-img" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/services/web-design.jpg">
				</a>
			</div>
			
			<div class="home-imgs_container">
				<a href="<?php echo $cfg['site']['root']; ?>/blog" class="hp-img_box" id="img_box-two">
					<div class="hp-img_description">
						<p>The Blog</p>
						<!-- <p>Click For More Info</p> -->
					</div>
					
					<img id="home-page_img2" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/home_page/the_blog.jpg" class="hp-img">
				</a>
			</div>
			
		</div>
		<a class="intro_more-info">
			<span>More Info</span>
			<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
		</a>
		
	</div>

	<div id="home-page_content">

		<div id="hp-content_inner">

			<div class="home-page_content_section-one">

				<div class="home-page_content_section-one_img-cont">
					<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/home_page/creativity.jpg">
				</div>
				
				<div class="home-page_content_section-one_content-cont">
					<h2>CREATIVITY!</h2>
					<div>
						<p>
							What is one of the first mistakes businesses make when first creating a website? It's thinking that once the website is built the whole world is going to visit it. 
						</p>
					</div>
					<a href="" id="hp_section-one_link">
						<span>Read More</span>
						<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
					</a>
				</div>

			</div>

			<div class="home-page_content_section-one" id="hp_section-two">
				<div class="home-page_content_section-one_content-cont">
					<h2>MAKE IT KNOWN!</h2>
					<div>
						<p>
							Once you have your beautiful website up and running with awesome content, photos, videos, etc. then you must let the world know. A website is just a stand-alone modern virtual flyer on the internet. Just like a physical flyer, you must go around and advertise them on the web.
						</p>
					</div>
					<a href="" id="hp_section-one_link">
						<span>Read More</span>
						<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
					</a>
				</div>
				<div class="home-page_content_section-one_img-cont">
					<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/home_page/web_development.jpg">
				</div>
			</div>
		</div>
		
	</div>
	
</div>