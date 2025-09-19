const toggleDropdown = (button) => {
    const $dropdown = $(button).next('.action-dropdown-menu');
    $('.action-dropdown-menu.show').not($dropdown).removeClass('show');
    $dropdown.toggleClass('show');
};

$(document).on('click', (event) => {
    const $target = $(event.target);
    const isDropdownButton = $target.closest('.dropdown-toggle').length > 0;
    const isDropdownMenu = $target.closest('.action-dropdown-menu').length > 0;

    if (!isDropdownButton && !isDropdownMenu) {
        $('.action-dropdown-menu.show').removeClass('show');
    }
});