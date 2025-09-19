$(document).ready(function() {
    $('.profile_photo').on('click', function() {
      $('.fullscreen-preview').addClass('active');
    });
  
    $('.close_preview').on('click', function() {
      $('.fullscreen-preview').removeClass('active');
      $('.fullscreen-preview').css('transition', 'none');

    });
  
    $(document).keydown(function(e) {
      if (e.key === "Escape") {
        $('.fullscreen-preview').removeClass('active');
      }
    });
  
    $('.fullscreen-preview').on('click', function(e) {
      if ($(e.target).hasClass('fullscreen-preview')) {
        $(this).removeClass('active');
      }
    });
  });