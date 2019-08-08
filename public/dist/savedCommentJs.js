var commentButton = document.getElementById('comment-button');
var commentsContainer = document.getElementById('comments');

commentButton.addEventListener('click', postComment);
// commentsContainer.addEventListener('click', constructReplyForm);
commentsContainer.addEventListener('click', relayFunction);


var elements = document.getElementsByClassName('comment');

// if (document.getElementsByClassName('replies_container')) {
// 	var replyContainer = document.getElementsByClassName('replies_container')[0];
// 	replyContainer.style.display = "none";
// }

function relayFunction(e) {

	e.preventDefault();

	var buttonclicked = e.target;
	
	if (buttonclicked.matches('a.reply-button')) {

		if (buttonclicked.nextSibling.tagName == "FORM") {

			buttonclicked.innerHTML = "reply to this comment";
			buttonclicked.nextSibling.remove();

		} else {

			buttonclicked.innerHTML = "cancel";
			showReplyForm(buttonclicked);
	
		}
	} else if(e.target.matches('a.edit-button')) {
		if (buttonclicked.nextSibling.tagName == "FORM") {
			buttonclicked.innerHTML = "Edit My Comment";
			buttonclicked.nextSibling.remove();

		} else {

			buttonclicked.innerHTML = "cancel";
			showEditForm(buttonclicked);
	
		}
	}
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


	if (document.getElementById('editFormID')) {
		document.getElementById('editFormID').previousElementSibling.innerHTML = "Edit My Comment";
		document.getElementById('editFormID').remove();
	}


	var replyForm = document.createElement("FORM");
		replyForm.id = "replyFormID";
		replyForm.method = "POST";
		replyForm.action = "/webmasterwill/blog/reply-to-comment";

	var replyTextArea = document.createElement("textarea");
		replyTextArea.name = "reply_body";
		replyTextArea.placeholder = "Reply Respectfully";
		replyTextArea.classList.add("reply-textarea");

	var replyInput = document.createElement("input");
		replyInput.type = "submit";
		replyInput.name = "reply";
		replyInput.value = "reply to this comment";
		replyInput.id = "submit-id";

	var replyCommentId = document.createElement("input");
		replyCommentId.type = "hidden";
		replyCommentId.name = "reply_id";
		replyCommentId.value = replyButton.previousElementSibling.value;

	var replyPostId = document.createElement("input");
		replyPostId.type = "hidden";
		replyPostId.name = "post_id";
		replyPostId.value = document.getElementById("post_id").value;

	var replyId = replyButton.previousElementSibling.value;

	var replyPostTitle = document.createElement("input");
		replyPostTitle.type = "hidden";
		replyPostTitle.name = "post_title";
		replyPostTitle.value = document.getElementById("post_title").value;


	// Put together form and insert it after reply button
	replyForm.appendChild(replyTextArea);
	replyForm.appendChild(replyCommentId);
	replyForm.appendChild(replyPostId);
	replyForm.appendChild(replyPostTitle);
	replyForm.appendChild(replyInput);

	replyButton.parentNode.insertBefore(replyForm, replyButton.nextSibling);

	replyInput.addEventListener('click', function() {
		reply(event, replyId);
		// replyForm.submit();
	});
}

function showEditForm(editButton) {

		if (document.getElementById('replyFormID')) {
			document.getElementById('replyFormID').previousElementSibling.innerHTML = "Reply to this Comment";
			document.getElementById('replyFormID').remove();
		}

		var replyId = editButton.previousElementSibling.value;
		var comment = document.getElementById('comment_'+replyId).innerHTML.trim();


		var replyForm = document.createElement("FORM");
			replyForm.id = "editFormID";
			replyForm.method = "POST";
			replyForm.action = "/webmasterwill/blog/edit-comment";

		var replyTextArea = document.createElement("textarea");
			replyTextArea.name = "edit_body";
			replyTextArea.value = comment;
			replyTextArea.classList.add("reply-textarea");

		var editInput = document.createElement("input");
			editInput.type = "submit";
			editInput.name = "edit-comment";
			editInput.value = "edit my comment";
			editInput.id = "submit-id";

		var replyCommentId = document.createElement("input");
			replyCommentId.type = "hidden";
			replyCommentId.name = "comment_id";
			replyCommentId.value = editButton.previousElementSibling.value;

		var replyPostId = document.createElement("input");
			replyPostId.type = "hidden";
			replyPostId.name = "post_id";
			replyPostId.value = document.getElementById("post_id").value;

		var replyPostTitle = document.createElement("input");
			replyPostTitle.type = "hidden";
			replyPostTitle.name = "post_title";
			replyPostTitle.value = document.getElementById("post_title").value;


		// Put together form and insert it after reply button
		replyForm.appendChild(replyTextArea);
		replyForm.appendChild(replyCommentId);
		replyForm.appendChild(replyPostId);
		replyForm.appendChild(replyPostTitle);
		replyForm.appendChild(editInput);

		editInput.addEventListener('click', function() {
			editComment(event, replyId);
			// replyForm.submit();
		});

		editButton.parentNode.insertBefore(replyForm, editButton.nextSibling);
}

