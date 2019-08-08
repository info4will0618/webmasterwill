<?php 

	$this->layout = '~/views/shared/_defaultLayout.php';

?>

<div class="main-page" id="services-page">

	<div id="services-page_intro">

		<h1>WebMasterWill Services</h1>
		
<!-- 		<a href="<?php echo $cfg['site']['root']; ?>/services/how-I-work">How do I work?</a>
 -->		<a href="<?php echo $cfg['site']['root']; ?>/services/prices">Prices</a>
		<a href="<?php echo $cfg['site']['root']; ?>/services/technologies">What Technologies I Use?</a>
		
	</div>

<!-- 	<img id="services_main-img" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/services/services.png">
 -->
	<div id="serv-imgs_con">
		<a href="<?php echo $cfg['site']['root']; ?>/services/web-design" class="services-img">
			<p class="serv-imgs_desc">Web Design & UI</p>
			<img class="" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/services/web-design.jpg">
			
		</a>
		<a href="<?php echo $cfg['site']['root']; ?>/services/web-development" class="services-img">
			<p class="serv-imgs_desc">Web Development</p>
			
			<img id="" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/services/web-development.jpg" class="">
			
		</a>
<!-- 		<a href="#" id="home-page_img3"><img src="public/dist/imgs/img4.jpg"></a>
		<a href="#" id="home-page_img4"><img src="public/dist/imgs/img5.jpg"></a> -->
	</div>

</div>