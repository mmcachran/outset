/* eslint-disable no-alert */
/* eslint-disable */

/**
 * base Pyxl object
 **/
function Pyxl () {
  this.templates = [];
  this.currentTemplate = '';
  this.currentTemplateName = '';
  this.stage = '';
  this.excludeIds = '';
  this.logoStates = {
    type: ['hide'],
    color: []
  };
  this.animations = [];
  this.pageCount = 0;
  this.lastRoute = {
    hasPagination: false,
    root_page: false
  };
  this.resetFilters = false;
  this.allVideos = [];
}

/**
 * Changes the menu style
 *
 * @param object attrs - list of classes to add separated by a space ( )
 *
 **/
Pyxl.prototype.setMenu = function (type, resetAvailable) {
  if (!this.menuResetClasses && resetAvailable) {
    this.menuResetClasses = $('.top-menu').attr('class');
  }
  $('.top-menu').attr({ class: 'top-menu ' + type });
  $('.logo').attr('data-menu-type', type);
};

/**
 * reset the menu style
 **/
Pyxl.prototype.resetMenu = function () {
  if (this.menuResetClasses) {
    $('.top-menu').attr({ class: this.menuResetClasses });
    $('.logo').attr(
      'data-menu-type',
      this.menuResetClasses.replace('top-menu ', '')
    );
    this.menuResetClasses = null;
  }
};

Pyxl.prototype.load_fact_animations = function (data) {
  var facts = data.content.facts;
  var animations = [];
  var self = this;
  if (facts) {
    facts.map(function (fact) {
      if (fact.fact_asset) {
        if (fact.fact_asset.animation) {
          var name = fact.fact_asset.animation.name;
          var json = fact.fact_asset.animation.url;
          var anim = self.load_animation($('#' + name), name, json);
          anim.play();
          animations.push(anim);
        }
      }
    });
  }
  return animations;
};

Pyxl.prototype.info_popup = function () {
  $('.has-grid-popup').click(function () {
    var $t = $(this);
    var windowWidth = $(window).width();
    var offset = windowWidth > 640 ? 0 : 100;
    $('body,html').animate({ scrollTop: $t.offset().top - offset }, 300);
    if ($t.hasClass('active')) {
      $t.removeClass('active');
      $('.grid-popup').removeClass('active');
    } else {
      $('.has-grid-popup').removeClass('active');
      $('.grid-popup').removeClass('active');
      $t.addClass('active');
      $t.next().addClass('active');
    }
  });
  $('body').click(function (e) {
    if (!$(e.target).closest('.has-grid-popup').length) {
      $('.has-grid-popup').removeClass('active');
      $('.grid-popup').removeClass('active');
    }
  });
};

Pyxl.prototype.wistiaControl = function () {
  var self = this;
  window._wq = window._wq || [];
  _wq.push({
    id: '_all',
    onReady: function (video) {
      if (
        $(video.container).closest('.figure-video.bg-cover').length === 0 &&
        $(video.container).closest('.popup-video-container').length === 0
      ) {
        var videoElem = scrollMonitor.create(
          video.container,
          -(video.height() - 100)
        );
        videoElem.enterViewport(function () {
          // play if video has not been played all the way through or if the video is set to loop
          if (
            video.percentWatched() < 1 ||
            video.data.media.embed_options.endVideoBehavior == 'loop'
          ) {
            video.play();
            video.startAfterOverlayClosed = true;
          }
        });
        videoElem.exitViewport(function () {
          if (video.state() === 'playing') {
            video.pause();
            video.startAfterOverlayClosed = false;
          }
        });
      } else if ($(video.container).closest('.figure-video.bg-cover').length) {
        video.play();
        video.startAfterOverlayClosed = true;
      } else {
        video.popUpParent = $(video.container).closest(
          '.popup-video-container'
        );
      }
      self.allVideos.push(video);
    }
  });
};

Pyxl.prototype.goog_report_conversion = function (url) {
  var w = window;
  w.google_conversion_id = 989908308;
  w.google_conversion_label = 'YJZfCNPow3gQ1JqD2AM';
  w.google_remarketing_only = false;
  w.google_conversion_format = '3';
  var opt = new Object();
  var conv_handler = window['google_trackConversion'];
  if (typeof conv_handler === 'function') {
    conv_handler(opt);
  }
};
/**
 * Handles all AJAX requests the same way
 *
 * @param object data - must have an action set (see function/ajax-functions.php for available actions)
 * @param function callback - receives data, status, and jqXHR
 *
 **/
