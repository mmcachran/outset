/* eslint-disable no-unreachable, no-unused-vars */

(function($) {
  function initMotion() {
    var obj1 = new RevealFx(document.querySelector('#object-1'), {
      revealSettings: {
        bgcolor: '#13ce66',
        delay: 800,
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });
    obj1.reveal();

    var obj2 = new RevealFx(document.querySelector('#object-2'), {
      revealSettings: {
        bgcolor: '#13ce66',
        delay: 1050,
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });
    obj2.reveal();

    var obj3 = new RevealFx(document.querySelector('#object-3'), {
      revealSettings: {
        bgcolor: '#13ce66',
        delay: 1250,
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });
    obj3.reveal();

    var passIntoFocus = document.getElementById('passion-1');
    if (passIntoFocus) {
      var intoFocus1 = scrollMonitor.create(
        passIntoFocus,
        -($(window).height() / 2),
      );
      intoFocus1.enterViewport(function() {
        passion1.reveal();
        passion2.reveal();
        intoFocus1.destroy();
      });
      var passion1 = new RevealFx(passIntoFocus, {
        revealSettings: {
          bgcolor: '#13ce66',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
    }

    var passion2 = new RevealFx(document.querySelector('#passion-2'), {
      revealSettings: {
        bgcolor: '#114dba',
        delay: 400,
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });

    var featIntoFocus = $('.featured-work-column:nth-child(1)')[0];
    if (featIntoFocus) {
      var featured1 = new RevealFx(featIntoFocus, {
        revealSettings: {
          bgcolor: '#114dba',
          direction: 'bt',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
      var intoFocus2 = scrollMonitor.create(
        featIntoFocus,
        -($(window).height() / 2),
      );
      if (intoFocus2) {
        intoFocus2.enterViewport(function() {
          featured1.reveal();
          featured2.reveal();
          featured3.reveal();
          featured4.reveal();
          intoFocus2.destroy();
        });
      }
    }

    // TODO: stop here until we fix the rest
    return;

    var featured2 = new RevealFx($('.featured-work-column:nth-child(2)')[0], {
      revealSettings: {
        bgcolor: '#13ce66',
        delay: 200,
        direction: 'bt',
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });
    var featured3 = new RevealFx($('.featured-work-column:nth-child(3)')[0], {
      revealSettings: {
        bgcolor: '#114dba',
        delay: 400,
        direction: 'bt',
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });

    var featured4Element = $('.featured-work-column:nth-child(4)');
    if (featured4Element) {
      var featured4 = new RevealFx(featured4Element[0], {
        revealSettings: {
          bgcolor: '#13ce66',
          delay: 600,
          direction: 'bt',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
    }

    var faIntoFocus = document.getElementById('f-and-o-1');
    var intoFocus3 = scrollMonitor.create(faIntoFocus, -400);

    if (faIntoFocus) {
      var factsopinions1 = new RevealFx(faIntoFocus, {
        revealSettings: {
          bgcolor: '#13ce66',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
    }

    if (intoFocus3) {
      intoFocus3.enterViewport(function() {
        factsopinions1.reveal();
        factsopinions2.reveal();
        intoFocus3.destroy();
      });
    }

    var factsopinions2 = new RevealFx(document.querySelector('#f-and-o-2'), {
      revealSettings: {
        bgcolor: '#114dba',
        delay: 200,
        onCover: function(contentEl, revealerEl) {
          contentEl.style.opacity = 1;
        },
      },
    });
  }

  function initPanels() {
    $('.panel').each(function(index, section) {
      var sectionWatcher = scrollMonitor.create(section, {
        top: -300,
        bottom: 100,
      });
      var sectionCta = $(section).find('.fixed-cta');
      sectionWatcher.stateChange(function() {
        if (!sectionWatcher.isInViewport) {
          sectionCta.removeClass('active');
        } else if (sectionWatcher.isAboveViewport) {
          sectionCta.removeClass('active');
        } else if (
          sectionWatcher.isInViewport &&
          sectionWatcher.isAboveViewport
        ) {
          sectionCta.removeClass('active');
        } else if (
          sectionWatcher.isInViewport &&
          sectionWatcher.isBelowViewport
        ) {
          sectionCta.addClass('active');
        } else {
          sectionCta.removeClass('active');
        }
      });
    });
  }

  function initVideoPlayButtons() {
    $('.play-button-container').click(function(e) {
      e.preventDefault();
      var $t = $(this);
      var figure = $t.next();
      figure.addClass('show');
      Pyxl.allVideos.map(function(video) {
        if (
          'undefined' !== typeof video.popUpParent &&
          video.popUpParent[0] === $t.closest('.popup-video-container')[0]
        ) {
          video.play();
        } else {
          video.pause();
        }
      });
    });
  }

  function initPopUpVideos() {
    $('.popup-video-container figure').click(function(e) {
      if (0 === $(e.target).closest('.wistia-holder').length) {
        $(this).removeClass('show');
        Pyxl.allVideos.map(function(video) {
          if (
            'undefined' !== typeof video.startAfterOverlayClosed &&
            video.startAfterOverlayClosed
          ) {
            video.play();
          } else {
            video.pause();
          }
        });
      }
    });
  }

  function initArticles() {
    if (768 < $(window).width()) {
      $('.article-list li').hover(function() {
        var postID = $(this).data('post');
        $('.article-list li').removeClass('active');
        $('.f-and-o-summary-content div').removeClass('active');
        $('.f-and-o-back div').removeClass('active');
        $(this).addClass('active');
        $('.f-and-o-summary-content')
          .find("[data-post='" + postID + "']")
          .addClass('active');
        $('.f-and-o-back div')
          .find("[data-post='" + postID + "']")
          .addClass('active');
      });
    }
  }

  function run(ev) {
    initMotion();
    // initPanels();
    // pyxl.wistiaControl();
    // initPopUpVideos();
    // initArticles();
  }

  document.addEventListener('view/pageReady/front-page', run);
})(jQuery);
