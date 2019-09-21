document.addEventListener('view/talents', function(ev) {
  // $('body').on('talents', function (e, data, pyxl) {

  var windowWidth = $(window).width();
  // var explore_animation = pyxl.load_animation($('#explore-more-anim'), 'explore_animation', data.content.explore_animation);
  var animationTiming = {
    starts: [1, 75, 242, 401, 513, 669], // end of transitions
    loops: [[0, 1], [76, 111], [243, 285], [402, 435], [514, 546], [670, 825]], // loops for each sections
  };
  var loopStarts = animationTiming.starts;
  // explore_animation.play();

  if (640 < windowWidth) {
    var animation = Pyxl.load_animation(
      $('.animation'),
      'talents',
      // data.content.animation
    );
    var currentDirection;
    var currentSection = 0;
    var previousSection = 0;
    var throttle;

    // var preventScrollTrigger = false;
    animation.addEventListener('segmentStart', function(e) {
      if (-1 !== loopStarts.indexOf(e.firstFrame)) {
        // looping = false;
        animation.setSpeed(2);
      } else {
        // looping = true;
        animation.setSpeed(1);
      }
    });
    animation.addEventListener('data_ready', function(e) {
      var animOffset = ($(window).height() - $('.animation').height()) / 2;
      $('.animation').stick_in_parent({ offset_top: animOffset });
    });
    var wH = $(window).height() / 2;
    $('.content-slider nav').stick_in_parent({ offset_top: wH });
    $(window).bind('mousewheel', function(event) {
      var delta = event.originalEvent.wheelDelta;
      if (0 <= delta) {
        currentDirection = 'up';
      } else {
        currentDirection = 'down';
      }
    });

    // eslint-disable-next-line no-inner-declarations
    function changeAnimation(previous, current) {
      if (0 === current) current = 1;
      var start = animationTiming.starts[previous];
      var end = animationTiming.starts[current];
      var loop = animationTiming.loops[current];
      if (1 < Math.abs(previous - current)) {
        start = end--;
      }
      if (false !== start && false !== end && false !== loop) {
        animation.playSegments([[start, end], loop], true);
      }
    }

    // eslint-disable-next-line no-inner-declarations
    function windowScroll() {
      clearTimeout(throttle);
      throttle = setTimeout(function() {
        var $w = $(this);
        var wOffset = $w.scrollTop();
        $('.talents').each(function(index) {
          var $t = $(this);
          var offset = $t.offset().top - (wOffset - $t.height() / 2);
          var wHeight = $w.height();
          var triggerNow = offset <= wHeight && 0 <= offset;
          if ('up' === currentDirection) {
            triggerNow = 0 <= offset && offset < wHeight;
          }
          if (triggerNow) {
            previousSection = currentSection;
            currentSection = index;
            if (
              !$('.talents-nav a[href="#' + $t.attr('id') + '"]')
                .parent()
                .hasClass('active')
            ) {
              $('.talents-nav li.active').removeClass('active');
              $('.talents-nav a[href="#' + $t.attr('id') + '"]')
                .parent()
                .addClass('active');
              changeAnimation(previousSection, currentSection);
            }
          }
        });
      }, 150);
    }

    $(window).bind('scroll', windowScroll);
    $('.talents-nav a').click(function(e) {
      // $(window).unbind('scroll', windowScroll);
      e.preventDefault();
      var $t = $(this);
      var href = $t.attr('href');
      var targetOffset = $(href).offset().top;
      // var index = $('.content-slider .talents')
      //   .filter(href)
      //   .index() - 1;

      $('body,html').animate(
        {
          scrollTop: targetOffset,
        },
        400,
        function() {
          $(window).scroll();
        },
      );
      // $('.talents-nav li.active').removeClass('active');
      // $t.parent().addClass('active');
    });
    $('.explore-more a').click(function(e) {
      e.preventDefault();
      $('.talents-nav a')
        .eq(1)
        .trigger('click');
    });
  } else {
    setTimeout(function() {
      $('.mobile-animation').each(function(index) {
        var i = index + 1;
        var $t = $(this);
        var id = $t.closest('.talents').attr('id');
        // var anim = pyxl.load_animation($t, id, data.content.animation);
        var loop = animationTiming.loops[i];
        var start = animationTiming.starts[i];
        var animPanel = scrollMonitor.create($t[0], 0);
        // console.log([[start-1,start], loop]);
        Pyxl.animations[id].addEventListener('DOMLoaded', function(e) {
          animPanel.enterViewport(function() {
            Pyxl.animations[id].playSegments([[start - 1, start], loop], true);
          });
          animPanel.exitViewport(function() {
            Pyxl.animations[id].pause();
          });
        });
      });
    }, 2250); // holds loading animation until all page transitions have completed
    $('.explore-more a').click(function(e) {
      e.preventDefault();
      var targetOffset = $('.content-slider .talents')
        .eq(1)
        .offset().top;
      $('body,html').animate(
        {
          scrollTop: targetOffset,
        },
        400,
      );
    });
  }
});
