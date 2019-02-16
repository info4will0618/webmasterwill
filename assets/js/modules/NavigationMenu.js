
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

export default NavigationMenu;
