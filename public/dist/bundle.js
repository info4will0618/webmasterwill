/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

var NavigationMenu = (function() {

	var navMenu = document.getElementById('header_nav-menu_nav');
	var menuButton = document.getElementById('header_nav-button_button');
	var menuContainer = document.getElementById('header_nav-button_div');
	var w = document.getElementById('menu-w');

	var addListeners = function() {
		document.getElementById('header_nav-button_button').addEventListener("click", toggleNavMenu, false);
		document.getElementById('middle').addEventListener("click", closeOpenMenu, false);

	}

	var toggleNavMenu = function() {
		if (navMenu.style.opacity === "1") {
			w.classList.remove("flip_180degre-menu");
			navMenu.style.opacity = "0";
			w.style.color = "#fff";
			navMenu.style.height = "0";
	    } else {
	    	w.classList.add("flip_180degre-menu");
	    	w.style.color = "gold";
	    	navMenu.style.opacity = "1";
	    	navMenu.style.height = "318px";
	    }
	}

	function closeOpenMenu() {
		if (navMenu.style.opacity === "1") {
			w.classList.remove("flip_180degre-menu");
			navMenu.style.opacity = "0";
			w.style.color = "#fff";
			navMenu.style.height = "0";
	    } 
	}

	return {
		toggleNavMenu: toggleNavMenu,
		closeOpenMenu: closeOpenMenu,
		addListeners: addListeners
	};

})();

/* harmony default export */ __webpack_exports__["a"] = (NavigationMenu);


/***/ }),
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

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

/* harmony default export */ __webpack_exports__["a"] = (SocialMediaMenu);


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(3);
module.exports = __webpack_require__(11);


/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__modules_EventListeners__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__modules_NavigationMenu__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__modules_SocialMediaMenu__ = __webpack_require__(1);




// import HideOnIdle from './modules/HideOnIdle';

window.onload = __WEBPACK_IMPORTED_MODULE_0__modules_EventListeners__["a" /* default */];


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (immutable) */ __webpack_exports__["a"] = addEventListeners;
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__NavigationMenu__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__AnimateFrontPage__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__SocialMediaMenu__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__ScrollTopFunction__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__RequestSpecialFeatures__ = __webpack_require__(7);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__HomeimagesInfo__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__HideOnIdle__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__SubscribePop__ = __webpack_require__(10);










function addEventListeners() {

	var rootPath;
	var path = window.location.pathname;
	var button = document.getElementById('back-to-top'); 

	switch(document.location.hostname) {
		case 'localhost' : rootPath = '/webmasterwill'; break;
		case 'webmasterwill.com' : rootPath = '/'; break;
		default: rootPath = '/'; break;
	}

	if (path != rootPath) {
		path = path.replace(/\/+$/, ''); 
	}

	if (typeof(button) != 'undefined' && button != null) {
		__WEBPACK_IMPORTED_MODULE_3__ScrollTopFunction__["a" /* default */].addListeners();
	} 
	
	if (window.addEventListener) {


		if (document.getElementById('members-button')) {
			document.getElementById('members-button').addEventListener("mouseover", dropAuthMenu);
			document.getElementById('members-button').addEventListener("touchstart", toggleAuthMenu);
		}

		__WEBPACK_IMPORTED_MODULE_6__HideOnIdle__["a" /* default */].addListeners();

		__WEBPACK_IMPORTED_MODULE_0__NavigationMenu__["a" /* default */].addListeners();

		if (document.getElementById("social-media_div") !== null) {

			__WEBPACK_IMPORTED_MODULE_2__SocialMediaMenu__["a" /* default */].addListeners();

		}

		if (path === rootPath) {

			__WEBPACK_IMPORTED_MODULE_1__AnimateFrontPage__["a" /* default */].animate();

			document.getElementById('hp_link-1').addEventListener("click", goToLink);
			document.getElementsByClassName('intro_more-info')[0].addEventListener("click", nextSection);
			document.getElementById('hp_section-one_link').addEventListener("click", goToSectionTwo);
			
		}
		
		if (path === rootPath + '/blog') {

			// SubscribePop.setCookie('user_visited_blog', 'guest', '-1');

			if (__WEBPACK_IMPORTED_MODULE_7__SubscribePop__["a" /* default */].checkCookie() === false) {

				__WEBPACK_IMPORTED_MODULE_7__SubscribePop__["a" /* default */].setCookie('user_visited_blog', 'guest', '');

				__WEBPACK_IMPORTED_MODULE_7__SubscribePop__["a" /* default */].showSubscribeForm();

				__WEBPACK_IMPORTED_MODULE_7__SubscribePop__["a" /* default */].addListeners();

				console.log('finished');

			} else {
				console.log('cant');
			}


		}

		if (path === rootPath + '/request') {

			__WEBPACK_IMPORTED_MODULE_4__RequestSpecialFeatures__["a" /* default */].addListeners();
		}

	} else if (window.attachEvent) { // Before IE9

	}
}

