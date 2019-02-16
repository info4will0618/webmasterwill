<!-- <div id="blog-subscriber_container-inner"> -->
<a href="" id="subscribe_top_img">
	<img src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/components/webmasterwill_logo.gif">
</a>
<h3 id="subscriber_header">Subscribe to WebMasterWill Blog!</h3>
<?php if (isset($_SESSION['subscribe-errors']['fail'])): ?>
	<p class="subscriber-error"><?php echo $_SESSION['subscribe-errors']['fail']; ?></p>
<?php endif ?>
 <p id="blog-subscriber_description">
	Subscribe to get valuable information on how to succeed as a web developer: 
</p>
<div class="flex-container" id="subscription-flex-container">
	<img id="subscriber_img" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/website/subscribe_to_succeed.jpg">
	<form action="<?php echo $cfg['site']['root']; ?>/subscribe" method='POST' id="subscribe-form">
		<div class="subscribe-form_input">  

			<?php if(isset($_SESSION['subscribe-errors']['name'])): ?>
				<p class="subscriber-error">
					<?php echo $_SESSION['subscribe-errors']['name']; ?>
				</p>
			<?php endif; ?>

			<?php if(isset($_SESSION['subscribe-errors']['user-exist'])): ?>
				<p class="subscriber-error">
					Oh no! The following email you entered seems to already be entered in my database:
					<span style=""><?php echo $_SESSION['subscribe-errors']['user-exist']; ?>.</span>
					Maybe you just need to verify it so check for a verification link in your inbox.
					If you believe there is a problem please contact me and I'll fix it for you as I can. Thank you :). 
					<a href="<?php echo $cfg['site']['root']; ?>/contact" id="subscriber-contact"> 
						Contact Me!
					</a>
				</p>
			<?php endif; ?>

	        <label for="name">Name:</label>
	   
	        <input type='text' name='name' placeholder="First Name" required value="<?php if(isset($_SESSION['user-info']['name'])){ echo htmlentities($_SESSION['user-info']['name']);} ?>"/>  
	    </div> 
	    <div class="subscribe-form_input">
	    	<p class="subscriber-error">
	        	<?php if (isset($_SESSION['subscribe-errors']['email'])): ?>
				<?php echo $_SESSION['subscribe-errors']['email'];  endif; ?>
			</p> 
	        <label for="email">Email:</label> 
	        <input value="<?php if(isset($_SESSION['user-info']['email'])){ echo htmlentities($_SESSION['user-info']['email']);} ?> " type="email" name="email" placeholder="Email" required/>  
	    </div> 
	    <div id="subscribe-blog_button"> 
	        <input type='submit' value='W' name="subscribe" /> 
	        <input type='submit' value='Subscribe' name="subscribe" ></input>
	        <!-- <input type='hidden' value='1' name='submitted' /> -->
	    </div> 

	    <?php unset($_SESSION['subscribe-errors']); 
	    	  unset($_SESSION['user-info']); 
	   	?>
	</form>
</div>

<!-- </div>End Of Subscriber -->
