(function($) {
  $('body').on('default-resources', function(e, data, pyxl) {
    // if( data.content.landing_page ) pyxl.router.navigate(data.content.landing_page).resolve();

    $('#sticky-side-menu').stick_in_parent({ offset_top: 106 });
    $(window).scroll(function() {
      var wOffset = $(this).scrollTop();
      $('section.content-holder').each(function(index) {
        var $t = $(this);
        var offset = $t.offset().top - wOffset;
        if (100 >= offset && 50 < offset) {
          var id = $t.attr('id');
          $('#sticky-side-menu a.active').removeClass('active');
          $('#sticky-side-menu a[href="#' + id + '"]').addClass('active');
        }
      });
    });
  });
})(jQuery);
