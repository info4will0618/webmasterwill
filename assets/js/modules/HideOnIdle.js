
var HideOnIdle = (function() {

	var socialMediaContainer = document.getElementById('social-media_div');
	var backToTop = document.getElementById('back-to-top');

	function debounce(func, wait, immediate) {

		var timeout;

		return function executedFunction() {

			socialMediaContainer.addEventListener('click', function() {
				clearTimeout(timeout);
				timeout = setTimeout(later, wait);
			});

			if (!timeout) {
				if (typeof(backToTop) != 'undefined' && backToTop != null) {
					backToTop.style.zIndex = "90";
					backToTop.classList.remove("opacity_zero");
				}
				// backToTop.style.height = "100%";
				socialMediaContainer.classList.remove("opacity_zero");
				socialMediaContainer.style.zIndex = "90";
			} 

			var context = this;
			var args = arguments;
			    
			var later = function() {
			  timeout = null;
			  if (!immediate) func.apply(context, args);
			};

			var callNow = immediate && !timeout;

			clearTimeout(timeout);

			timeout = setTimeout(later, wait);

			if (callNow) func.apply(context, args);

		};


	};

	function addListeners() {
		// window.addEventListener('scroll', debounce(hideItems, 3000));
		window.addEventListener('scroll', debounce(showTime, 4000));
		socialMediaContainer.addEventListener('click', debounce(showTime, 4000));
		// window.addEventListener('mousemove', debounce(hideItems, 3000, true));
	}

	


	function showTime() {

		if (typeof(backToTop) != 'undefined' && backToTop != null) {
			backToTop.style.zIndex = "-90";
			backToTop.classList.add("opacity_zero");
		}

		socialMediaContainer.style.zIndex = "-90";
		socialMediaContainer.classList.add("opacity_zero");

	}

	return {
		addListeners: addListeners	
	};

})();

export default HideOnIdle;
