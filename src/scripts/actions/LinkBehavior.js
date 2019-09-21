function linkClickHandler(ev) {
  ev.preventDefault();
  if (window.location.href === ev.target.href) {
    return;
  }

  document.dispatchEvent(new CustomEvent('loading/stage-one', {}));

  // console.log(ev.target.hostname, globals.urls.local);
  if (ev.target.hostname === globals.urls.local) {
    ga('send', 'event', 'link-clicked', 'local', ev.target.href);
    Router.navigate(ev.target.pathname.concat(ev.target.search)).resolve();
  } else {
    // anything else are probably external links
    ga('send', 'event', 'link-clicked', 'external', ev.target.getAttribute('href'));
    window.open(ev.target.href, '_blank');
  }

  /**
        // fixed cta on homepage
        if ($t.closest('.fixed-cta').length) {
        ga('send', 'event', 'link-clicked', 'fixed-cta', href);
        }
        // main menu links
        if ($t.closest('#menu-main-nav').length) {
        ga('send', 'event', 'link-clicked', 'main-menu', href);
        }
        // footer menu links
        if ($t.closest('#menu-footer-nav').length) {
        ga('send', 'event', 'link-clicked', 'footer-menu', href);
        }
        if ($t.attr('target') == '_blank') {
        ga('send', 'event', 'link-clicked', 'external', href);
        return null;
        }
        if ($t.hasClass('prevent-navigation')) {
        e.preventDefault();
        ga('send', 'event', 'link-clicked', 'prevented', href);
        return null;
        }
        if ($t.closest('.menu').length) {
        self.resetFilters = true;
        }
        if (disabled) {
        e.preventDefault();
        ga('send', 'event', 'link-clicked', 'disabled', href);
        return null;
        }
    */
}

function setCurrentMenuItem(ev) {
  var menuItems = [].slice.call(document.querySelectorAll('.nav .menu-item'));
  Object.keys(menuItems).map(function(menuItem) {
    var item = menuItems[menuItem];
    var link = item.querySelector('a');

    if (link.href === window.location.href) {
      item.classList.add('current-menu-item');
    } else {
      item.classList.add('current-menu-item');
    }
  });
}

// eslint-disable-next-line no-unused-vars
function setLinkBehavior(params) {
  var links = document.wrapper.querySelectorAll('a');
  Object.keys(links).map(function(item) {
    links[item].addEventListener('click', linkClickHandler);
  });
}

document.addEventListener('loading/current-menu-item', setCurrentMenuItem);
