
var HomeimagesInfo = (function() {

	var imageClicked = document.getElementById('home-page_section-main_div-2');
	var e;

	function addListeners(e) {

		this.e = e.target;
		var targetAnchor = e.target.parentNode;

		imageClicked.addEventListener("click", displayImageInfoBox);
		targetAnchor.addEventListener("mouseleave", takeAwayImageInfo);
	}

	function displayImageInfoBox() {

	var targetAnchor = e.target.parentNode;

	e.preventDefault();

	var displayBox = document.createElement('div');
	var message = document.createElement('p');

		if (e.target.tagName == "IMG") {

			displayBox.classList.add('coverDiv');

			if (targetAnchor.id == "home-page_img1") {
				message.innerHTML = "I will help you design anything you want!";
			}

			if (targetAnchor.id == "home-page_img2") {
				message.innerHTML = "you clicked on image 2!";
			}

			if (targetAnchor.id == "home-page_img3") {
				message.innerHTML = "I use HTML, CSS, javascript, PHP, and MySQL and my main web development programming languages :O.";
			}

			if (targetAnchor.id == "home-page_img4") {
				message.innerHTML = "I live in Korea Town and we can get in touch anywhere around Los Angeles. I know this is a picture of echo park";
			}

			displayBox.appendChild(message);

			targetAnchor.appendChild(displayBox);

		}
	}	

	function takeAwayImageInfo() {

		var targetAnchor = e.target.parentNode;

		targetAnchor.removeChild(displayBox);
	}

	return {
		addListeners: addListeners,
		takeAwayImageInfo: takeAwayImageInfo,
		displayImageInfoBox: displayImageInfoBox
	};

})();

export default HomeimagesInfo;
