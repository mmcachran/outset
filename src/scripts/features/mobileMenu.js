const handleToggleClick = menu => ({ currentTarget }) => {
  const {
    action = 'toggle',
  } = currentTarget.dataset;
  const hidden = 'true' === menu.getAttribute('aria-hidden');
  const hide = 'close' === action
    ? true
    : 'open' === action
      ? false
      : !hidden;

  menu.setAttribute('aria-hidden', hide);
  document.body.setAttribute('data-scroll-enabled', hide);
};

const mobileMenu = () => {
  const toggles = document.querySelectorAll('.menu_toggle');
  const mobileMenu = document.querySelector('.header__menu--mobile');

  [...toggles].forEach(
    el => {
      el.addEventListener(
        'click',
        handleToggleClick(mobileMenu),
      );
    },
  );
};

export default mobileMenu;
