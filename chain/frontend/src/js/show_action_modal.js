function openDeleteUser(sectionId) {
    const $section = $(`#${sectionId}`);
    if ($section.length === 0) return;

    $('.delete_section').css({
        visibility: 'hidden',
        opacity: '0'
    });

    $(".action-modal-content").css({
        animation: "bounce-in 0.7s ease-out forwards"
    });

    $section.css({
        visibility: 'visible',
        opacity: '1'
    });
}

function openEditUser(sectionId) {
    const $section = $(`#${sectionId}`);
    if ($section.length === 0) return;

    $('.edit_section').css({
        visibility: 'hidden',
        opacity: '0'
    });

    $(".action-modal-content").css({
        animation: "bounce-in 0.7s ease-out forwards"
    });

    $section.css({
        visibility: 'visible',
        opacity: '1'
    });
}

function openAddBalance(sectionId) {
    const $section = $(`#${sectionId}`);
    if ($section.length === 0) return;

    $('.add_balance_section').css({
        visibility: 'hidden',
        opacity: '0'
    });

    $(".action-modal-content").css({
        animation: "bounce-in 0.7s ease-out forwards"
    });

    $section.css({
        visibility: 'visible',
        opacity: '1'
    });
}


function openSendEmail(sectionId) {
    const $section = $(`#${sectionId}`);

    if ($section.length === 0) return;

    $section.css({
        visibility: 'visible',
    });

    $section.find(".side-modal-dialog").css({
        transform: "translateX(0)",
    });
}





$('.close_action').on('click', function () {
    const $actionOverlay = $(this).closest('.action-modal');
    if ($actionOverlay.length) {
        $actionOverlay.css({
            visibility: 'hidden',
            opacity: '0'
        });

        $(".action-modal-content").each(function () {
            $(this).css('animation', 'none');
            this.offsetWidth; 
        });
    }
});
