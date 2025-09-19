$(document).ready(function() {
    $('.profile_photo_wrapper').each(function() {
        const $profilePhoto = $(this);
        const $fullscreenPreview = $profilePhoto.siblings('.fullscreen-preview');
        const $closePreview = $fullscreenPreview.find('.close_preview');



        $profilePhoto.on('click', function() {
            $fullscreenPreview.addClass('active');
        });

        $closePreview.on('click', function() {
            $fullscreenPreview.removeClass('active').css('transition', 'none');
        });

        $(document).on('keydown', function(e) {
            if (e.key === "Escape") {
                $fullscreenPreview.removeClass('active');
            }
        });

        $fullscreenPreview.on('click', function(e) {
            if ($(e.target).hasClass('fullscreen-preview')) {
                $fullscreenPreview.removeClass('active');
            }
        });
    });

});