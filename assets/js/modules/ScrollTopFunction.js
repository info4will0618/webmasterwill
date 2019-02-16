
var ScrollTopFunction = (function() {

	var button = document.getElementById('back-to-top');

	function addListeners() {
		window.addEventListener('scroll', showButton);
		button.addEventListener("click", scrollBackToTop);
	}

	function scrollBackToTop() {

		button.style.zindex = "300";

		var interval = setInterval(top, 10);

		function top() {

			window.scrollBy(0, -100);

			if(window.pageYOffset === 0) {
				clearInterval(interval);
				button.style.zindex = "90";	
			}		
		}

	}

	function showButton() {

		var yOffSet = window.pageYOffset;

		if( yOffSet < 540){
			button.style.display = "none";
		} else {
			button.style.display = "block";
		}
	}

	return {
		addListeners: addListeners
	};

})();

export default ScrollTopFunction;