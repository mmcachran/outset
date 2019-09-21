(function($) {
  // eslint-disable-next-line no-unused-vars
  function defaultPost(e, data, pyxl) {
    if (768 <= !$(window).width()) {
      return;
    }
    var sectionWatcher = scrollMonitor.create($('#stage'), {
      top: 0,
      bottom: 0,
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
  $('body').on('default-post');
})(jQuery);
