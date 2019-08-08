

window.onload = beginningFunctions();

var commentButton = document.getElementById('comment-button');
var commentsContainer = document.getElementById('comments');
var elements = document.getElementsByClassName('comment');
var middle = document.getElementById('middle');

commentButton.addEventListener('click', postComment);
commentsContainer.addEventListener('click', relayFunction);

middle.addEventListener('click', closeUserButtons, false);


function beginningFunctions() {


	var userCommentFunctionsContainer = document.getElementsByClassName('user-comment_functions');

	if (userCommentFunctionsContainer) {

		var i = 0;

		var length = userCommentFunctionsContainer.length;

		for (i; i < length; i++) {

			userCommentFunctionsContainer[0].remove();
		}

		// if (document.getElementById('user_logged-in').value) {
		// 	addUserFuncButton();
		// }

		// addUserFuncButton();
	}
}

function closeUserButtons(e) {

	var userButtons = document.getElementsByClassName('user-comment_functions'); 
	// var commentForm = document.getElementById('replyFormID');

	if ((!e.target.matches('a.reply-icon-down')) && (!e.target.matches('a.report-icon'))) {
		if (userButtons) {
			var i = 0;

			var length = userButtons.length;

			for (i; i < length; i++) {

				userButtons[0].remove();
			}
		}
	}


	// else if(!e.target.matches('a.reply-icon-down')) {

	// }

}

