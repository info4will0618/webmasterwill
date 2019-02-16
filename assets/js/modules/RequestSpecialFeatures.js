
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

export default RequestSpecialFeatures;