/* eslint-disable no-unused-vars */

function compose() {
  var funcs = Array.prototype.slice.call(arguments).reverse(); // turn args into (reversed) array
  return function() {
    return funcs.slice(1).reduce(function(res, fn) {
      return fn(res);
    }, funcs[0].apply(undefined, arguments));
  };
}

function getView(view) {
  // eslint-disable-next-line no-prototype-builtins
  if (!globals.templates.hasOwnProperty(view)) {
    return '404';
  }
  return globals.templates[view].template;
}

function render(selector, templates) {
  var parser = new DOMParser();

  var element = document.querySelector(selector);

  if ('string' === typeof templates) {
    var newElement = parser.parseFromString(templates, 'text/html');
    selector.innerHTML = templates;
    document.dispatchEvent(new CustomEvent('view/domReady/' + templates), {
      detail: {
        element: newElement,
      },
    });
  } else if ('object' === typeof templates) {
    var html = '';
    templates.map(function(template) {
      html = html.concat(template);
      document.dispatchEvent(new CustomEvent('view/domReady/' + template));
    });
    element.innerHTML = html;
  } else {
    console.warn(this + ' only supports strings or an array of strings');
  }
}

/**
 * Mustache wrapper to return html string
 *
 * @param {string} view - the template name
 * @param {object} content - the the content to stuff into the template
 **/
function getTemplate(view, content) {
  return Mustache.render(getView(view), content);
}
