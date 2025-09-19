$(document).ready(function () {
    var totop = $('#back-top');  
    var win = $(window);
    win.on('scroll', function() {
        if (win.scrollTop() > 250) {
            totop.fadeIn();
            $('.ant-tooltip').show();
        } else {
            totop.fadeOut();
            $('.ant-tooltip').hide();
        }
    });
});


$('#back-top a').on("click", function () {
$('body,html').animate({
    scrollTop: 0,
}, 4000);
return false;
});