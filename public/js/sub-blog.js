$(document).ready(function() {
    $('#comment-form').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/IS207.O21-DoAnNhom2/app/models/Comment.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Append the new comment to the comment list
                    var commentHTML = `
                        <div class="comment-item">
                            <div class="comment-content">
                                <img src="${response.avatar}" alt="Avatar" class="comment-avatar" onerror="this.onerror=null; this.src='/IS207.O21-DoAnNhom2/public/images&videos/Avatar/default_avatar.png';">
                                <div class="comment-details">
                                    <span class="comment-username">${response.username}</span>
                                    <p class="comment-text">${response.comment}</p>
                                    <span class="comment-timestamp">${response.date}</span>
                                </div>
                            </div>
                        </div>
                    `;
                    $('.insert-comment').prepend(commentHTML);
                    $('#comment-box').val('');

                    // Update the comment count
                    var currentCount = parseInt($('#number').text()) || 0;
                    var newCount = currentCount + 1;
                    $('#number').text(newCount);
                    var commentText = (newCount > 1) ? 'comments' : 'comment';
                    $('#comment-text').text(commentText);
                } else {
                    alert('Error adding comment: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});