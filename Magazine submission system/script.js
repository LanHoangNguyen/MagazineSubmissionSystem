$(document).ready(function(){
	$(document).on('click', '#submit_comment', function (e){
		e.preventDefault();
		var comment_text = $('#comment_text').val();
		var url = $('#comment_form').attr('action');
		if (comment_text === "" ) return;
		$.ajax({
			url: url,
			type: 'POST',
			data: {
				comment_text: comment_text,
				comment_posted: 1
			},
			success: function(data){
				var response = JSON.parse(data);
				if (data === "error"){
					alert('There was an error adding comment. Please try again');
				} else{
					$('#comments-wrapper').prepend(response.comment);
					$('#comments_count').text(response.comments_count); 
					$('#comment_text').val('');
				}
			}
		});		
	});
	$(document).on('click', '.reply-btn', function (e){
		e.preventDefault();
		var comment_id = $(this).data('commentid');
		$(this).parent().siblings('form#comment_reply_form_' + comment_id).toggle(500);
		$(document).on('click','.submit-reply',function (e){
			e.preventDefault();
			var reply_textarea = $(this).siblings('textarea');
			var reply_text = $(this).siblings('textarea').val();
			var url = $(this).parent().attr('action');
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					comment_id: comment_id,
					reply_text: reply_text,
					reply_posted: 1
				},
				success: function(data) {
					if (data === "error"){
						alert('There was an error adding reply. Please try again');
					} else{
						$('.replies_wrapper_' + comment_id).append(data);
						reply_textarea.val('');
					}
				}
			});			
		});
	});
});
