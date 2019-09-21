document.addEventListener('view/page', function(ev) {
  // $('body').on('lp-campaign lp-event lp-premium-content', function (e, data, pyxl) {

  var currentSlide = 1;
  var currentDirection;
  var offset = $(window).height() / 2;
  var $scrollSections = $('.full .c-block');
  var breaks = [];
  var slideCount = $('.js-slide').length;
  var moveSlide = function(slide) {
    if (0 < slide && slide <= slideCount) {
      var slideOffset = -100 * (slideCount - slide);
      setTimeout(function() {
        $('.js-slider').css('transform', 'translateY(' + slideOffset + '%)');
      }, 100);
    }
  };

  // moveSlide(1);
  // init();

  $scrollSections.each(function() {
    breaks.push($(this).offset().top + offset);
  });

  function scrollTo(element, to, duration) {
    var start = element.scrollTop;
    var change = to - start;
    var currentTime = 0;
    var increment = 20;

    var animateScroll = function() {
      currentTime += increment;
      var val = Math.easeInOutQuad(currentTime, start, change, duration);
      element.scrollTop = val;
      if (currentTime < duration) {
        setTimeout(animateScroll, increment);
      }
    };
    animateScroll();
  }

  // t = current time
  // b = start value
  // c = change in value
  // d = duration
  Math.easeInOutQuad = function(t, b, c, d) {
    t /= d / 2;
    if (1 > t) return (c / 2) * t * t + b;
    t--;
    return (-c / 2) * (t * (t - 2) - 1) + b;
  };

  $('.scroll').on('click', function() {
    var $t = $(this);
    var $p = $t.closest('.c-block');
    var $n = $p.next();
    var $s = $p.closest('.c-sections__block-inner');
    var offset = $n.offset().top - 100;
    scrollTo($s[0], offset, 300);
  });

  $('.full').on('scroll', function() {
    var scrollTop = $(this).scrollTop();
    var scrollBreak = breaks[currentSlide - 1];

    if (currentSlide < slideCount && 'down' === currentDirection) {
      if (scrollTop > scrollBreak) {
        currentSlide++;
      }
    }

    if (1 < currentSlide && 'up' === currentDirection) {
      scrollBreak = breaks[currentSlide - 2];

      if (scrollTop < scrollBreak) {
        currentSlide--;
      }
    }
    moveSlide(currentSlide);
  });

  $(window).bind('mousewheel', function(event) {
    var delta = event.originalEvent.wheelDelta;

    if (0 <= delta) {
      currentDirection = 'up';
    } else {
      currentDirection = 'down';
    }
  });

  // eslint-disable-next-line no-unused-vars
  function init() {
    var obj1 = new RevealFx(document.querySelector('#side-1'), {
      revealSettings: {
        bgcolor: '#13ce66',
        delay: 800,
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });
    obj1.reveal();

    var obj2 = new RevealFx(document.querySelector('#side-2'), {
      revealSettings: {
        bgcolor: '#13ce66',
        delay: 800,
        direction: 'rl',
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });
    obj2.reveal();
  }
});
