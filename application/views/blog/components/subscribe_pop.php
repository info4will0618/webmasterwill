
<div id="subscriber-pop">
	<div id="subscribe-pop_inner-content">
		<a href="#" id="pop_close-button"><i class="fas fa-window-close"></i></a>
		<h3 id="">Subscribe to WebMasterWill Blog!</h3>
		<img id="subscribe-pop_img"></img>
		<p id="pop_description">
			WebMasterWill is not just about web development, it's also about business and success. Subscribe more to learn how you can become a better developer in general by thinking differently: 
		</p><!-- action="<?php echo $cfg['site']['root']; ?>/subscribe" -->
		<form method='POST' id="subscribe-form_pop" action=''>
			<div class="sub-pop_input">  

				<!-- <?php if(isset($_SESSION['subscriber']['exist'])): ?>
					<p class="subscriber-error">
						Oh no! The following email you entered seems to already be entered in my database:
						<span><?php echo $_SESSION['subscriber']['exist'];  unset($_SESSION['subscriber']['exist']); ?>.</span>
						Maybe you just need to verify it so check for a verification link in your inbox.
						If you believe there is a problem please contact me and I'll fix it for you as I can. Thank you :). 
						<a href="<?php echo $cfg['site']['root']; ?>/contact" id="subscriber-contact"> Contact Me!</a>
					</p>
				<?php endif; ?> -->

	            <label for="name">Name:</label>
	       
	            <input type='text' name='name' placeholder="First Name" value="<?php if(isset($_SESSION['user-info']['name'])){ echo htmlentities($_SESSION['user-info']['name']);} ?>" id="subscribe-pop_name"/>  
	        </div> 
	        <div class="sub-pop_input">
	        	<p class="subscriber-error">
	            	<?php if (isset($_SESSION['subscribe-errors']['email'])): ?>
					<?php echo $_SESSION['subscribe-errors']['email'];  endif; ?>
				</p> 
	            <label for="email">Email:</label> 
	            <input type="" name="email" placeholder="Email" id="subscribe-pop_email"/>  
	        </div> 
	        <div id="sub-pop_buttons"> 
	        	<input type="hidden" name="subscribe" value="English">
	            <a href="" id="pop_submit-button" />Yes, I want to learn</a>
	            <a href="" id="pop_no-thanks">Not today, thanks.</a>
	            <!-- <input type='hidden' value='1' name='submitted' /> -->
	        </div> 
		</form>
	</div>
</div> 