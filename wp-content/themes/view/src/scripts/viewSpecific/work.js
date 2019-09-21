document.addEventListener('workEvent', function() {
  // pyxl.info_popup();

  function compareMenuOrder(a, b) {
    if ($(a).data('menu-order') < $(b).data('menu-order')) {
      return -1;
    }
    if ($(a).data('menu-order') > $(b).data('menu-order')) {
      return 1;
    }
    return 0;
  }

  var desktopWork = $('.work-items-holder').html();
  $(window)
    .resize(function() {
      var size = $(this).width();
      if (640 > size) {
        var workItems = $('.js-work-cta-item');
        workItems.sort(compareMenuOrder);
        var container = $('<div class="columns small-12" />');
        workItems.each(function() {
          $(this).appendTo(container);
        });
        $('.work-items-holder')
          .addClass('mobile')
          .html(container);
      } else {
        if ($('.work-items-holder').hasClass('mobile')) {
          $('.work-items-holder').html(desktopWork);
        }
      }
    })
    .resize();
});