function goToLink(e) {
	document.getElementById('home-page_content').scrollIntoView({behavior: "smooth", block: "start", inline: "start"});
}

function nextSection() {
	document.getElementById('home-page_content').scrollIntoView({behavior: "smooth", block: "start", inline: "start"});
}

function goToSectionTwo(e) {
	e.preventDefault();
	document.getElementById('hp_section-two').scrollIntoView({behavior: "smooth", block: "start", inline: "start"});
}

function displayInfoBox(e) {

	e.preventDefault();

	var displayBox = document.createElement('div');
	var message = document.createElement('p');
	var targetAnchor = e.target.parentNode;

	targetAnchor.addEventListener("mouseleave", takeAwayBox);


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

	function takeAwayBox() {
		targetAnchor.removeChild(displayBox);
	}

}

function dropAuthMenu(e) {

	e.preventDefault();

	var authCont = document.getElementById('auth_cont');
	var authButtonCont = document.getElementById('auth-button_cont');

	authButtonCont.style.visibility = "visible";
	authButtonCont.style.opacity = "1";

	authCont.addEventListener('mouseleave', function() {
		authButtonCont.style.opacity= "0";
		authButtonCont.style.visibility = "hidden";
	})

}

function toggleAuthMenu(e) {

	e.preventDefault();

	var authCont = document.getElementById('auth_cont');
	var authButtonCont = document.getElementById('auth-button_cont');

	if (authButtonCont.style.visibility == "visible") {
		authButtonCont.style.visibility = "hidden";
		authButtonCont.style.opacity = "0";
	} else {
		authButtonCont.style.visibility = "visible";
		authButtonCont.style.opacity = "1";
	}

}

/***/ }),
/* 5 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

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

/* harmony default export */ __webpack_exports__["a"] = (AnimateFrontPage);


/***/ }),
/* 6 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

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

/* harmony default export */ __webpack_exports__["a"] = (ScrollTopFunction);

/***/ }),
/* 7 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

var RequestSpecialFeatures = (function() {

	var savedInput;
	var requestInput = document.getElementById('request-form_special-features_input');
	var requestButton = document.getElementById('request-form_special-features_button');
	var divContainer = document.getElementById('request-form_special-features_div');

	function addListeners() {
		divContainer.addEventListener('click', removeRequest);
		requestButton.addEventListener('click', addRequest);
	}

	function removeRequest(e) {
		// e.preventDefault();
		if (e.target.getAttribute('type') === "checkbox") {
			e.target.parentNode.remove(e.target);
		}
	}

	function addRequest(e) {

		e.preventDefault();

		var requestInputValue = requestInput.value;

		console.log(requestInputValue);

		if (requestInputValue === "") {
			alert('You must type something in order to add a feature you want');
		} else {

			var input = document.createElement('input');
			var label = document.createElement('label');
			var div = document.createElement('div');

			div.classList.add('special_features_saved');
			input.setAttribute("type", "checkbox");
			input.value = requestInputValue;
			input.checked = true;
			input.name = "special_features_list[]";
			label.htmlFor = requestInputValue;
			label.innerHTML = requestInputValue;
			div.appendChild(label);
			div.appendChild(input);
			divContainer.appendChild(div);
			requestInput.value = "";
			savedInput = document.getElementsByClassName('special_features_saved');
		}
	}

	
	return {
		addListeners: addListeners
	};

})();

/* harmony default export */ __webpack_exports__["a"] = (RequestSpecialFeatures);

/***/ }),
/* 8 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

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

/* unused harmony default export */ var _unused_webpack_default_export = (HomeimagesInfo);


/***/ }),
/* 9 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

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

/* harmony default export */ __webpack_exports__["a"] = (HideOnIdle);


/***/ }),
/* 10 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";

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

/* harmony default export */ __webpack_exports__["a"] = (SubscribePop);

/***/ }),
/* 11 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);