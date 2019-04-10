// Menu dropdown
$(function() {
	$('.navbar .dropdown.show').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).fadeIn(0);
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).fadeOut(0);
	});
});

// Back to Top Button
var btn = $('#button-top');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

