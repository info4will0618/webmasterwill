<?php 
$this->layout = '~/views/shared/_defaultLayout.php';
//$this->section['head']='<script src="http://code.jquery.com/jquery-latest.min.js"></script>'; 
?>


<div id="page-request" class="main-page">

	<div class="services-intro">

		<h1>WebMasterWill Request Web Services</h1>

		<p class="p-request_paragraph">
			If you have any questions or just want to contact me directly, please email me at <a href="">info4will0618@gmail.com</a>. You don't have to fill out the following form in order to talk to me or even request a website proposal.
		</p>

		<p>
			Otherwise you can fill out the form so I can have a better idea of what is coming. 
		</p>

	</div>


	<form method="POST" id="page-request_request-form" action='<?php echo $cfg['site']['root']; ?>/request/sent' >
		
			<h2>Website Request Form</h2>
			
			<p class="p-request_paragraph">
				You don't have to fill out every field in the form, just the first name, last name, and email are required. <i>Thanks a million.</i>
			</p>
			
			<label for="first-name">First Name <span class="mandatory">*</span></label>
			<?php if (isset($_SESSION['requestErrors']['first-name'])): ?>
				<p class="page-request_request-form_error form-error">
					<?php echo $_SESSION['requestErrors']['first-name']; unset($_SESSION['requestErrors']['first-name']); endif; ?>
				</p>
			<input class="form-input_general request_form-input" type="text" name="first-name" placeholder="First Name" value="<?php if(isset($_SESSION['first-name'])){ echo htmlentities($_SESSION['first-name']);}?>" />
			<?php unset($_SESSION['first-name']); ?>

			<label for="last-name">Last Name <span class="mandatory">*</span></label>
			<?php if (isset($_SESSION['requestErrors']['last-name'])): ?>
				<p class="page-request_request-form_error form-error">
					<?php echo $_SESSION['requestErrors']['last-name']; unset($_SESSION['requestErrors']['last-name']); endif; ?>
				</p>
			<input class="form-input_general request_form-input" type="text" name="last-name" placeholder="Last Name" value="<?php if(isset($_SESSION['last-name'])){ echo htmlentities($_SESSION['last-name']);}?>" />
			<?php unset($_SESSION['last-name']); ?>

			<label for="email">Email <span class="mandatory">*</span></label>
			<?php if (isset($_SESSION['requestErrors']['email'])): ?>
				<p class="page-request_request-form_error form-error">
					<?php echo $_SESSION['requestErrors']['email']; unset($_SESSION['requestErrors']['email']); endif; ?>
				</p>
			<input class="form-input_general request_form-input" type="email" name="email" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])){ echo htmlentities($_SESSION['email']);}?>" />
			<?php unset($_SESSION['email']); ?>

			<label for="phone-number">Phone Number (Optional)</label>
			<?php if (isset($_SESSION['requestErrors']['phone-number'])): ?>
				<p class="page-request_request-form_error form-error">
					<?php echo $_SESSION['requestErrors']['phone-number']; unset($_SESSION['requestErrors']['phone-number']); endif; ?>
				</p>

			<input class="form-input_general request_form-input" type="tel" name="phone-number" placeholder="000-000-0000" value="<?php if(isset($_SESSION['phone-number'])){ echo htmlentities($_SESSION['phone-number']);}?>" />
			<?php unset($_SESSION['phone-number']); ?>

			<label for="project_description">Project Description (Optional)</label>
			<textarea type="textarea" rows="10" cols="50" id="page-request_request-form_textarea" name="project_description" placeholder="Give me a brief description on what type of website or what kind of services you need for your site." value="" /><?php if(isset($_SESSION['project_description'])){ echo htmlentities($_SESSION['project_description']);}?></textarea>
			<?php unset($_SESSION['project_description']); ?>

			<label for="budget">Budget (Optional)</label>
			<?php if (isset($_SESSION['requestErrors']['budget'])): ?>
				<p class="page-request_request-form_error form-error">
					<?php echo $_SESSION['requestErrors']['budget']; unset($_SESSION['requestErrors']['budget']); endif; ?>
				</p>
			<div id="request-form_budget-div">
				<i id="request-form_dollar-symbol" class="fas fa-dollar-sign"></i>
				<input class="form-input_general request_form-input" type="text" name="budget" placeholder="How much do you wanna spend?" value="<?php if(isset($_SESSION['budget'])){ echo htmlentities($_SESSION['budget']);}?>" />
				<?php unset($_SESSION['budget']); ?>
			</div>

			<label for="time-frame">Time Frame (Optional)</label>
			<?php if (isset($_SESSION['requestErrors']['time-frame'])): ?>
				<p class="page-request_request-form_error form-error">
					<?php echo $_SESSION['requestErrors']['time-frame']; unset($_SESSION['requestErrors']['time-frame']); endif; ?>
				</p>

			<input class="form-input_general request_form-input" type="date" name="time-frame" placeholder="" value="<?php if(isset($_SESSION['time-frame'])){ echo htmlentities($_SESSION['time-frame']);}?>" />
			<?php unset($_SESSION['time-frame']); ?>


			<div id="request-form_special-features_div">

				<label for="special-features">Website Features (Optional)</label>			
					<input id="request-form_special-features_input" class="form-input_general request_form-input" type="text" name="special-features" placeholder="Type any idea or feature you want for your website. " value="" />

					<button type="button" id="request-form_special-features_button">Add Special Feature</button>

				<p>
					Website features entered will display in the bottom if entered. You can click the checkmark to erase any features entered.
				</p>

				<?php if (isset($_SESSION['special_features_list']) && !empty($_SESSION['special_features_list'])) { ?>
					<div class="special_features_saved">
						<?php foreach ($_SESSION['special_features_list'] as $key => $value): ?>
							<label for='<?php echo $value; ?>'><?php echo $value; ?></label>
							<input value='<?php echo $value;?>' name='special_features_list[]' type='checkbox' checked/>
						<?php endforeach ?>
					</div>
				<?php } ?>
			</div>

			
			<input type="submit" name="request-sent" value="Send Request" id="page-request_request-form_button" class="clear_both">
			
	</form>

	<?php unset($_SESSION['requestErrors']); ?>
	<?php unset($_SESSION['special_features_list']); ?>

</div>

