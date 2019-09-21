(function($) {
  $('body').on('culture', function(e, data, pyxl) {
    pyxl.load_fact_animations(data);

    // var themeColor = '#114dba';
    // var themeSecondColor = '#13ce66';

    motionInit();
    setTimeout(function() {
      sliderInit();
    }, 500);

    function sliderInit() {
      // console.log($(".culture-slider").css('display'));
      $('.culture-slider').slick({
        // autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        centerMode: true,
        variableWidth: true,
        arrows: false,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: false,
              centerMode: true,
              variableWidth: false,
              arrows: false,
            },
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: false,
              centerMode: true,
              variableWidth: false,
              arrows: false,
            },
          },
        ],
      });
    }

    function motionInit() {
      var obj1 = new RevealFx(document.querySelector('#object-1'), {
        revealSettings: {
          bgcolor: '#114dba',
          delay: 800,
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
      obj1.reveal();

      var obj2 = new RevealFx(document.querySelector('#object-2'), {
        revealSettings: {
          bgcolor: '#114dba',
          delay: 1050,
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
      obj2.reveal();
    }
  });
})(jQuery);
