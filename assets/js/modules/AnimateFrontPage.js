
var AnimateFrontPage = (function() {

	var logo = document.getElementById('wmw_logo');
	var links = document.getElementsByClassName('intro-links');
	var boxes = document.getElementsByClassName('hp-img_box');

	var animate = function() {
		animateLogo();
	}

	function animateLogo() {

	    var pos = -1000;
	    var int = 5;
	    var id = setInterval(frame, 1);

	    function frame() {
	        if (pos == 0) {
	            clearInterval(id);
	            animateLinks();
	        } else {
	            pos = pos + int;
	            logo.style.top = pos + 'px'; 
	        }
	    }

	}

	function animateLinks() {

		var id = setInterval(frame, 100);
		var pos = 0;
		var num = 1;

		function frame() {

			if (pos > num) {
	            clearInterval(id);
	            animateBoxes();
	        } else {
	            for (var i = 0; i < links.length; i++) {
	            	pos = pos + .1;
					links[i].style.opacity = pos;
				}
	        }
			
		}
	}

	function animateBoxes() {

		var int = 100;
		var pos = -1000;
		var posTwo = 1000;
		var id = setInterval(frame, 70);

		
	    function frame() {
	        if (pos == 0 && posTwo == 0) {
	            clearInterval(id);
	        } else {
	            pos = pos + int;
	            posTwo = posTwo - int;
	            boxes[0].style.left = pos + 'px'; 
	            boxes[1].style.right = pos + 'px'; 
	        }
	    }
	}

	return {
		animate: animate
	};

})();

export default AnimateFrontPage;
