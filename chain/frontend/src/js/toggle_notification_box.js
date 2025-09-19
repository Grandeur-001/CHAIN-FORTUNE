$(document).ready(function () {
    const $showNotification = $("#show_notification_box");
    const $notificationBox = $("#notification_box");

    $showNotification.on("click", () => {
        $notificationBox.toggleClass("show_notifications");
    });

    $(document).on("click", function (event) {
        if (!$(event.target).closest($notificationBox).length && 
            !$(event.target).closest($showNotification).length) {
            $notificationBox.removeClass("show_notifications");
        }
    });
});
