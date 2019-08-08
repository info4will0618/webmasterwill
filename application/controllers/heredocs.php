$mystring = <<< END
						
						<div class="comment">
							<div class="comment-heading">
								<p class="comment-user">
									<a href="#"><i class="far fa-comment"></i>{<?php echo {$comment['user_name']}; ?>} says:</a>
								</p>
								<p class="comment-date">
									{<?php echo date('F/j/Y', strtotime({$post['date_created']})); ?>}
								</p>
							</div>
							<div class="comment_inner">
								<div class="reply-inner">
									<input id="{<?php echo {$comment['id']};?>}" type="hidden" name="comment_id" value={<?php echo {$comment['id']};?>}>
									<p class="reply-body" id="{<?php echo 'comment_'.{$comment['id']} ?>}">

										{<?php {$message} = (strlen({$comment['comment']}) > 350) ? substr({$comment['comment']}, 0, 350) . ' <a href="#">read more</a>' : {$comment['comment']}; ?>}


										{<?php echo {$message} ?>}
											
									</p>
									<div class="user-comment_functions">
										{<?php if(!empty({$_SESSION['user']}) && {$comment['user_id']} === {$_SESSION['user']['id']}) { ?>}
										<div>
											<a class="delete-button" href="{<?php echo {$cfg['site']['root']}; ?>}/blog/comments/delete-comment?comment_id={<?php echo {$comment['id']} ?>}">
												Delete My Reply
											</a>
										</div>
										
										<div>
											<input id="{<?php echo {$comment['id']};?>}" type="hidden" name="comment_id" value={<?php echo {$comment['id']};?>}>
											<a class="edit-button" href="{<?php echo {$cfg['site']['root']}; ?>}/blog/comments/update-comment?comment_id={<?php echo {$comment['id']} ?>}&comment=">
												Edit My Reply
											</a>
										</div>
										{<?php } ?>}
									</div>
									{<?php if(!empty({$_SESSION['user']}) && ({$comment['user_id']} === {$_SESSION['user']['id']})) { ?>}
									<div class="user-comment_functions-button">
										<a href="#" class="reply-icon-down comment-functions-icon">
											W
										</a>
									</div>
									{<?php } ?>}
									{<?php if (!empty({$_SESSION['user']}) && ({$comment['user_id']} !== {$_SESSION['user']['id']})) { ?>}
									<div class="user-comment_functions-button">
										<a href="#" class="report-icon comment-functions-icon">
											W
										</a>
									</div>
									{<?php } ?>}
								</div>

								{<?php if (!empty({$replies})) { ?>}
									<div class="replies_container">
									{<?php foreach ({$replies} as {$reply}) { 
										if({$reply['repliesTo']} === {$comment['id']}) { ?>}
											<div class="reply">
												<div class="comment-heading">
													<a>
														<i class="far fa-comments"></i> {<?php echo {$reply['user_name']}; ?>} replys:
													</a>
												</div>
												
												<div class="reply-inner">
													<input id="{<?php echo {$reply['id']};?>}" type="hidden" name="comment_id" value={<?php echo {$reply['id']};?>}>
													<p class="reply-body" id="{<?php echo 'comment_'.{$reply['id']} ?>}">
														{<?php echo substr({$reply['comment']}, 0, 350)}; ?>}	
													</p>
													
													<div class="user-comment_functions">
														{<?php if(!empty({$_SESSION['user']}) && {$reply['user_id']} === {$_SESSION['user']['id']}) { ?>}
														<div>
															<a class="delete-button" href="{<?php echo {$cfg['site']['root']}; ?>}/blog/comments/delete-comment?comment_id={<?php echo {$reply['id']} ?>}">
																Delete My Reply
															</a>
														</div>
														
														<div>
															<input id="{<?php echo {$reply['id']};?>}" type="hidden" name="comment_id" value={<?php echo {$reply['id']};?>}>
															<a class="edit-button" href="{<?php echo {$cfg['site']['root']}; ?>}/blog/comments/update-comment?comment_id={<?php echo {$comment['id']} ?>}&comment=">
																Edit My Reply
															</a>
														</div>
														{<?php } ?>}
													</div>

													{<?php if(!empty({$_SESSION['user']}) && ({$reply['user_id']} === {$_SESSION['user']['id']})) { ?>}
													<div class="user-comment_functions-button">
														<a href="#" class="reply-icon-down comment-functions-icon">
															W
														</a>
													</div>
													{<?php } ?>}
													{<?php if (!empty({$_SESSION['user']}) && ({$reply['user_id']} !== {$_SESSION['user']['id']})) { ?>}
													<div class="user-comment_functions-button">
														<!-- <input type="hidden" name="report-id" value="{<?php echo {$reply['reportID']}; ?>}"> -->
														<a href="#" class="report-icon comment-functions-icon">
															W
														</a>
													</div>
													{<?php } ?>}
												</div>
											</div>
										{<?php }  
									} ?>}
									</div>
								{<?php } ?>}
								{<?php if(!empty({$_SESSION['user']})) { ?>}
									<div class="reply_container">
										<input id="{<?php echo {$comment['id']};?>}" type="hidden" name="comment_id" value={<?php echo {$comment['id']};?>}>
								<!-- 		<input id="{<?php echo {$_SESSION['user']['id']};?>}" type="hidden" name="user_id" value={<?php echo {$_SESSION['user']['id']};?>}> -->
										<a href="#" class="reply-button"> 
											Reply To Comment
										</a>
										{<?php 
											if ((isset({$_SESSION['must-type']})) && ({$_SESSION['reply-to']} === {$comment['id']})) {
												echo {$_SESSION['must-type']};
												unset({$_SESSION['must-type']})};
										}?>}
										{<?php 
											if ((!empty({$_SESSION['comment-must-login']})) && ({$_SESSION['reply-to']} === {$comment['id']})) {
												echo {$_SESSION['comment-must-login']};
												unset({$_SESSION['comment-must-login']})};
											}
									 	?>}
									</div>
									{<?php } else { ?>}
									<div class="reply_container">
										<p>
											Must be <a href="{<?php echo {$cfg['site']['root']}; ?>}/login"><i class="far fa-user"></i> logged in </a> to reply or edit a comment
										</p>
									</div>
								{<?php } ?>}
							<!-- <a href="">View more replies</a> -->
						</div>
					</div><!-- End of Comment Container -->
						
					{<?php endforeach ?>}


						<div>
							<input type="hidden" name="comment_count" value="{<?php echo {$comment_count}; ?>}">
							<a id="load-more-comments-button" href="{<?php echo {$cfg['site']['root']}; ?>}/blog/comments/load-more/?lastCommentId={<?php echo {$comment_count} ?>}">
								Load More Comments
							</a>
						</div>

END;