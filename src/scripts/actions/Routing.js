function handleRoutePosts(params) {
  axios
    .get(globals.urls.endpoint.concat('posts?slug=').concat(params.page))
    .then(function(response) {
      document.dispatchEvent(
        new CustomEvent('view/post', {
          detail: {
            post: response.data.shift(),
          },
        }),

      );
    });
}

function handleRoutePagesMaybe(params) {
  console.log('Page: ', params.page);
  axios
    .get(globals.urls.endpoint.concat('pages?slug=').concat(params.page))
    .then(function(response) {
      var post = response.data.shift();
      console.log('View:', 'view/' + post.template_name);
      document.dispatchEvent(
        new CustomEvent('view/' + post.template_name, {
          detail: {
            post: post,
          },
        }),
      );
    });
}

function handleRouteFallback(params) {
  // Front Page
  console.log('Route: Fallback');
  axios
    .get(globals.urls.root.concat('/wp-json/custom/v1/frontpage'))
    .then(function(response) {
      var context = {
        detail: {
          post: response.data,
        },
      };
      document.dispatchEvent(new CustomEvent('view/front-page', context));
    });
}

function handleRouteNotFound(params) {
  console.warn('Route not found');
}

function handleRouteBefore(done, params) {
  // console.log('Before: ', params);
  done();
}

function handleRouteAfter(params) {
  console.log('After: ', params);
  // document.dispatchEvent(new CustomEvent('view/front-page', context))
}

function getRouter() {
  var router = new Navigo(globals.urls.root);

  // Define routes
  router.on({
    'articles/:article': handleRoutePosts,
    ':page': handleRoutePagesMaybe,
    '*': handleRouteFallback, // Generally, pages
  });

  // Fallback
  router.on(function() {
    console.log('Fallback');
  });

  // Hooks
  router.hooks({
    before: handleRouteBefore,
    after: handleRouteAfter,
  });

  // Not Found
  router.notFound(handleRouteNotFound);

  router.resolve();

  return router;
}

// eslint-disable-next-line no-unused-vars
function setRouter() {
  window.Router = getRouter();
}
