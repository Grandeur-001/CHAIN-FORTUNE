$(window).on('scroll', function () {
  var scroll = $(window).scrollTop();
  if (scroll < 400) {
    $('#back-top').fadeOut(500);
    $('.ant-tooltip').hide();
  } else {
    $('#back-top').fadeIn(500);
    $('.ant-tooltip').show();
  }
});

$('#back-top a').on("click", function () {
  $('body,html').animate({
    scrollTop: 0
  }, 800);
  return false;
});