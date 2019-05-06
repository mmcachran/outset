import { pipe } from 'ramda';

function handleOpenEvent (elements) {
  const { nav } = elements;
  nav.setAttribute('aria-hidden', 'false');
  document.body.setAttribute('data-scroll-enabled', 'false');
}

function handleCloseEvent (elements) {
  const { nav } = elements;
  nav.setAttribute('aria-hidden', 'true');
  document.body.setAttribute('data-scroll-enabled', 'true');
}

function setOpenEvent (elements) {
  const { openButton } = elements;
  openButton.addEventListener('click', ev => handleOpenEvent(elements));

  return elements;
};

function setCloseEvent (elements) {
  const { overlay } = elements;
  overlay.addEventListener('click', ev => handleCloseEvent(elements));

  return elements;
};

function menuMobile () {
  const elements = {
    closeButton: document.getElementById('menuMobileClose'),
    openButton: document.getElementById('menuMobileOpen'),
    nav: document.getElementById('menuMobile'),
    overlay: document.getElementById('menuMobileOverlay'),
  };
  pipe(
    setOpenEvent,
    setCloseEvent
  )(elements);
}

export { menuMobile };