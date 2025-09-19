$(document).ready(function () {

    $('#clear_all_notifications').on('click', function () {
        $.ajax({
            url: '/chain-fortune/action/clear_notifications',
            type: 'POST',
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {

                    const notificationList = document.querySelector('.notifications-list');
                    if (notificationList.innerHTML === '<div style="display: flex; justify-content: center;" class="notification-item"><p style="text-align:center;">No notifications!</p></div>') {
                        showToast("error", "You don't have any notifications");
                    }else{
                        showToast('info', 'All Notifications removed')
                    }

                    $('#notifications_list').html('<div style="display: flex; justify-content: center;" class="notification-item"><p style="text-align:center;">No notifications!</p></div>');
                    $('#notification_badge').text('0');
                }else {
                    console.log('Error clearing notifications: ' + res.message);
                }
            },
            error: function () {
                console.log('Error clearing notifications.');
            }
        });
    });
});