function relayFunction(e) {

	// e.preventDefault();

	var buttonClicked = e.target;

	if (buttonClicked.matches('a.reply-button')) {

		e.preventDefault();

		if (document.getElementById('replyFormID')) {
			 
			var replyingAlready = document.getElementById('replyFormID');

		}

		if (e.target.parentElement.contains(replyingAlready)) {
			return true;
		} else {
			showReplyForm(buttonClicked);
		}

		
	} else if(buttonClicked.matches('a.edit-button')) {

		e.preventDefault();
		
		if (document.getElementById('editFormID')) {
			// buttonClicked.innerHTML = "Edit My Comment";
			document.getElementById('editFormID').remove();

		} else {

			showEditForm(buttonClicked);
	
		}

	} else if(buttonClicked.matches('a.delete-button')) {

		e.preventDefault();
		
		var body = document.getElementById('body');

		var dialogOverlay = document.createElement("div");
			dialogOverlay.classList.add('dialog-overlay');

		var dialogHeader = document.createElement("div");
			dialogHeader.classList.add('are-you-sure_dialog-header');

		var dialogHeaderMessage = document.createElement("p");
			dialogHeaderMessage.innerHTML = "WebMasterRobo Says:";

			dialogHeader.appendChild(dialogHeaderMessage);

		var dialogbox = document.createElement("div");
			dialogbox.classList.add('are-you-sure_dialog');

		var dialogBody = document.createElement("div");
			dialogBody.classList.add('are-you-sure_dialog-body');

		var dialogBodyMessage = document.createElement("p");
			dialogBodyMessage.innerHTML = "Are you sure you want to delete your comment/reply?";
			dialogBodyMessage.classList.add('are-you-sure_dialog-body-message');

			dialogBody.appendChild(dialogBodyMessage);

		var dialogButtons = document.createElement("div");

		var dialogButtonYes = document.createElement("a");
			dialogButtonYes.innerHTML = "Yes!";

		var dialogButtonNo = document.createElement("a");
			dialogButtonNo.innerHTML = "No!";

			dialogButtonNo.addEventListener('click', function() {
				console.log('lol');
			});

		dialogButtons.appendChild(dialogButtonYes);
		dialogButtons.appendChild(dialogButtonNo);
		
		dialogbox.appendChild(dialogHeader);
		dialogbox.appendChild(dialogBody);
		dialogbox.appendChild(dialogButtons);

		dialogOverlay.appendChild(dialogbox);

		body.appendChild(dialogOverlay);

		var commentId = buttonClicked.parentNode.parentNode.parentNode.firstElementChild.value;

		dialogButtonYes.addEventListener('click', function() {
			deleteComment(event, commentId);
		});

		dialogButtonNo.addEventListener('click', function() {
			dialogOverlay.remove();
		});
	}

	else if(buttonClicked.matches('a.reply-icon-down')) {

		e.preventDefault();

		var userButtons = document.getElementById('user-comment_functions');
		var userButtonsTwo = document.getElementById('user-comment_report');

		if (userButtons) {

			if (buttonClicked.parentElement.contains(userButtons)) {
				// alert('removed');
				userButtons.remove();
			} else {

				(function() {
					// alert('removed');
					userButtons.remove();
				}());

				showButtons(buttonClicked);
			}

		} else {

			showButtons(buttonClicked);
		}

		if (document.getElementById('editFormID')) {
			 
			document.getElementById('editFormID').remove();

		}

	} else if(buttonClicked.matches('a.report-icon')) {

		e.preventDefault();

		var userButtons = document.getElementById('user-comment_report');

		// if (document.getElementById('replyFormID')) {
			 
		// 	document.getElementById('replyFormID').remove();

		// }

		if (userButtons) {

			if (buttonClicked.parentElement.contains(userButtons)) {
				alert('removed');
				userButtons.remove();
			} else {

				(function() {
					alert('removed');
					userButtons.remove();
				}());

			}

		} 

		showReportButton(buttonClicked);

	} 

	// else if(buttonClicked.matches('a#load-more-comments-button')) {

	// 	var loadButton = document.getElementById('load-more-comments-button');

	// 	var commentCount = loadButton.previousElementSibling.value;

	// 	var postId = document.getElementById('post_id').value;

	// 	var loadMoreComments = new XMLHttpRequest();

	// 	// var vars = "?post_id="+postId+"&comment_count="+commentCount;

	// 	loadMoreComments.open('GET', "/webmasterwill/blog/comments/load-more-comments?post_id="+postId+"&comment_count="+commentCount, true);

	// 	loadMoreComments.setRequestHeader("Content-type", "Content-Type: application/json");

	// 	loadMoreComments.onreadystatechange = function() {

	//         if (loadMoreComments.readyState == 4 && loadMoreComments.status == 200) {


	//         	if(loadMoreComments.responseText) {
	//         		// var commentsContainer = document.getElementById('comments');
	//         		// // document.getElementById('load-more-comments-container');
	//         		// // commentsContainer.insertAdjacentHTML('afterend', loadMoreComments.responseText);


	//         		loadMoreComments.responseText;

	//         		alert(loadMoreComments.responseText);
	//         	} 
	 
	//         	window.location.reload();

	//     	} 

	// 	}

	// 	loadMoreComments.send();
	// }
}

function deleteComment(event, commentId) {

	var deleteCommentRequest = new XMLHttpRequest();

	var vars = "comment_id="+commentId;

	deleteCommentRequest.open('GET', '/webmasterwill/blog/comments/delete-comment?comment_id=' +commentId, true);

	deleteCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	deleteCommentRequest.onreadystatechange = function() {

        if (deleteCommentRequest.readyState == 4 && deleteCommentRequest.status == 200) {

        	alert('your comment has been deleted');
 
        	window.location.reload();

    	} 

	}

	deleteCommentRequest.send();

}

