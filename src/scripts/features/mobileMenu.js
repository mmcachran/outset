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
  document.body.classList.toggle('mobile-menu-active');
};

const mobileMenu = () => {
  const toggles = document.querySelectorAll('.menu-mobile__toggle');
  const mobileMenu = document.querySelector('.menu-mobile');

  [...toggles].forEach(el => el.addEventListener('click', handleToggleClick(mobileMenu)));
};

export default mobileMenu;
