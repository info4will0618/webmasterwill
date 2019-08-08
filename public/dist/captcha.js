var buttonContainer = document.getElementsByClassName('captcha-button_box')[0];

if (buttonContainer) {
	var captchaButton = document.createElement("a");
		captchaButton.innerHTML = "I'm not the terminator!";
		captchaButton.classList.add('captcha-button');

	buttonContainer.appendChild(captchaButton);

	captchaButton.addEventListener('click', function(e) {
		e.preventDefault();
		
		var captchaInputValue = document.getElementById('captcha-input').value;
		var captchaValue = document.getElementById('captcha-text').value;

		if (captchaInputValue === captchaValue) {
			captchaButton.innerHTML = "You are not a robot";
			captchaButton.style.background = "green";
			document.getElementById('captcha-input').style.display = "none";
		} else {
			alert('Oh no. You have entered the wrong letters. Maybe they are unreadable, so give it another try.');
			window.location.reload();
		}
	});	
}