Pyxl.prototype.post = function post (data, callback) {
  $.ajax({
    type: 'POST',
    url: globals.urls.ajax,
    dataType: 'json',
    headers: {
      'X-Session': globals.session
    },
    data: data,
    success: function (data, textStatus, jqXHR) {
      callback(data, textStatus, jqXHR);
    }
  });
};

/**
 * Handle the loading of animations when needed
 **/
Pyxl.prototype.load_animation = function load_animation (
  elem,
  animationName,
  animationFile,
  loop
) {
  var loop = typeof loop === 'undefined';
  var params = {
    container: elem[0],
    renderer: 'svg',
    loop: loop,
    autoplay: false,
    path: animationFile
  };
  var animation = bodymovin.loadAnimation(params);
  this.animations[animationName] = animation;
  return animation;
};

/**
 * Algorithm used for generating hashes
 **/
Pyxl.prototype.hashCode = function hashCode (str) {
  var hash = 0;
  var i;
  var chr;
  if (str.length === 0) return hash;
  for (i = 0; i < str.length; i++) {
    chr = str.charCodeAt(i);
    hash = (hash << 5) - hash + chr;
    hash |= 0; // Convert to 32bit integer
  }
  return hash;
};

/**
 * wrapper for regex check for blank values
 * TRUE if str contains non whitespace characters
 **/
Pyxl.prototype.isBlank = function isBlank (str) {
  return !str || /^\s*$/.test(str);
};

/**
 * Strip slashes from the beginning and end of string
 *
 * @param string str - string to remove slashes from
 *
 **/
Pyxl.prototype.stripSlashes = function stripSlashes (str) {
  return str.replace(/^\/|\/$/g, '');
};

/**
 * Main action called for setting content to the stage
 *
 * @typedef {Object} args
 * @property {html} template_content - the template, pre-rendering
 * @property {string} view - the template name
 * @property {object} content - the the content to stuff into the template
 * @property {string} page - the url we are at (used to send GA pageview)
 * @property {string} module_id - the identifier for the page we are on
 * @property {function} callback - the function to call after the players enter the stage
 **/
Pyxl.prototype.setContentAction = function (args = {}) {
  var template_content = args.template_content;
  var content = args.content;
  var page = args.page;
  var module_id = args.module_id;
  var partials = args.partials;
  var callback = args.callback;
  var view = args.view;

  content.html = getTemplate(view, this);

  content.is_image = function () {
    return this.image_or_video == 'image';
  };
  content.theme = globals.urls.theme;

  var stage = this.stage;
  var rendered = getTemplate(view, content);

  this.previousContent = stage.html();

  $('body').attr('id', module_id);

  stage
    .html(rendered)
    .foundation()
    .removeClass('drop-curtain');
  callback();
  page = $('<a href="' + page + '" />').first();
  page = page.pathname;
  ga('set', 'page', page);
  ga('send', 'pageview');
};

/**
 * Main entrance to the stage.
 * Checks the cache before loading a new template and calling setContentAction
 * Simply passes everything to setContentAction after finding template to use
 *
 * @typedef {Object} args
 * @property {html} template_content - the template, pre-rendering
 * @property {string} view - the template nam
 * @property {object} content - the the content to stuff into the template
 * @property {string} page - the url we are at (used to send GA pageview)
 * @property {string} module_id - the identifier for the page we are on
 * @property {function} callback - the function to call after the players enter the stage
 *
 **/
Pyxl.prototype.setContent = function (args) {
  var template = args.template;
  var content = args.content;
  var page = args.page;
  var module_id = args.module_id;
  var callback = args.callback;
  var view = args.view;

  $(document).foundation();
  var self = this;
  var stage = this.stage;
  self.currentTemplate = template;
  stage.addClass('drop-curtain');
  self.setContentAction({
    content: content,
    page: page,
    module_id: module_id,
    callback: callback,
    view: view
  });
  ga('send', 'event', 'template-loaded', 'new', template, true);
};

/**
 * Sets the page title
 *
 * @param string title - the title of the current page
 *
 **/
Pyxl.prototype.setTitle = function (title) {
  ga('set', 'title', title);
  $('head title').text(title);
};

/**
 * Sets the page description
 *
 * @param string description - the description of the current page
 *
 **/
Pyxl.prototype.setDescription = function (desc) {
  $('head meta[name=description]').attr('content', desc);
};

/**
 * Main action for loading pages
 **/
