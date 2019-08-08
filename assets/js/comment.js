
var commentButton = document.getElementById('comment-button');
var commentsContainer = document.getElementById('comments');
var loadMoreCommentsButton = document.getElementById('load-more-comments-button');

commentButton.addEventListener('click', postComment);
commentsContainer.addEventListener('click', constructReplyForm);
loadMoreCommentsButton.addEventListener('click', loadMoreComments);

if (document.getElementsByClassName('reply')) {
	var replyContainer = document.getElementsByClassName('reply');
}

function loadMoreComments() {
	console.log('loading more comments');
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


        	window.location.reload();


    	} 

	}

	sendCommentRequest.send(vars);
}

function constructReplyForm(e) {

	e.preventDefault();

	if (e.target.matches('a.reply-button') && e.target.nextSibling.tagName !== "FORM") {

		e.target.innerHTML = "cancel";

		var replyForm = document.createElement("form");
			replyForm.id = "replyFormID";
			replyForm.method = "POST";
			replyForm.action = "/webmasterwill/blog/reply-comment";

		var replyTextArea = document.createElement("textarea");
			replyTextArea.name = "comment-reply";
			replyTextArea.placeholder = "Reply Respectfully";
			replyTextArea.classList.add("reply-textarea");

		var replyInput = document.createElement("input");
			replyInput.type = "submit";
			replyInput.name = "reply";
			replyInput.value = "reply to this comment";

		var replyCommentId = document.createElement("input");
			replyCommentId.type = "hidden";
			replyCommentId.name = "comment_id";
			replyCommentId.value = e.target.previousElementSibling.value;

		var replyPostId = document.createElement("input");
			replyPostId.type = "hidden";
			replyPostId.name = "post_id";
			replyPostId.value = document.getElementById("post_id").value;


		// Put together form and insert it after reply button
		replyForm.appendChild(replyTextArea);
		replyForm.appendChild(replyInput);
		replyForm.appendChild(replyCommentId);
		replyForm.appendChild(replyPostId);

		e.target.parentNode.insertBefore(replyForm, e.target.nextSibling);

	} else {
		if (e.target.matches('a.reply-button') && e.target.nextSibling.tagName == "FORM") {
			e.target.innerHTML = "reply";
			e.target.nextSibling.remove();
		}
	}
	
}

function replyAjax(e) {
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


        	window.location.reload();


    	} 

	}

	sendCommentRequest.send(vars);
}