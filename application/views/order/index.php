<?php 

	$this->layout = '~/views/shared/_defaultLayout.php';

?>

<div class="main-page" id="order-page">


	<div>
		<h1>
			WebMasterWill 100% Satisfaction Guaranteed 
		</h1>

		<div>
			<p>
				What I provide:
			</p>

			<ul>
				<li>
					A headline that grabs your visitors or potential customers attention.
				</li>
			</ul>
		</div>
	</div>

	<div id="webmasterwill-offer">
		<script src="https://js.stripe.com/v3/"></script>
		<div class="order_form">
			<div>
				<?php if (isset($_SESSION['payment-error']['fail'])): ?>
					<p class="subscriber-error"><?php echo $_SESSION['payment-error']['fail']; ?></p>
				<?php endif ?>
			</div>
			<div id="order_form_logo">
				<img id="wmw_logo" src="<?php echo $cfg['site']['root']; ?>/public/dist/imgs/<?php echo $cfg['site']['logo']; ?>">
			</div>
			<h2>
				WebMasterWill Website Order Form
			</h2>
			<p>
				Any others are backed up by my WebMasterWill 100% back guarantee. If you feel like you ever are not satisfied with the result I give you, you can always get your money back.
			</p>
			<form action="<?php echo $cfg['site']['root']; ?>/order/place-order" method="POST" id="payment-form">
			  <div>
			  	<label class="order_label">First Name:</label>
			  	<input type="text" name="first_name" class="StripeElement">
			  	<label class="order_label">Last Name:</label>
			  	<input type="text" name="last_name" class="StripeElement">
			  	<label class="order_label">Email:</label>
			  	<input type="text" name="email" class="StripeElement">
			  	<label class="order_label">Payment Amount:</label>
			  	<input type="text" name="payment_amount" class="StripeElement">
			    <label for="card-element" class="order_label">
			    	Credit or debit card
			    </label>
			    <input name="payment-sent" type="submit" value="Make a Payment" id="payment-form_button">
			    <div id="card-element">
			      <!-- A Stripe Element will be inserted here. -->
			    </div>

			    <!-- Used to display form errors. -->
			    <div id="card-errors" role="alert"></div>

			  </div>
			  
			</form>
		</div>
	</div>

	<?php unset($_SESSION['payment-error']); ?>
</div>
<script type="text/javascript">
	// Create a Stripe client.
	var stripe = Stripe('pk_test_Fl95jLbJfQu5OnGhWCnccpGp');

	// Create an instance of Elements.
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
	  base: {
	    color: '#32325d',
	    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
	    fontSmoothing: 'antialiased',
	    fontSize: '16px',
	    '::placeholder': {
	      color: '#aab7c4'
	    }
	  },
	  invalid: {
	    color: '#fa755a',
	    iconColor: '#fa755a'
	  }
	};

	// Create an instance of the card Element.
	var card = elements.create('card', {style: style});

	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');

	// Handle real-time validation errors from the card Element.
	card.addEventListener('change', function(event) {
	  var displayError = document.getElementById('card-errors');
	  if (event.error) {
	    displayError.textContent = event.error.message;
	  } else {
	    displayError.textContent = '';
	  }
	});

	// Handle form submission.
	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
	  event.preventDefault();

	  stripe.createToken(card).then(function(result) {
	    if (result.error) {
	      // Inform the user if there was an error.
	      var errorElement = document.getElementById('card-errors');
	      errorElement.textContent = result.error.message;
	    } else {
	      // Send the token to your server.
	      stripeTokenHandler(result.token);
	    }
	  });
	});

	// Submit the form with the token ID.
	function stripeTokenHandler(token) {
	  // Insert the token ID into the form so it gets submitted to the server
	  var form = document.getElementById('payment-form');
	  var hiddenInput = document.createElement('input');
	  hiddenInput.setAttribute('type', 'hidden');
	  hiddenInput.setAttribute('name', 'stripeToken');
	  hiddenInput.setAttribute('value', token.id);
	  form.appendChild(hiddenInput);

	  // Submit the form
	  form.submit();
	}
</script>