function showReportButton(buttonClicked) {

	var userButtonContainer = buttonClicked.parentNode;

	var reportButtonContainer = document.createElement("div");
		reportButtonContainer.id = "user-comment_report";
		reportButtonContainer.classList.add("user-comment_functions");

	var reportButton = document.createElement("a");
		reportButton.innerHTML = 'Report This Comment';
		reportButton.classList.add('report-button');

		reportButtonContainer.appendChild(reportButton);

	userButtonContainer.insertBefore(reportButtonContainer, null);

	fadeIn(reportButtonContainer, 1000);

	reportButton.addEventListener('click', function() {

		var body = document.getElementById('body');

		var dialogOverlay = document.createElement("div");
			dialogOverlay.classList.add('dialog-overlay');

		var dialogBox = document.createElement("div");
			dialogBox.classList.add('are-you-sure_dialog');
		
		var dialogBoxMessage = document.createElement("p");
			dialogBoxMessage.innerHTML = "Report this comment?";

			dialogBox.appendChild(dialogBoxMessage);

		var confirmBox = document.createElement("div");
			confirmBox.classList.add('confirm-report-buttons');

		var confirmYes = document.createElement("a");
			confirmYes.innerHTML = "<i class='far fa-flag'></i> Yes, report comment";

		var confirmNo = document.createElement("a");
			confirmNo.innerHTML = "<i class='fas fa-ban'></i> No";

			confirmBox.appendChild(confirmYes);
			confirmBox.appendChild(confirmNo);

		dialogBox.appendChild(confirmBox);	
		dialogOverlay.appendChild(dialogBox);
		body.appendChild(dialogOverlay);	

		confirmNo.addEventListener('click', function() {
			dialogOverlay.remove();
		});

		confirmYes.addEventListener('click', function() {
			dialogBox.remove();
			reportComment(event, dialogOverlay, buttonClicked)
		});

		// reportComment(event, buttonClicked);

	});

}

function reportComment(event, dialogOverlay, buttonClicked) {

	var user = document.getElementById('user_logged_in').value;

	var commentId = buttonClicked.parentNode.parentNode.firstElementChild.value;

	var postId = document.getElementById('post_id').value;

	var reportCommentRequest = new XMLHttpRequest();

	var vars = "comment_id="+commentId+"&post_id="+postId+"&user_id="+user;

	reportCommentRequest.open('POST', '/webmasterwill/blog/comments/report-comment', true);

	reportCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	reportCommentRequest.onreadystatechange = function() {

        if (reportCommentRequest.readyState == 4 && reportCommentRequest.status == 200) {

        	if (reportCommentRequest.response) {

        		var newBox = document.createElement("div");
        			newBox.classList.add('are-you-sure_dialog');

        		var newMessage = document.createElement("p");
        			newMessage.innerHTML = "It seems like you already have reported this comment, do you want to delete the report or change the reason why you sent this report?";

        		var buttons = document.createElement('div');
        			buttons.classList.add('confirm-report-buttons');

        		// var changeReport = document.createElement("a");
        		// 	changeReport.innerHTML = "change the report on this comment";

        		var deleteReport = document.createElement("a");
        			deleteReport.innerHTML = "<i class='fas fa-eraser'></i> delete the report on this comment";

        		var cancelReport = document.createElement("a");
        			cancelReport.innerHTML = "<i class='fas fa-ban'></i> cancel";

        			// buttons.appendChild(changeReport);
        			buttons.appendChild(deleteReport);
        			buttons.appendChild(cancelReport);

        			newBox.appendChild(newMessage);
        			newBox.appendChild(buttons);
        			
        			dialogOverlay.appendChild(newBox);

        			deleteReport.addEventListener('click', function() {
						deleteReportComment(user, commentId, postId);
					});

					// changeReport.addEventListener('click', function() {
					// 	dialogOverlay.remove();
					// });

        			cancelReport.addEventListener('click', function() {
						dialogOverlay.remove();
					});


        		// window.location.reload();

        	} else {

        		alert('Your report has been sent. Thank you for reporting this comment. I will check on it.');

        		window.location.reload();

        	}

    	} 
    }

	reportCommentRequest.send(vars);

}