Pyxl.prototype.displayPage = function (path, page) {
  if (globals.is_search) return false;

  this.pageCount++;
  this.params = {
    root_page: path || window.location.pathname
  };
  var self = this;
  var path = path || window.location.href;
  var args = {
    action: 'get_page',
    path: path
  };
  self.resetFilters = false;
  if (page) self.page = args.page = page;
  if (globals.site.filters) args.filters = globals.site.filters;
  $('body').trigger('beforeDisplayPage', [path, self]);
  this.post(args, function (response, status, jqHXR) {
    if (response.success) {
      var data = response.data;
      document.body.setAttribute('data-title', data.slug);
      self.currentTemplateName = data.template;
      self.setTitle(data.title);
      self.setDescription(data.description);
      if (data.content.exclude_ids) self.excludeIds = data.content.exclude_ids;
      self.setContent({
        view: data.template,
        template: globals.template_paths.root + data.template,
        content: data.content,
        page: path,
        module_id: data.template,
        callback: function () {
          $('body').trigger(data.template, [data, self]);
          setTimeout(function () {
            $('body').trigger('afterDisplayPage', [path, data, self]);
          }, 500);
        }
      });
    } else {
      // TODO: handle 404 here
      var data = response.data;
      // console.log(data);
      data.template = '404';
      self.setTitle('404');
      self.setDescription('Page Not Found');
      self.setContent({
        view: data.template,
        template: globals.template_paths.root + data.template,
        content: data.content,
        page: path,
        module_id: data.template,
        callback: function () {
          $('body').trigger(data.template, [data, self]);
          setTimeout(function () {
            $('body').trigger('afterDisplayPage', [path, data, self]);
          }, 500);
        }
      });
    }
  });
};

Pyxl.prototype.page_numbers_action = function (data, numbers, page) {
  if (!page) page = 1;
  var previous_page = Math.abs(page) - 1;
  var next_page = Math.abs(page) + 1;
  var numbers_html = $(numbers);
  if (Math.abs(page) > 3) {
    numbers_html
      .find('.numbers .page-number[data-page=1]')
      .nextUntil('[data-page=' + previous_page + ']')
      .wrapAll('<div class="group-numbers" />');
  }
  if (Math.abs(page) < data.content.pages.length - 4) {
    numbers_html
      .find('.numbers .page-number[data-page=' + next_page + ']')
      .nextUntil(
        '[data-page=' +
          data.content.pages[data.content.pages.length - 1].number +
          ']'
      )
      .wrapAll('<div class="group-numbers" />');
  }
  numbers_html.find('.group-numbers').before('<div class="group" />');
  $('#paginate').after(numbers_html);
};

Pyxl.prototype.pagination_action = function () {
  var loader = $('<div />')
    .attr({
      class: 'paginate-loading'
    })
    .append('<i class="icon pyxl-eye"></i>')
    .hide()
    .appendTo($('#paginate'))
    .fadeIn(200);
  var self = this;
  console.log(self);
  var pagination_template =
    self.templates[self.currentTemplate].partials.pagination_template;
  var pagination_numbers =
    self.templates[self.currentTemplate].partials.pagination_numbers;
  if (!self.href) {
    var href = window.location.pathname;
    if (this.filters) href += '?' + this.filters;
  } else {
    var href = self.href;
  }
  if (self.resetFilters) {
    self.query.taxQuery = null;
    $('.filter-menu input').prop('checked', false);
    self.resetFilters = false;
  }
  $('body,html').animate(
    {
      scrollTop: $('#paginate').offset().top - 75 + 'px'
    },
    300
  );

  self.post(
    {
      action: 'get_pagination',
      parent: self.currentTemplateName,
      excludeIds: self.excludeIds,
      query: self.query,
      root_page: self.lastRoute.root_page
    },
    function (response, status, jqHXR) {
      if (response.success) {
        var data = response.data;
        var page = data.page;
        console.log(pagination_template);
        var content = getTemplate(view, data);

        var numbers = getTemplate('pagination', data.content);

        var itemHolder = $('#paginate');
        var itemHolderOffset = itemHolder.offset().top;
        self.setTitle(data.title);
        $('.loader').fadeOut(200, function () {
          $(this).remove();
        });
        itemHolder.fadeOut(300, function () {
          $(this)
            .html(content)
            .fadeIn(300);
          if (data.content.pages.length > 1) {
            $('.page-numbers').remove();
            self.page_numbers_action(data, numbers, page);
            if (self.filters) {
              $('.page-number').each(function () {
                var $t = $(this);
                var href = $t.attr('href');
                $t.attr('href', href + '?' + self.filters);
              });
            }
          } else {
            $('.page-numbers').remove();
          }
        });
      }
    }
  );
};

Pyxl.prototype.pagination = function (params) {
  if (!this.lastRoute.hasPagination) {
    this.params = params;
    this.displayPage(params.root_page, params.page);
  } else {
    if (params && params.page) this.query.paged = params.page;
    else this.query.paged = 1;
    this.pagination_action();
  }
};
