<?php 

	$title = "WebMasterWill Contact";

	$this->layout = '~/views/shared/_defaultLayout.php';
?>

<div id="contact-page" class="main-page">

	<div>

		<h1>Contact WebMasterWill</h1>
		
		<div class="contact-box">
			<i class="far fa-envelope"></i> 
			<span>Email:</span>
			<div>
				<a href="mailto:info4will0618@gmail.com?subject=Website_Proposal">
					william@webmasterwill.com
				</a>
			</div>
		</div>

		<div class="contact-box">
			<i class="fa fa-comment" aria-hidden="true"></i>
			<span>Or Leave a Message:</span>
			<div>
				<form id="contact-message">
					<input type="text" name="name">
					<input type="text" name="email">
					<textarea cols="30" rows="5"></textarea>
				</form>
			</div>
		</div>

		<!-- <div class="contact-box">
			<i class="fa fa-phone-square" aria-hidden="true"></i>
			<i class="fa fa-mobile" aria-hidden="true"></i>
			<span>Call or Text:</span>
			<div>
				<a href="<?php echo $cfg['site']['root']; ?>/request">
					(323)
				</a>
			</div>
		</div> -->
		
		<div id="korea-town_map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13221.365748736584!2d-118.30913906588364!3d34.060760639656024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2b87fee26383b%3A0x6454958f585d5fe0!2sKoreatown%2C+Los+Angeles%2C+CA!5e0!3m2!1sen!2sus!4v1527807732668" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		
		<p>
			If you are wondering where you can find me, I live around Korea Town in Los Angeles, CA. So whenever you want to meet up and have a coffee or something to discuss something, make sure you contact me so we can set it up as soon as possible.
		</p>
			
	</div>

</div>