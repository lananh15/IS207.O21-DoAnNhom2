/* Comment */
function insertComment() {
    const commentBox = document.getElementById('comment-box');
    const commentText = commentBox.value.trim();
    // Lấy id và type từ thuộc tính data của phần tử comment-container
    const commentContainer = document.getElementById('comment-container');
    const id = commentContainer.getAttribute('data-id');
    const type = commentContainer.getAttribute('data-type');
    const loggedIn = commentContainer.getAttribute('data-logged-in');
    
    // Kiểm tra đăng nhập của người dùng trước khi xử lý thêm 
    if (loggedIn !== 'true') {
        alert("Please log in to comment.");
        return;
    }
    // Kiểm tra nếu comment rỗng
    if (commentText === "") {
        alert("Comment cannot be empty!");
        return;
    }
    // Lấy thời gian hiện tại và điều chỉnh format
    const now = new Date();
    const timestamp = now.toISOString();
    const timeAgo = new Date(timestamp);
    const formattedTimestamp = formatDateToDMYHMS(timeAgo);

    // Tạo một phần tử div mới chứa thông tin comment
    const commentDiv = document.createElement('div');
    commentDiv.className = 'comment-item';

    // Lấy đường dẫn của avatar và username từ file watch-coiphim.php
    
    const avatarSrc = document.querySelector('.avatar').src;
    var username = document.getElementById('comment-container').getAttribute('data-username');

    // Thêm HTML vào commentDiv
    commentDiv.innerHTML = `
        <div class="comment-content">
            <img src="${avatarSrc}" alt="Avatar" class="comment-avatar">
            <div class="comment-details">
                <span class="comment-username">${username}</span> 
                <p class="comment-text">${commentText}</p>
                <span class="comment-timestamp">${formattedTimestamp}</span>
            </div>
        </div>
    `;

    // Thêm comment mới vào div .insert-comment
    const insertCommentDiv = document.querySelector('.insert-comment');
    insertCommentDiv.insertBefore(commentDiv, insertCommentDiv.firstChild);

    // Gửi dữ liệu comment, id và type lên máy chủ bằng AJAX để thực hiện Insert vào cơ sở dữ liệu
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/IS207.O21-DoAnNhom2/app/models/Comment-video.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
           //  
        }
    };

    // Gửi dữ liệu comment, id và type dưới dạng query string
    xhr.send(`id=${id}&type=${type}&comment=${encodeURIComponent(commentText)}`);

    // Cập nhật số lượng comment
    const commentNumberDiv = document.getElementById('number');
    let commentCount = parseInt(commentNumberDiv.textContent);
    commentCount += 1;
    commentNumberDiv.textContent = commentCount.toString();
    
    // Xóa nội dung trong input comment-box
    commentBox.value = '';
}

// Định nghĩa hàm khi người dùng nhấn nút Cancel
function cancelComment() {
    document.getElementById('comment-box').value = '';
}

// Định nghĩa hàm format thời gian
function formatDateToDMYHMS(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');
    
    return `${year}-${month}-${day}`;
}

/* Like dislike */
$(document).ready(function() {
    function handleButtonClick($clicked_btn, action) {
        var loggedIn = $('#feedback').data('logged-in');
        
        // Check if the user is logged in
        if (!loggedIn) {
            alert("Please log in to like or dislike.");
            return;
        }

        var id = $clicked_btn.data('id');
        var type = $clicked_btn.data('type');
        var other_btn_class = action === 'like' ? 'bi-hand-thumbs-down' : 'bi-hand-thumbs-up';
        var filled_class = action === 'like' ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-down-fill';
        var default_class = action === 'like' ? 'bi-hand-thumbs-up' : 'bi-hand-thumbs-down';
        var opposite_action = action === 'like' ? 'unlike' : 'undislike';

        var isFilled = $clicked_btn.hasClass(filled_class);
        var $likeCount = $clicked_btn.siblings('span.like-count');
        var $dislikeCount = $clicked_btn.siblings('span.dislike-count');
        var currentLikes = parseInt($likeCount.text());
        var currentDislikes = parseInt($dislikeCount.text());

        if (isFilled) {
            action = opposite_action;
        }

        if (action === 'like') {
            if (isFilled) {
                $clicked_btn.removeClass(filled_class).addClass(default_class);
                $likeCount.text(currentLikes - 1);
            } else {
                $clicked_btn.removeClass(default_class).addClass(filled_class);
                $likeCount.text(currentLikes + 1);
                if ($clicked_btn.siblings(`i.${other_btn_class}-fill`).length) {
                    $clicked_btn.siblings(`i.${other_btn_class}-fill`).removeClass(`${other_btn_class}-fill`).addClass(other_btn_class);
                    $dislikeCount.text(currentDislikes - 1);
                }
            }
        } else if (action === 'dislike') {
            if (isFilled) {
                $clicked_btn.removeClass(filled_class).addClass(default_class);
                $dislikeCount.text(currentDislikes - 1);
            } else {
                $clicked_btn.removeClass(default_class).addClass(filled_class);
                $dislikeCount.text(currentDislikes + 1);
                if ($clicked_btn.siblings(`i.${other_btn_class}-fill`).length) {
                    $clicked_btn.siblings(`i.${other_btn_class}-fill`).removeClass(`${other_btn_class}-fill`).addClass(other_btn_class);
                    $likeCount.text(currentLikes - 1);
                }
            }
        } else if (action === 'unlike') {
            if (isFilled) {
                $clicked_btn.removeClass(filled_class).addClass(default_class);
                $likeCount.text(currentLikes - 1);
            }
        } else if (action === 'undislike') {
            if (isFilled) {
                $clicked_btn.removeClass(filled_class).addClass(default_class);
                $dislikeCount.text(currentDislikes - 1);
            }
        }

        $.ajax({
            url: '/IS207.O21-DoAnNhom2/app/models/feedback_processor.php',
            type: 'POST',
            dataType: 'json',
            data: {
                'id': id,
                'action': action,
                'type': type
            },
            success: function(data) {
                try {
                    console.log("Server response:", data);
                    if (data && typeof data.likes !== 'undefined' && typeof data.dislikes !== 'undefined') {
                        $likeCount.text(data.likes);
                        $dislikeCount.text(data.dislikes);
                    } else {
                        console.error("Unexpected response format:", data);
                    }
                } catch (e) {
                    console.error("Failed to parse JSON:", e);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", error);
                console.error("Status:", status);
                console.error("Response Text:", xhr.responseText);
                
                try {
                    // Attempt to parse the responseText to identify potential issues
                    var errorResponse = JSON.parse(xhr.responseText);
                    console.error("Parsed Error Response:", errorResponse);
                } catch (e) {
                    console.error("Response is not valid JSON.");
                }
            }
        });
        
    }

    $('.like-btn').on('click', function() {
        handleButtonClick($(this), 'like');
    });

    $('.dislike-btn').on('click', function() {
        handleButtonClick($(this), 'dislike');
    });
});