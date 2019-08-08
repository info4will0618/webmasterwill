
<?php 

	require_once('/../parts/head.view.php');
	
?>


<div id="contact-page" class="main-page">
	
	<div class="contact-inner">
		<h1 class="contact_main-header">WebMasterWill Los Angeles Web Designer Contact</h1>
		<div class="contact-img">
			<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/robot_cartoons/38-phone.png">
		</div>
		<!-- <div class="contact-intro">
			<p>
				Thank you for choosing to contact WebMasterWill Web Designer. You can directly contact me with the information posted in the box below. Or you can just send me a message using the contact form further down. I will get back to you as soon as I can and answer any questions, concerns, or request you have.
			</p>
		</div> -->
		<p class="page-request_request-form_error form-error">
			<?php if (isset($_SESSION['inputErrors']['error'])): endif; ?>
		</p>
		<div class="my-contact">
			<h2 class="contact_secondary-header">
				Contact Info
			</h2>
			<a href="mailto:webmasterwill2@gmail.com?subject=Website_Proposal">
				<i class="far fa-envelope"></i> 
				<span class="">My Email:</span>
				<span>webmasterwill2@gmail.com</span>
			</a>
			<a href="tel:3238071807">
				<i class="fas fa-phone-volume"></i>
				<span>My Phone Number:</span>
				<span>(323) 807-1807</span>
			</a>
		</div>

		<div class="contact-form_cont">
			<!-- <div class="leave-message">
				<i class="fa fa-comment" aria-hidden="true"></i>
				<span>Or Leave a Message:</span>
			</div> -->
			
			<div class="contact-form" id="contact-form">
				<h2 class="contact_secondary-header">
					WebMasterWill Contact Form
				</h2>
				<p>
					Or send me a quick message!
				</p>
				<form id="contact-message" method="POST" action="<?php echo $cfg['site']['root']; ?>/contact/sent">

					<?php if (isset($_SESSION['inputErrors']['name'])): ?>
					<p class="page-request_request-form_error form-error">
						<?php echo $_SESSION['inputErrors']['name']; endif; ?>
					</p>
					<div class="contact-message_input">
						<label class="contact-message_label">Name (required):</label>
						<input type="text" name="name" value="<?php if(isset($_SESSION['input']['contactName'])){ echo htmlentities($_SESSION['input']['contactName']);}?>">
					</div>


					<?php if (isset($_SESSION['inputErrors']['email'])): ?>
					<p class="page-request_request-form_error form-error">
						<?php echo $_SESSION['inputErrors']['email']; endif; ?>
					</p>
					<div class="contact-message_input">
						<label class="contact-message_label">Email (required):</label>
						<input type="text" name="email" value="<?php if(isset($_SESSION['input']['email'])){ echo htmlentities($_SESSION['input']['email']);}?>">
					</div>

					<?php if (isset($_SESSION['inputErrors']['number'])): ?>
					<p class="page-request_request-form_error form-error">
						<?php echo $_SESSION['inputErrors']['number']; endif; ?>
					</p>
					<!-- <div class="contact-message_input">
						<label class="contact-message_label">Contact Number (Optional) :</label> <br>
						<label>Format: 123-456-7890</label>
						<input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="number" value="<?php if(isset($_SESSION['input']['number'])){ echo htmlentities($_SESSION['input']['number']);}?>">
					</div> -->

					<div class="contact-message_input">
						<label class="contact-message_label">Message (Optional):</label>
						<textarea name="message" cols="30" rows="5" placeholder="Leave me a message. You can leave your number here if you want me to call you instead of email."><?php if(isset($_SESSION['input']['message'])){ echo htmlentities($_SESSION['input']['message']);}?></textarea>
					</div>
					<div class="contact-form_captcha-cont" id="captcha-form">
						<div class="contact-form_captcha-cont-inner">
							<?php if (isset($_SESSION['captcha-error'])): ?>
							<p class="page-request_request-form_error form-error">
								<?php echo $_SESSION['captcha-error']; unset($_SESSION['captcha-error']); endif; ?>
							</p>
						    <label for="captcha">(I swear I'm not a robot!)</label>
						    <img src="captcha_image.png" alt="CAPTCHA" class="captcha-image">
						    <!-- <i class="fas fa-redo refresh-captcha"></i> -->
						    <div class="captcha-button_box">
						    	<input id="captcha-text" type="hidden" name="captcha-text" value="<?php echo $_SESSION['captcha_text'] ?>">
						 		<input type="text" id="captcha-input" name="captcha_challenge" pattern="[A-Za-z]{6}" placeholder="Enter the 5 characters above">
							</div>
						   
						</div>
					</div>
					<input id="contact-message_button" type="submit" name="contact-sent" value="Send Message">
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
			If you are wondering where you can find me, I live around Korea Town in Los Angeles, CA. So whenever you want to meet u, call me and set up an appointment. I'll be glad to have a coffee and discuss business.
		</p>
			
	</div>

</div>

<script type="text/javascript" src="<?php echo $cfg['site']['root']; ?>/public/dist/captcha.js"></script>


<?php 

	require_once('/../parts/foot.view.php');
	
?>
