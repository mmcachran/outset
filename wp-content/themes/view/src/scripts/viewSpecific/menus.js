function run() {
  $('.nav-toggle').off('click');
  $('.nav-toggle').on('click', function(e) {
    e.preventDefault();
    if ($('.nav').hasClass('open')) {
      $(this).removeClass('open');
      $('.nav').removeClass('open');
      $('body').removeClass('nav-open');
    } else {
      $(this).addClass('open');
      $('.nav').addClass('open');
      $('body').addClass('nav-open');
    }
  });
  $('.nav.open a').off('click');
  $('.nav.open a').on('click', function(e) {
    e.preventDefault();
    $('.nav-toggle').removeClass('open');
    $('.nav').removeClass('open');
    $('.logo').removeClass('open');
  });

  var delta = 76;
  var lastPosition = 0;
  var leaveHeaderHidden = false;
  // var leaveHeaderVisible = false;

  $(window)
    .on('scroll', function(e) {
      var hovered = $(':hover');
      var overHeader = $.inArray($('.nav-holder')[0], hovered);

      var position = $(this).scrollTop();
      if (0 === position) {
        $('body')
          .removeClass('nav-up')
          .removeClass('nav-down');
        return;
      }
      if (position < lastPosition) {
        if (position > $('.nav-holder').outerHeight() && !leaveHeaderHidden) {
          $('body')
            .removeClass('nav-up')
            .addClass('nav-down');
          delta = position + 50;
        }
      } else {
        if (position > delta && 0 > overHeader) {
          $('body')
            .removeClass('nav-down')
            .addClass('nav-up');
        }
      }
      lastPosition = position;
    })
    .scroll();
  $('body').on('mouseenter', '.logo.x-only', function() {
    Pyxl.setLogo('full', false);
    Pyxl.setMenu('hide-away showing', false);
  });
  // Slide out menu on case-study pages
  $(window).scroll(function() {
    var showTopElem = $('#long-showcase-section');
    if (showTopElem.length) {
      var showTop = $('#long-showcase-section').offset().top;
      var windowHeight = $(window).height();
      var hide = showTop + $('.showcase-image').outerHeight();
      var windowScroll = $(this).scrollTop();

      if (windowScroll > showTop + windowHeight / 2) {
        $('#slide-out-menu').css('left', '0');
      }
      if (windowScroll > hide || windowScroll < showTop + windowHeight / 2) {
        $('#slide-out-menu').css('left', '-100%');
      }
    }
  });

  if ($('#sticky-side-menu').length) {
    // Sticky Side menu
    $('#sticky-side-menu').stick_in_parent();
  }
  $('body').on('click', 'a.scroll-to', function(e) {
    console.log('hello');
    e.preventDefault();
    var $t = $(this);
    var target = $t.attr('href');
    var $target = $(target);
    if ($target.length) {
      $('a.scroll-to.active').removeClass('active');
      $t.addClass('active');
      $('body,html').animate(
        {
          scrollTop: $target.offset().top - 75,
        },
        300,
        function() {
          // Callback after animation
          // Must change focus!
          $target.focus();
          if ($target.is(':focus')) {
            // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          }
        },
      );
    }
  });
}

document.addEventListener('DOMContentLoaded', run);
