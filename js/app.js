// carousel
$('.owl-carousel').owlCarousel({
  items: 1,
  dots: true,
  smartSpeed: 450,
  margin: 50,
  responsive: {
  }
});

// auth toggle
$('.auth-toggle-btn').on('click', function () {
  target = $(this).attr('target');
  console.log(target);

  $(this).addClass('active');
  $(this).siblings().removeClass('active');


  $('.auth-form').not(target).hide();

  $(`.${target}`).fadeIn(600);
});

/* ====== Bootstrap ====== */
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
