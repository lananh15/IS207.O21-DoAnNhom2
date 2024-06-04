function saveHistoryAndRedirect(type, id) {
    if (typeof userId !== 'undefined' && userId !== null) {
        $.ajax({
            url: '../../app/controllers/SaveHistory.php',
            method: 'POST',
            data: {
                id_user: userId,
                type: type,
                id: id
            },
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        window.location.href = "watch-coiphim.php?type=" + type + "&id=" + id;
                    } else {
                        alert('Error saving history: ' + result.message);
                    }
                } catch (e) {
                    console.error('Invalid JSON response:', response);
                    alert('Error saving history');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error saving history:', error);
                alert('Error saving history');
            }
        });
    } else {
        console.log('User not logged in, redirecting without saving history');
        window.location.href = "watch-coiphim.php?type=" + type + "&id=" + id;
    }
}

function showTrailer(trailerId) {
    saveHistoryAndRedirect('trailer', trailerId);
}

function showMovie(movieID) {
    saveHistoryAndRedirect('movie', movieID);
}