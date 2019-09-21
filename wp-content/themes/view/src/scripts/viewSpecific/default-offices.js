(function($) {
  $('body').on('default-offices', function(e, data, pyxl) {
    pyxl.load_fact_animations(data);
  });
})(jQuery);
