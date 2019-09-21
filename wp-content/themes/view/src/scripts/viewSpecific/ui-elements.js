document.addEventListener('view/ui-elements', function(ev) {
  $('body').on('ui-kit', function(e, data, pyxl) {
    //
    // text input fields
    //
    // text input validation to keep or remove the label movement and underline
    $('.text-input__field').focus(function() {
      $(this)
        .parent('.text-input')
        .addClass('text-input--filled');
    });

    $('.text-input__field').blur(function() {
      var thisParent = $(this).parent('.text-input');
      if (pyxl.isBlank($(this).val())) {
        thisParent.removeClass('text-input--filled');
      }
    });

    //
    // Select dropdowns
    //

    $('.select-input').focus(function() {
      $(this)
        .find('.select-input__options')
        .removeClass('hidden');
      console.log('SELECT-INPUT FOCUS');
    });

    $('.select-input__options li').click(function() {
      var thisVal = $(this).data('value');
      $(this)
        .parents('.select-input')
        .find('.select-input__label')
        .text(thisVal);

      // update actual select field value
      $(this)
        .parents('.select-input')
        .find('select.select-input__field')
        .val(thisVal);
      $(this)
        .parents('.select-input')
        .trigger('blur');
    });

    $('.select-input').blur(function() {
      $(this)
        .find('.select-input__options')
        .addClass('hidden');
    });

    //
    // checkboxes and tooltips
    //

    $('.has-tooltip')
      .mouseover(function() {
        $(this)
          .find('.tooltip')
          .removeClass('hidden');
      })
      .mouseout(function() {
        $(this)
          .find('.tooltip')
          .addClass('hidden');
      });
  });
});
