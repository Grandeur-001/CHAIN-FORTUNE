$(document).ready(function () {
    const $popup = $('#profile-picture-modal');
    const $popupInner = $('.popup-inner');
    const $fileInput = $('#image_input');
    const $imagePreview = $('#imagePreview');
    const $uploadButton = $('#upload_button');
    
    let selectedFile = null;
    
    
    $('#open-profile-modal').on('click', function () {
        $popup.css('visibility', 'visible');
        $popup.css('opacity', '1');
        $popupInner.css('animation', 'bounce-in 0.7s ease-out forwards');
        $('body').css('overflow', 'hidden');
        $('.fullscreen-preview').css('scale', '0');
        $('.fullscreen-preview').css('transition', 'none');


    });

    const closePopupHandler = () => {
        $popup.css('visibility', 'hidden');
        $popup.css('opacity', '0');
        $popupInner.css('animation', 'none');
        $('body').css('overflow', 'hidden');
        $('.fullscreen-preview').css('scale', '0');
        $('.fullscreen-preview').removeClass('active');

        setTimeout(function() {
            $('.fullscreen-preview').css('scale', '1');
            $('.fullscreen-preview').removeClass('active');
        }, 500);



        $imagePreview.html('<span>No image selected</span>');
        $uploadButton.prop('disabled', true);
        selectedFile = null;

    };

    $('#close-profile-modal').on('click', closePopupHandler);

    $popup.on('click', function (e) {
        if (e.target === $popup[0]) {
            closePopupHandler();
        }
    });

    $fileInput.on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            selectedFile = file;
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgSrc = e.target.result;
                $imagePreview.html(`<img src="${imgSrc}" alt="Preview">`);
                $uploadButton.prop('disabled', false);
            };
            reader.readAsDataURL(file);
        }
    });


});



