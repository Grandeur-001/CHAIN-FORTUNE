$(document).ready(function() {
    const $navItems = $('.nav-item');
    const $indicator = $('.nav-indicator');
    const $financeNavItem = $('#finance_nav');
    const $bottomNavDropdown = $('.dropdown');

    
    function updateIndicator($element) {
        const width = $element.outerWidth();
        const left = $element.position().left;
        $indicator.css({
            width: `${width}px`,
            transform: `translateX(${left}px)`
        });
    }

    const $activeItem = $('.nav-item.active');
    if ($activeItem.length) {
        updateIndicator($activeItem);
    }

    $(window).on('resize', function() {
        const $activeItem = $('.nav-item.active');
        if ($activeItem.length) {
            updateIndicator($activeItem);
        }
    });


    let isDropdownOpen = false;
    $financeNavItem.on('click', function (e) {
        e.preventDefault();
        $financeNavItem.toggleClass("active");
        isDropdownOpen = !isDropdownOpen;
        $bottomNavDropdown.toggleClass('active', isDropdownOpen);
    });
    
    $(window).on('click', function (e) {

        if (!$financeNavItem.is(e.target) && $financeNavItem.has(e.target).length === 0 && isDropdownOpen) {
            isDropdownOpen = false;
            $bottomNavDropdown.removeClass('active');$financeNavItem
        }
    
    });
});


