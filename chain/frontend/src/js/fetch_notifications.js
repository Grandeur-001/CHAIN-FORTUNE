$(document).ready(function () {
    function fetchNotifications() {
        $.ajax({
            url: '/chain-fortune/action/fetch_notifications', 
            method: 'GET',
            success: function (response) {
                const result = response;

                if (result.status === 'success') {
                    const notifications = result.notifications;
                    const notificationsList = $('#notifications_list');

                    if (notifications.length > 0) {
                        let html = '';

                        notifications.forEach(notification => {
                            html += `
                                <div class="notification-item">
                                    <span class="notification-icon gift" style="color: var(--accent-clr)"><img width="26" src='${notification.notification_symbol}' alt=""></span>
                                    <div>
                                        <p style="white-space: wrap;">${notification.message}</p>
                                        <p class="notification-date" style="font-size: 10px; color: var(--accent-clr);">${notification.created_at}</p>
                                    </div>
                                </div>
                            `;
                        });

                        if (notifications.length >= 7) {
                            notificationsList.attr('style', 'overflow-y: scroll; height: 300px;');

                            if (notificationsList.html === `<div style="display: flex; flex-direction: column; gap: 4px; justify-content:center; align-items:center; height: 50px; padding: 13px 10px"><svg width="24px" xmlns="http://www.w3.org/2000/svg" stroke="#fff" viewBox="0 0 24 24"><g><circle cx="12" cy="12" r="9.5" fill="" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"/></g></svg></div>`) {
                                notificationsList.removeAttr('style'); 
                            }
                        } else {
                            notificationsList.removeAttr('style'); 
                        }

                        notificationsList.html(html);
                    } else {
                        notificationsList.html('<div style="display: flex; justify-content: center;" class="notification-item"><p style="text-align:center;">No notifications!</p></div>');
                        notificationsList.removeAttr('style'); 
                    }
                } else {
                    console.error(result.message);
                }
            },
        });
    }
    setInterval(fetchNotifications, 10000); 
});