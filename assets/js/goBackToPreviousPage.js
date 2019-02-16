
var backButton = document.getElementsByCallName('goBackToPreviousPage');

backButton.addEventListener("click", goBack, false);

function goBack(e) {
	e.preventDefault();
	window.history.back();
}
