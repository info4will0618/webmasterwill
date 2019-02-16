
var SubscribePop = (function() {

	var popContainer = document.getElementById('subscriber-pop_cover');
	var closeButton = document.getElementById('pop_close-button');
	var subscribeForm = document.getElementById('subscribe-form_pop');
	var popWrapper = document.getElementById('subscriber-pop');
	var noThanksButton = document.getElementById('pop_no-thanks');
	var innerContent = document.getElementById('subscribe-pop_inner-content');
	var submitFormButton = document.getElementById('pop_submit-button');

	function addListeners() {

		// window.addEventListener("click", showSubscribeForm);
		submitFormButton.addEventListener('click', verifyFormInput);
		// Close Functions
		noThanksButton.addEventListener('click', closeForm);
		closeButton.addEventListener('click', closeForm);
	}

	function showSubscribeForm() {

		setTimeout(function() {
			popContainer.style.display = "flex";
			popContainer.style.opacity = "1";
		}, 100);

	}

	function verifyFormInput(e) {

		e.preventDefault();

		var userName = subscribeForm.elements[0].value;
		var userEmail = subscribeForm.elements[1].value;
		var userNameInput = document.getElementById('subscribe-pop_name');
		var userEmailInput = document.getElementById('subscribe-pop_email')

		var verifyName = validateName(userName);

		if (verifyName === false) {
			userNameInput.focus();
			return false;
		} 

		var verifyEmail = validateEmail(userEmail);

		if (verifyEmail === false) {
			userEmailInput.focus();
			return false;
		}

		submitForm(userName, userEmail);

	}

	function validateName(userName) {

		var pattOne = /^[a-zA-Z]+$/;
		var pattTwo = /^[a-zA-Z]{2}$/;

		 if (userName === "") {
		 	alert('The name cannot be blank. How would I know who you are? :O. -WebMasterWill');
		 	return false;
		 }

		 if (pattOne.test(userName) === false) {
		 	alert('The username can only contain letters. Thank you - WebmasterWill');
		 	return false;
		 }

		 // if (pattTwo.test(userName) === false) {
		 // 	alert('The name should at least start with two letters. Thank you :).');
		 // }

		 if (userName.length < 2 || userName.length > 30) {
		 	alert('Oh no! Either the name was too short (less than two) or it was too long (no more than 30 characters). Please provide the desired length. Thank you! :). -WebMasterWill');
			return false;
		 }

		 return true;

	}


	function validateEmail(userEmail) {

		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if (filter.test(userEmail) === false) {
		 	alert('Please enter a valid email. Thank you! :). -WebMasterWill');
		 	return false;
		 }

		 return true;

	}

	function submitForm(userName, userEmail) {

		var subscribeRequest = new XMLHttpRequest();
		subscribeRequest.open('POST', '/webmasterwill/subscribe/pop', true);
		subscribeRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		subscribeRequest.onreadystatechange = function() {

            if (subscribeRequest.readyState == 4 && subscribeRequest.status == 200) {

            	if (subscribeRequest.responseText === "") {
            		var thanks = document.createElement('div');
					var message = document.createElement('p');

					message.innerHTML = "Thanks for subscribing!";
					message.innerHTML += " I have sent an email with a verification code.";
					message.innerHTML += " Make sure you check and verify before you start my latest blog post";
					message.innerHTML += " Thanks again!";
					message.innerHTML += " This dialog is going to close in a couple of seconds...";
					thanks.appendChild(message);

					innerContent.remove();

					popWrapper.appendChild(thanks);

					setTimeout(function() {
						popContainer.remove();
					}, 30000);
            	} else {
					popContainer.remove();
					alert(subscribeRequest.responseText);
            	}

            }
        };

        subscribeRequest.send('name=' + userName + '&email=' + userEmail);
	}

	function closeForm(e) {
		e.preventDefault();
		popContainer.remove();
	}

	function checkCookie() {

	    var user = getCookie("user_visited_blog");

	    if (user === "guest") {
	        return true;
	    } else {
	       return false;
	    }

	}

	function setCookie(cname, cvalue, exdays) {
	    var d = new Date();
	    // d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    // var expires = "expires="+ d.toUTCString();
	    var expires = "";
	    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";  
	}

	function getCookie(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i = 0; i < ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	}

	return {
		addListeners: addListeners,
		showSubscribeForm: showSubscribeForm,
		setCookie: setCookie,
		checkCookie: checkCookie
	};

})();

export default SubscribePop;