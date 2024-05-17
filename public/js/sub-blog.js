function insertComment() {
    const commentBox = document.getElementById('comment-box');
    const commentText = commentBox.value.trim();
    if (commentText === "") {
        alert("Comment cannot be empty!");
        return;
    }
    const now = new Date();
    const commentDiv = document.createElement('div');
    commentDiv.className = 'comment-item';
    const avatarSrc = document.querySelector('.avatar').src;
    // time format
    function formatTimeAgo(date) {
        const seconds = Math.floor((new Date() - date) / 1000);
        let interval = seconds / 31536000;

        if (interval > 1) {
            return Math.floor(interval) + " years ago";
        }
        interval = seconds / 2592000;
        if (interval > 1) {
            return Math.floor(interval) + " months ago";
        }
        interval = seconds / 86400;
        if (interval > 1) {
            return Math.floor(interval) + " days ago";
        }
        interval = seconds / 3600;
        if (interval > 1) {
            return Math.floor(interval) + " hours ago";
        }
        interval = seconds / 60;
        if (interval > 1) {
            return Math.floor(interval) + " minutes ago";
        }
        return Math.floor(seconds) + " seconds ago";
    }
    const timestamp = now.toISOString();
    const timeAgo = formatTimeAgo(new Date(timestamp));
    commentDiv.innerHTML = `
        <div class="comment-content">
            <img src="${avatarSrc}" alt="Avatar" class="comment-avatar">
            <div class="comment-details">
                <span class="comment-username">User Name</span> <!-- Replace with dynamic user name if available -->
                <p class="comment-text">${commentText}</p>
                <span class="comment-timestamp">${timeAgo}</span>
            </div>
        </div>
    `;
    // add new comment in div .insert-comment
    document.querySelector('.insert-comment').appendChild(commentDiv);
    // update comment
    const commentNumberDiv = document.getElementById('number');
    let commentCount = parseInt(commentNumberDiv.textContent);
    commentCount += 1;
    commentNumberDiv.textContent = commentCount.toString();
    // delete comment box
    commentBox.value = '';
}
function cancelComment() {
    document.getElementById('comment-box').value = '';
}
