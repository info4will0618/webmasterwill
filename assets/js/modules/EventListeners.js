
import NavigationMenu from './NavigationMenu';
// import AnimateFrontPage from './AnimateFrontPage';
import SocialMediaMenu from './SocialMediaMenu';
import ScrollTopFunction from './ScrollTopFunction';
import RequestSpecialFeatures from './RequestSpecialFeatures';
import HomeimagesInfo from './HomeimagesInfo';
import HideOnIdle from './HideOnIdle';
// import SubscribePop from './SubscribePop';

export default function addEventListeners() {

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
		ScrollTopFunction.addListeners();
	} 
	
	if (window.addEventListener) {


		if (document.getElementById('members-button')) {
			document.getElementById('members-button').addEventListener("mouseover", dropAuthMenu);
			document.getElementById('members-button').addEventListener("touchstart", toggleAuthMenu);
		}

		HideOnIdle.addListeners();

		NavigationMenu.addListeners();

		if (document.getElementById("social-media_div") !== null) {

			SocialMediaMenu.addListeners();

		}

		if (path === rootPath ) {


			// var go = document.getElementsByClassName('testing')[0];

			// go.style.display = "block";

			
		}

		if (path === rootPath + '/web-designer-los-angeles') {

			document.getElementById('learn-more').addEventListener("click", goToLink);
			// document.getElementsByClassName('intro_more-info')[0].addEventListener("click", nextSection);
			// document.getElementById('hp_section-one_link').addEventListener("click", goToSectionTwo);
			
		}
		
		if (path === rootPath + '/blog') {

			// SubscribePop.setCookie('user_visited_blog', 'guest', '-1');

			if (SubscribePop.checkCookie() === false) {

				SubscribePop.setCookie('user_visited_blog', 'guest', '');

				SubscribePop.showSubscribeForm();

				SubscribePop.addListeners();

				console.log('finished');

			} else {
				console.log('cant');
			}

		}

		if (path === rootPath + '/request') {

			RequestSpecialFeatures.addListeners();
		}


	} else if (window.attachEvent) { // Before IE9

	}
}

function goToLink(e) {
	e.preventDefault();
	document.getElementById('home-page_content').scrollIntoView({behavior: "smooth", block: "start", inline: "start"});
}

function nextSection() {
	document.getElementById('home-page_content').scrollIntoView({behavior: "smooth", block: "start", inline: "start"});
}

function goToSectionTwo(e) {
	e.preventDefault();
	document.getElementById('hp_section-two').scrollIntoView({behavior: "smooth", block: "start", inline: "start"});
}

function dropAuthMenu(e) {

	e.preventDefault();

	var authCont = document.getElementById('auth_cont');
	var authButtonCont = document.getElementById('auth-button_cont');
	var authButtons = document.getElementsByClassName('auth-buttons');

	authButtonCont.style.visibility = "visible";
	authButtonCont.style.opacity = "1";
	authButtonCont.style.zIndex = "1";
	// authButtons[0].style.zIndex = "1";
	// authButtons[1].style.zIndex = "1";

	authCont.addEventListener('mouseleave', function() {
		authButtonCont.style.opacity= "0";
		authButtonCont.style.visibility = "hidden";
		authButtonCont.style.zIndex = "-100";
		// authButtons[0].style.zIndex = "-100";
		// authButtons[1].style.zIndex = "-100";
	})

}

function toggleAuthMenu(e) {

	e.preventDefault();

	var authCont = document.getElementById('auth_cont');
	var authButtonCont = document.getElementById('auth-button_cont');
	var authButtons = document.getElementsByClassName('auth-buttons');

	if (authButtonCont.style.visibility == "visible") {
		authButtonCont.style.visibility = "hidden";
		authButtonCont.style.opacity = "0";
		// authButtons[0].style.zIndex = "1";
		// authButtons[1].style.zIndex = "1";
	} else {
		authButtonCont.style.visibility = "visible";
		authButtonCont.style.opacity = "1";
		// authButtons[0].style.zIndex = "-1";
		// authButtons[1].style.zIndex = "-1";
	}

}