$(document).ready(function() {
    const $showCreateUser = $('#show_create_user');
    const $createUserSection = $('.create_user_section');
    const $createUserSectionContent = $('.create_user_section_content');

    $showCreateUser.on('click', function() {
        $createUserSection.css({
            visibility: 'visible',
            opacity: '1'
        });
        $createUserSectionContent.css('animation', 'bounce-in 0.7s ease-out forwards');
    });
});
