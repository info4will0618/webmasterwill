
var SocialMediaMenu = (function() {

	var socialMediaContainer = document.getElementById('social-media_div');
	var socialHandlesContainer = document.getElementById('social-handles');
	var closeButton = document.getElementsByClassName('social-media_handles-a')[1];
	var verticleArrow = document.getElementById('verticle_social-media_arrow');
	var horizontalArrow = document.getElementById('horizontal_social-media_arrow');
	var socialButtonsContainer = document.getElementById('social-media_button-container');

	function addListeners() {
		closeButton.addEventListener("click", closeSocialButtons);
		horizontalArrow.addEventListener("click", hideHorizontalSocialButtons);
		verticleArrow.addEventListener("click", hideVerticleSocialButtons);
	}

	function closeSocialButtons(e) {
		e.preventDefault();
		socialMediaContainer.style.left = "-1000px";
	}

	function hideVerticleSocialButtons(e) {

		e.preventDefault();

		socialMediaContainer.classList.toggle('flip_180degree');

		socialButtonsContainer.classList.toggle('hide_social-media');

		// socialHandlesContainer.classList.toggle('socialHandlesBright');

	}

	function hideHorizontalSocialButtons(e) {

		e.preventDefault();

		socialMediaContainer.classList.toggle('flip_180degree');

		socialButtonsContainer.classList.toggle('hide_social-media');

		// socialHandlesContainer.classList.toggle('socialHandlesBright');

	}

	return {
		closeSocialButtons: closeSocialButtons,
		hideVerticleSocialButtons: hideVerticleSocialButtons,
		hideHorizontalSocialButtons: hideHorizontalSocialButtons,
		addListeners: addListeners	
	};

})();

export default SocialMediaMenu;
