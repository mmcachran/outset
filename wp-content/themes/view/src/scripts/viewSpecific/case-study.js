(function($) {
  $('body').on('default-work', function(e, data, pyxl) {
    init();

    pyxl.wistiaControl();

    $('.animation').each(function() {
      var $t = $(this);
      var anim = pyxl.load_animation($t, $t.attr('id'), $t.data('json'));
      anim.play();
    });

    // var topElem = scrollMonitor.create($('.hero'), -$(window).height()/2),
    //     bottomElem = scrollMonitor.create($('.case-study-more'), -$(window).height()/2);

    // // show/hide Side Nav when scrolling down
    // topElem.exitViewport(function(){
    //   $('#slide-out-menu').removeClass('hiding').addClass('showing');
    // });
    // bottomElem.enterViewport(function(){
    //   $('#slide-out-menu').removeClass('showing').addClass('hiding');
    // });
    // // show/hide Side Nav when scrolling up
    // bottomElem.exitViewport(function(){
    //   $('#slide-out-menu').removeClass('hiding').addClass('showing');
    // });
    // topElem.enterViewport(function(){
    //   $('#slide-out-menu').removeClass('showing').addClass('hiding');
    // });

    if (768 <= $(window).width()) {
      var sectionWatcher = scrollMonitor.create($('#stage'), {
        top: -1000,
        bottom: -$('.case-study-more').height(),
      });
      var fixedNav = $('#slide-out-menu');
      sectionWatcher.stateChange(function() {
        if (sectionWatcher.isFullyInViewport) {
          fixedNav.addClass('showing');
        } else {
          fixedNav.removeClass('showing');
          fixedNav.addClass('hiding');
        }
      });
    }

    function init() {
      var themeColor, themeSecondColor;

      if ('green' !== data.content.theme) {
        themeColor = '#114dba';
        themeSecondColor = '#13ce66';
      } else {
        themeColor = '#13ce66';
        themeSecondColor = '#114dba';
      }

      var obj1 = new RevealFx(document.querySelector('#object-1'), {
        revealSettings: {
          bgcolor: themeColor,
          delay: 800,
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
      obj1.reveal();

      var obj2 = new RevealFx(document.querySelector('#object-2'), {
        revealSettings: {
          bgcolor: themeSecondColor,
          delay: 1050,
          direction: 'rl',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
      obj2.reveal();

      var obj3 = new RevealFx(document.querySelector('#object-3'), {
        revealSettings: {
          bgcolor: themeColor,
          delay: 1250,
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
      obj3.reveal();
    }
  });
})(jQuery);
