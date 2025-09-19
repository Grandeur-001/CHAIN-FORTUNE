$(document).ready(function () {
    function fetchNotificationCount() {
        $.ajax({
            url: '/chain-fortune/action/fetch_notification_count', 
            method: 'GET',
            success: function (response) {
                const result = response;

                if (result.status === 'success') {
                    const notificationCount = result.notification_count;
                    $('#notification_badge').text(notificationCount);
                    
                } else {
                    console.error(result.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    }

    setInterval(fetchNotificationCount, 5000); 
});