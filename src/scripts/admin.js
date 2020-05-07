import lazyLoading from './features/lazyLoading';

// const { domReady } = wp;

const isEven = int => 0 === (int % 2);

// Hacky set interval until we fin a better hook after block editor has loaded
setInterval(function() {
  lazyLoading();
}, 1000);

function removeExtraSocialIconField() {
  // TODO: Aim to remove this section when ACF is not longer double registering
  const acfMenuItemIconFields = document.querySelectorAll('.acf-field-social-menu-item\\/icon');
  [...acfMenuItemIconFields].map((item, i) => {
    if (isEven(i)) {
      item.style.display = 'none';
    }
  });
}

document.addEventListener('DOMContentLoaded', function() {
  const isMenuPage = document.querySelector('.nav-menus-php');
  if (isMenuPage !== undefined) {
    removeExtraSocialIconField();
  }
});