function deleteReportComment(user, commentId, postId) {

	var deleteCommentRequest = new XMLHttpRequest();

	var vars = "comment_id="+commentId+"&post_id="+postId+"&user_id="+user;

	deleteCommentRequest.open('POST', '/webmasterwill/blog/comments/report-delete', true);

	deleteCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	deleteCommentRequest.onreadystatechange = function() {


        if (deleteCommentRequest.readyState == 4 && deleteCommentRequest.status == 200) {

        	if(deleteCommentRequest.responseText) {
        		// alert(deleteCommentRequest.responseText);
				alert('There was an error deleting your report. Please contact me.');
        	} else {
        		alert(deleteCommentRequest.responseText);
        		alert('Your report has been deleted');
        	}
 
        	window.location.reload();

    	} 

	}

	deleteCommentRequest.send(vars);

}

function showButtons(buttonClicked) {

	var userButtonContainer = buttonClicked.parentNode;

	var editButton = document.createElement("a");
		editButton.innerHTML = 'Edit My Comment';

	var deleteButton = document.createElement("a");
		deleteButton.innerHTML = 'Delete My Comment';

	editButton.classList.add("edit-button");
	deleteButton.classList.add("delete-button");

	var div = document.createElement("div");
		div.setAttribute("id", "user-comment_functions");
		div.classList.add("user-comment_functions");

	div.appendChild(editButton);
	div.appendChild(deleteButton);

	// userButtonContainer.appendChild(div);
	userButtonContainer.insertBefore(div, null);

	fadeIn(div, 1000);

}

function showEditForm(editButton) {

	// var commentBody = editButton.parentNode.parentNode.parentNode;

	// 	commentBody.style.background = "rgba(0, 0, 0, .9)";

	var body = document.getElementById('body');

	var replyOverlay = document.createElement("div");
		replyOverlay.classList.add('dialog-overlay');

	var replyWrap = document.createElement("div");
		replyWrap.classList.add('reply-wrap');

	var replyContainer = document.createElement("div");
		replyContainer.classList.add('edit-container');

	// var replyDiv = editButton.parentNode.parentNode.parentNode.parentNode;
	var replyId = editButton.parentNode.parentNode.parentNode.firstElementChild.value;

	if (document.getElementById('replyFormID')) {
		document.getElementById('replyFormID').remove();
	}

	var comment = document.getElementById('comment_'+replyId).innerHTML.trim();


	var editForm = document.createElement("FORM");
		editForm.id = "editFormID";
		replyContainer.classList.add('edit-form');
		// editForm.method = "POST";
		// editForm.action = "/webmasterwill/blog/edit-comment";

	var editTextArea = document.createElement("textarea");
		editTextArea.name = "edit_body";
		editTextArea.value = comment;
		editTextArea.classList.add("edit-textarea");

	var headerContainer = document.createElement("div");
		headerContainer.classList.add("edit-header_cont");

	var headerTitle = document.createElement("p");
		headerTitle.innerHTML = "Editing Reply Comment";

	var buttonsContainer = document.createElement("div");
		buttonsContainer.classList.add("edit-buttons_cont");

	var editCommentButton = document.createElement("a");
		editCommentButton.innerHTML = "<i class='fas fa-edit'></i> Edit My Comment"
		editCommentButton.id = "submit-id";

	var cancelCommentButton = document.createElement("a");
		cancelCommentButton.innerHTML = "<i class='fas fa-ban'></i> Cancel"
		cancelCommentButton.id = "Cancel";

	// var editCommentButtonIcon = document.createElement("i");
	// 	editCommentButtonIcon.classList.add("fas");
	// 	editCommentButtonIcon.classList.add("fa-edit");

	// var editCommentButton = document.createElement("a");
	// 	editCommentButton.innerHTML = "edit comment"
	// 	editCommentButton.id = "submit-id";

	var editCommentId = document.createElement("input");
		editCommentId.type = "hidden";
		editCommentId.name = "comment_id";
		editCommentId.value = replyId;
		cancelCommentButton.id = "comment-id";

	// var editCommentId = document.createElement("a");
	// 	editCommentId.type = "hidden";
	// 	editCommentId.name = "comment_id";
	// 	editCommentId.value = replyId;

	// Put together form and insert it after reply button
	editForm.appendChild(editTextArea);
	editForm.appendChild(editCommentId);
	editForm.appendChild(buttonsContainer);

	headerContainer.appendChild(headerTitle);



	// buttonsContainer.appendChild(editCommentButtonIcon);
	buttonsContainer.appendChild(editCommentButton);
	buttonsContainer.appendChild(cancelCommentButton);

	replyContainer.appendChild(editForm);
	replyOverlay.appendChild(replyContainer);
	// replyWrap.appendChild(replyContainer);
	body.appendChild(replyOverlay);
	replyContainer.appendChild(headerContainer);
	replyContainer.appendChild(editForm);

	editCommentButton.addEventListener('click', function() {
		editComment(event, replyId);
		// editForm.submit();
	});

	cancelCommentButton.addEventListener('click', function() {
		cancelCommentEdit();
		// editForm.submit();
	});

}

