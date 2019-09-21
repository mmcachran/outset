(function($) {
  $('body').on('culture default-offices', function(e, pyxl) {
    var location1 = $('#location-1');
    var location2 = $('#location-2');
    var location3 = $('#location-3');
    var location4 = $('#location-4');

    var objIntoFocus = false;
    if (location1.length) {
      if (!objIntoFocus) objIntoFocus = location1[0];
      var loc1 = new RevealFx(location1[0], {
        revealSettings: {
          bgcolor: '#114dba',
          direction: 'bt',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
    }
    if (location2.length) {
      if (!objIntoFocus) objIntoFocus = location2[0];
      var loc2 = new RevealFx(location2[0], {
        revealSettings: {
          bgcolor: '#13ce66',
          delay: 200,
          direction: 'bt',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
    }
    if (location3.length) {
      if (!objIntoFocus) objIntoFocus = location3[0];
      var loc3 = new RevealFx(location3[0], {
        revealSettings: {
          bgcolor: '#114dba',
          delay: 400,
          direction: 'bt',
          onCover: function(contentEl, revealerEl) {
            contentEl.style.opacity = 1;
          },
        },
      });
    }
    if (location4.length) {
      if (!objIntoFocus) objIntoFocus = location4[0];
      var loc4 = new RevealFx(location4[0], {
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
    if (false !== objIntoFocus) {
      objIntoFocus = scrollMonitor.create(objIntoFocus, -400);
      objIntoFocus.enterViewport(function() {
        if (loc1) loc1.reveal();
        if (loc2) loc2.reveal();
        if (loc3) loc3.reveal();
        if (loc4) loc4.reveal();
        objIntoFocus.destroy();
      });
    }
  });
})(jQuery);
