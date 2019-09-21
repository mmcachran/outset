(function($) {
  $('body').on('404', function(e, data, pyxl) {
    var fourohfour = pyxl.load_animation(
      $('.animation'),
      'fourohfour',
      data.content.fourohfour_animation,
      false,
    );
    fourohfour.play();
  });
})(jQuery);