function cancelCommentEdit() {
	document.getElementsByClassName('dialog-overlay')[0].remove();
}

function fadeIn(element, speed) {

	var opacityCounter = 0;

	if ( ! element.style.opacity) {
		element.style.opacity = opacityCounter;
	}

	var opacity = setInterval(increaseOpacity, 10);

	function increaseOpacity() {
		if (opacityCounter == 1) {
			clearInterval(opacity);
		} else {
			// console.log(opacityCounter);
			opacityCounter += .2;
			element.style.opacity = opacityCounter;
		}
	}
}

function fadeOut(element, speed) {

	if ( ! element.style.opacity) {
		element.style.opacity = '1';
	}

	setInterval(function() {
		console.log('ok');
		element.style.opacity = 0;
	}, speed / 100);
}

function editComment(event, editID) {

	event.preventDefault();

	var sendCommentRequest = new XMLHttpRequest();

	var comment = event.target.parentNode.parentNode.firstChild.value;

	var editID = editID;
	// var id = document.getElementById("post_id").value;
	// var post_title = document.getElementById("post_title").value;
	var vars = "comment_body="+comment+"&comment_id="+editID;

	sendCommentRequest.open('POST', '/webmasterwill/blog/comments/ajax-edit', true);

	sendCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	sendCommentRequest.onreadystatechange = function() {


        if (sendCommentRequest.readyState == 4 && sendCommentRequest.status == 200) {

        	if(sendCommentRequest.responseText) {
				alert('Your comment has been edited');
        	} else {
        		alert('You must be logged on in order to do this');
        	}
 
        	window.location.reload();

    	} 

	}

	sendCommentRequest.send(vars);

}

function postComment(e) {

	e.preventDefault();

	var sendCommentRequest = new XMLHttpRequest();

	var comment = document.getElementById("comment").value;
	var id = document.getElementById("post_id").value;
	var post_title = document.getElementById("post_title").value;
	var vars = "post_id="+id+"&comment="+comment+"&post_title="+post_title;

	sendCommentRequest.open('POST', '/webmasterwill/blog/post-comment/ajax', true);

	sendCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	sendCommentRequest.onreadystatechange = function() {


        if (sendCommentRequest.readyState == 4 && sendCommentRequest.status == 200) {


        	if (this.responseText === "") {

        		var elements = document.getElementsByClassName('comment');


        		function scrollToComment(reloadWindow) {

					var lastElement = elements[elements.length-1];

					lastElement.scrollIntoView({behavior: "smooth", block: "start", inline: "start"});

					// setTimeout(reloadWindow, 1000);

					reloadWindow();


        		}


        		var reloadWindow = function () {

        			// document.location.reload();

        			setTimeout(reloading, 1000);

				}

				function reloading() {
					document.location.reload()
				}



				if(elements.length >= 1) {
					scrollToComment(reloadWindow);
				} else {
					reloading();
				}

        		
        	}

        	
        	else {

        		window.location.reload();

        	}

    	} 

	}

	sendCommentRequest.send(vars);
}

