document.addEventListener('view/resources', function(ev) {
  $('body').on('resources perspective', function(e, data, pyxl) {
    init();

    $('.filter-menu').stick_in_parent({ offset_top: 75 });

    if ($('.page-numbers').length) {
      var numbers = $('.page-numbers').get();
      var page = data.page;
      pyxl.page_numbers_action(data, numbers, page);
    }

    $('[data-accordion]').on({
      'down.zf.accordion': function() {
        $('body').trigger('sticky_kit:recalc');
      },
      'up.zf.accordion': function() {
        $('body').trigger('sticky_kit:recalc');
      },
    });

    pyxl.query = data.content.query;
    pyxl.filters = globals.site.filters;
    var $f = $('.filter-menu');
    var $i = $f.find('input');
    $f.on('change', 'input', function() {
      var taxQuery = {
        relation: 'AND',
      };
      var terms = {};
      $i.filter(':checked').each(function(index) {
        var $t = $(this);
        var taxonomy = $t.data('taxonomy');
        var termID = $t.val();
        terms[taxonomy] = terms[taxonomy] || [];
        terms[taxonomy].push(termID);
        taxQuery[index] = {
          taxonomy: taxonomy,
          field: 'term_id',
          terms: [termID],
        };
      });
      var filters = null;
      Object.keys(terms).map(function(item, index) {
        if (!filters) {
          filters = item + '=' + terms[item].join(',');
        } else {
          filters += '&' + item + '=' + terms[item].join(',');
        }
      });
      pyxl.filters = filters;
      pyxl.lastRoute.query = filters;
      pyxl.query.paged = 1;
      pyxl.query.taxQuery = taxQuery;
      var href = pyxl.params.root_page;
      if (filters) {
        href += '?' + filters;
      }

      pyxl.lastRoute.hasPagination = true;
      pyxl.router.navigate(href).resolve();
      pyxl.pagination_action();
    });

    function init() {
      var themeColor, themeSecondColor;

      themeColor = '#114dba';
      themeSecondColor = '#13ce66';

      if ($('#object-1').length) {
        var obj1 = new RevealFx(document.querySelector('#object-1'), {
          revealSettings: {
            bgcolor: themeColor,
            delay: 800,
            onCover: function(contentEl, revealerEl) {
              contentEl.style.opacity = 1;
            },
          },
        });
        obj1.reveal();
      }

      if ($('#object-2').length) {
        var obj2 = new RevealFx(document.querySelector('#object-2'), {
          revealSettings: {
            bgcolor: themeSecondColor,
            delay: 1050,
            direction: 'rl',
            onCover: function(contentEl, revealerEl) {
              contentEl.style.opacity = 1;
            },
          },
        });
        obj2.reveal();
      }
    }
  });
});
