(function($) {
  $('body').on('lp-informational', function(e, data, pyxl) {
    $('.animation').each(function() {
      var $t = $(this);
      var anim = pyxl.load_animation($t, $t.attr('id'), $t.data('json'));
      anim.play();
    });

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

    init();
  });
})(jQuery);