function showReplyForm(replyButton) {

	var replyId = replyButton.previousElementSibling.value;

	if (document.getElementById('replyFormID')) {
		// document.getElementById('replyFormID').previousElementSibling.innerHTML = "Edit My Comment";
		document.getElementById('replyFormID').remove();
	}


	var replyForm = document.createElement("FORM");
		replyForm.id = "replyFormID";
		replyForm.method = "POST";
		replyForm.action = "/webmasterwill/blog/reply-to-comment";

	var replyTextArea = document.createElement("textarea");
		replyTextArea.name = "reply_body";
		// replyTextArea.placeholder = "Make sure to respect the comment section";
		replyTextArea.classList.add("reply-textarea");

	var replyButtonsCont = document.createElement("div");
		replyButtonsCont.classList.add("reply-buttons_cont");

	var replyAnchor = document.createElement("a");
		replyAnchor.innerHTML = "Reply";
		// replyAnchor.id = "submit-id";

	var cancelAnchor = document.createElement("a");
		cancelAnchor.innerHTML = "Cancel";


	var replyCommentId = document.createElement("input");
		replyCommentId.type = "hidden";
		replyCommentId.name = "reply_id";
		replyCommentId.value = replyButton.previousElementSibling.value;

	var replyPostId = document.createElement("input");
		replyPostId.type = "hidden";
		replyPostId.name = "post_id";
		replyPostId.value = document.getElementById("post_id").value;

	var replyPostTitle = document.createElement("input");
		replyPostTitle.type = "hidden";
		replyPostTitle.name = "post_title";
		replyPostTitle.value = document.getElementById("post_title").value;


	// Put together form and insert it after reply button

	replyButtonsCont.appendChild(replyAnchor);
	replyButtonsCont.appendChild(cancelAnchor);

	replyForm.appendChild(replyTextArea);
	replyForm.appendChild(replyCommentId);
	replyForm.appendChild(replyPostId);
	replyForm.appendChild(replyPostTitle);
	replyForm.appendChild(replyButtonsCont);

	replyButton.parentNode.insertBefore(replyForm, replyButton.nextSibling);

	// heightTransition(replyForm);
	heightTransition(replyTextArea);

	replyAnchor.addEventListener('click', function() {
		reply(event, replyId);
		
	});

	cancelAnchor.addEventListener('click', function() {
		cancelReplyToComment();
		
	});

}

function cancelReplyToComment() {
	document.getElementById('replyFormID').remove();
}

function heightTransition(element) {

	var heightCounter = 0;

	// if ( ! element.style.opacity) {
	// 	element.style.opacity = opacity;
	// }

	var height = setInterval(increaseHeight, 5);

	function increaseHeight() {
		if (heightCounter === 100) {
			clearInterval(height);
		} else {
			// console.log(heightCounter);
			heightCounter += 4;
			element.style.height = heightCounter + 'px';
		}
	}
}

function reply(event, replyID) {

	event.preventDefault();

	var sendCommentRequest = new XMLHttpRequest();

	var reply = event.target.parentNode.parentNode.firstChild.value;

	var replyId = replyID;
	var id = document.getElementById("post_id").value;
	var post_title = document.getElementById("post_title").value;
	var vars = "post_id="+id+"&reply_body="+reply+"&post_title="+post_title+"&reply_id="+replyId;

	sendCommentRequest.open('POST', '/webmasterwill/blog/reply-to-comment', true);

	sendCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	sendCommentRequest.onreadystatechange = function() {


        if (sendCommentRequest.readyState == 4 && sendCommentRequest.status == 200) {

        	window.location.reload();


    	} 

	}

	sendCommentRequest.send(vars);

}