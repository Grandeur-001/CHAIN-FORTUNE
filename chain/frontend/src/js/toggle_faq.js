$(document).ready(function() {
    $('.faq-header').click(function() {
        const faqItem = $(this).parent();
        
        if(faqItem.hasClass('active')) {
            faqItem.removeClass('active');
            $(this).css('background', 'var(--base-clr)'); 
            
        } else {
            $('.faq-item').removeClass('active');
            faqItem.addClass('active');
            $(this).css('background', 'var(--hover-clr)'); 

        }
    });
});