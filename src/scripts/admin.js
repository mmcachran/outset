import lazyLoading from './features/lazyLoading';

// const { domReady } = wp;

// Hacky set interval until we fin a better hook after block editor has loaded
setInterval(function() {
  lazyLoading();
}, 1000);
