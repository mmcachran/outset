// (function ($) {
//   $('body').on('afterDisplayPage', function (e, path, data, pyxl) {
//     if (data.content.form) {
//       var onFormReady = function ($form, ctx) {
//         var submit_parent = $form.find('.hs_submit'),
//           submit_element = submit_parent.find('input'),
//           submit_attrs = submit_element[0].attributes,
//           submit_text = submit_element.val(),
//           button_attrs = {};
//         for (var i = submit_attrs.length - 1; i >= 0; i--) {
//           button_attrs[submit_attrs[i].name] = submit_attrs[i].value;
//         }
//         var submit_button = $('<button />').attr(button_attrs).text(submit_text);
//         submit_parent.find('.actions').html(submit_button);
//         $form.find('label').each(function (e) {
//           var $t = $(this),
//             $p = $t.closest('.field'),
//             clone = $t.clone(),
//             inputCtnr = $p.find('.input'),
//             input = $p.find('.input input');
//           if (input.attr('type') == 'text' || input.attr('type') == 'email' || input.attr('type') == 'tel') {
//             $t.remove();
//             inputCtnr.after(clone);
//             inputCtnr.addClass('text-input');
//           }
//           if (inputCtnr.children('textarea').length) {
//             $t.addClass('textarea-input__label');
//           }
//         });
//         $('input, textarea', '.text-input').focus(function () {
//           $(this).closest('.text-input').addClass('text-input--focused');
//         });
//         $('input, textarea', '.text-input').blur(function () {
//           var thisParent = $(this).closest('.text-input');
//           thisParent.removeClass('text-input--focused');
//           if (!pyxl.isBlank($(this).val())) {
//             thisParent.addClass('text-input--filled');
//           }
//         });
//         $form.find('select').each(function (e) {
//           var $t = $(this),
//             options = $t.find('option'),
//             preppedOptions = [],
//             label = $t.closest('.field').find('label'),
//             labelClone = label.clone().addClass('select-input__label'),
//             activeItem = false;
//           label.remove();
//           options.map(function (index, item) {
//             if (!pyxl.isBlank($(item).attr('value'))) {
//               preppedOptions.push({
//                 value: $(item).attr('value'),
//                 text: $(item).text()
//               });
//               if ($(item).is(':selected')) {
//                 activeItem = $(item).attr('value');
//               }
//             }
//           });
//           if (activeItem !== false) {
//             labelClone.text(activeItem);
//           }
//           selectElem = Mustache.render('<div class="select-input__options closed"><ul>{{ #options }}<li data-value="{{ value }}">{{ text }}</li>{{ /options }}</ul></div>', { options: preppedOptions });
//           var selectElemReady = $('<div />').append(labelClone).addClass('select-input inactive').append(selectElem);
//           $t.closest('.field').append(selectElemReady).find('.input').css({
//             position: 'absolute',
//             top: '-9999px',
//             left: '-9999px',
//           });
//         });
//         $('.select-input__label').click(function (e) {
//           e.preventDefault();
//           $('.select-input__options').addClass('closed');
//           $('.select-input').addClass('inactive');
//           var $t = $(this),
//             $p = $t.closest('.select-input'),
//             options = $p.find('.select-input__options');
//           if ($(e.target).closest('.select-input__options').length < 1) {
//             options.removeClass('closed');
//             $p.removeClass('inactive');
//           }
//         });
//         $('.select-input__options li').click(function () {
//           var $t = $(this),
//             selectInput = $t.closest('.select-input'),
//             field = $t.closest('.field'),
//             thisVal = $t.data('value');
//           selectInput.find('.select-input__label').text(thisVal);
//           // update actual select field value
//           field.find('select').val(thisVal).change();
//           selectInput.addClass('inactive').find('.select-input__options').addClass('closed');
//         });
//         $('body').click(function (e) {
//           var target = $(e.target);
//           if (target.closest('.select-input').length < 1) {
//             $('.select-input__options').addClass('closed');
//             $('.select-input:not(.inactive)').closest('.field').find('select').change();
//             $('.select-input').addClass('inactive');
//           }
//         });
//         $('input').trigger('blur');
//       };
//       var onFormSubmit = function ($form) {
//         // if( data.track_conversion ){
//         pyxl.goog_report_conversion();
//         // }
//         if (data.content.send_user_to) {
//           setTimeout(function () {
//             pyxl.router.navigate(data.content.send_user_to);
//             pyxl.router.resolve();
//             Cookies.set('form_submitted_' + data.post_id, data.content.send_user_to, { expires: 7 });
//           }, 2000);
//         }
//       };
//       var args = {
//         portalId: '218184',
//         formId: data.content.form,
//         target: '#hs-form-holder',
//         css: '',
//         inlineMessage: data.content.form_success_message,
//         submitButtonClass: 'button button-green button-solid',
//         onFormReady: onFormReady,
//         onFormSubmit: onFormSubmit
//       };
//       if (data.content.gotowebinar_id) {
//         args.goToWebinarWebinarKey = data.content.gotowebinar_id;
//       }
//       hbspt.forms.create(args);
//     }
//   });
// })(jQuery);