function constructReplyForm(e) {

	console.log('it has been clicked');


	if (e.target.matches('a.reply-button') && e.target.nextSibling.tagName !== "FORM") {

		e.preventDefault();

		if (document.getElementById('editFormID')) {
			document.getElementById('editFormID').previousElementSibling.innerHTML = "Edit My Comment";
			document.getElementById('editFormID').remove();
		}

		e.target.innerHTML = "cancel";

		var replyForm = document.createElement("FORM");
			replyForm.id = "replyFormID";
			replyForm.method = "POST";
			replyForm.action = "/webmasterwill/blog/reply-to-comment";

		var replyTextArea = document.createElement("textarea");
			replyTextArea.name = "reply_body";
			replyTextArea.placeholder = "Reply Respectfully";
			replyTextArea.classList.add("reply-textarea");

		var replyInput = document.createElement("input");
			replyInput.type = "submit";
			replyInput.name = "reply";
			replyInput.value = "reply to this comment";
			replyInput.id = "submit-id";

		var replyCommentId = document.createElement("input");
			replyCommentId.type = "hidden";
			replyCommentId.name = "reply_id";
			replyCommentId.value = e.target.previousElementSibling.value;

		var replyPostId = document.createElement("input");
			replyPostId.type = "hidden";
			replyPostId.name = "post_id";
			replyPostId.value = document.getElementById("post_id").value;

		var replyId = e.target.previousElementSibling.value;

		var replyPostTitle = document.createElement("input");
			replyPostTitle.type = "hidden";
			replyPostTitle.name = "post_title";
			replyPostTitle.value = document.getElementById("post_title").value;


		// Put together form and insert it after reply button
		replyForm.appendChild(replyTextArea);
		replyForm.appendChild(replyCommentId);
		replyForm.appendChild(replyPostId);
		replyForm.appendChild(replyPostTitle);
		replyForm.appendChild(replyInput);

		replyInput.addEventListener('click', function() {
			reply(event, replyId);
			// replyForm.submit();
		});

		e.target.parentNode.insertBefore(replyForm, e.target.nextSibling);

	} else if(e.target.matches('a.edit-button') && e.target.nextSibling.tagName !== "FORM") {

		e.preventDefault();

		if (document.getElementById('replyFormID')) {
			document.getElementById('replyFormID').previousElementSibling.innerHTML = "Reply to this Comment";
			document.getElementById('replyFormID').remove();
		}

		e.target.innerHTML = "cancel";

		var replyId = e.target.previousElementSibling.value;
		var comment = document.getElementById('comment_'+replyId).innerHTML.trim();


		var replyForm = document.createElement("FORM");
			replyForm.id = "editFormID";
			replyForm.method = "POST";
			replyForm.action = "/webmasterwill/blog/edit-comment";

		var replyTextArea = document.createElement("textarea");
			replyTextArea.name = "edit_body";
			replyTextArea.value = comment;
			replyTextArea.classList.add("reply-textarea");

		var editInput = document.createElement("input");
			editInput.type = "submit";
			editInput.name = "edit-comment";
			editInput.value = "edit my comment";
			editInput.id = "submit-id";

		var replyCommentId = document.createElement("input");
			replyCommentId.type = "hidden";
			replyCommentId.name = "comment_id";
			replyCommentId.value = e.target.previousElementSibling.value;

		var replyPostId = document.createElement("input");
			replyPostId.type = "hidden";
			replyPostId.name = "post_id";
			replyPostId.value = document.getElementById("post_id").value;

		var replyPostTitle = document.createElement("input");
			replyPostTitle.type = "hidden";
			replyPostTitle.name = "post_title";
			replyPostTitle.value = document.getElementById("post_title").value;


		// Put together form and insert it after reply button
		replyForm.appendChild(replyTextArea);
		replyForm.appendChild(replyCommentId);
		replyForm.appendChild(replyPostId);
		replyForm.appendChild(replyPostTitle);
		replyForm.appendChild(editInput);

		editInput.addEventListener('click', function() {
			editComment(event, replyId);
			// replyForm.submit();
		});

		e.target.parentNode.insertBefore(replyForm, e.target.nextSibling);
	}

	else {
		if (e.target.matches('a.reply-button') && e.target.nextSibling.tagName == "FORM") {

			e.preventDefault();

			e.target.innerHTML = "reply";
			e.target.nextSibling.remove();

		} else if(e.target.matches('a.edit-button') && e.target.nextSibling.tagName == "FORM") {
			e.preventDefault();
			e.target.innerHTML = "Edit my comment";
			e.target.nextSibling.remove();
		}
	}
	
}

function reply(event, replyID) {

	event.preventDefault();

	var sendCommentRequest = new XMLHttpRequest();

	var reply = event.target.parentNode.firstChild.value;
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

function editComment(event, editID) {

	event.preventDefault();


	var sendCommentRequest = new XMLHttpRequest();

	var comment = event.target.parentNode.firstChild.value;
	var editID = editID;
	// var id = document.getElementById("post_id").value;
	// var post_title = document.getElementById("post_title").value;
	var vars = "comment_body="+comment+"&comment_id="+editID;

	sendCommentRequest.open('POST', '/webmasterwill/blog/comments/edit-comment', true);

	sendCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	sendCommentRequest.onreadystatechange = function() {


        if (sendCommentRequest.readyState == 4 && sendCommentRequest.status == 200) {

        	window.location.reload();


    	} 

	}

	sendCommentRequest.send(vars);

}


// function replyAjax(e) {

// 	e.preventDefault();

// 	var sendCommentRequest = new XMLHttpRequest();

// 	var comment = document.getElementById("comment").value;
// 	var id = document.getElementById("post_id").value;
// 	var post_title = document.getElementById("post_title").value;
// 	var vars = "post_id="+id+"&comment="+comment+"&post_title="+post_title;

// 	sendCommentRequest.open('POST', '/webmasterwill/blog/post-comment/ajax', true);

// 	sendCommentRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

// 	sendCommentRequest.onreadystatechange = function() {


//         if (sendCommentRequest.readyState == 4 && sendCommentRequest.status == 200) {


//         	window.location.reload();


//     	} 

// 	}

// 	sendCommentRequest.send(vars);
// }