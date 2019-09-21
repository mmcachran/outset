/* global setRouter, setLinkBehavior, setTransitions, handleInitialTransition */

// $('.has-tooltip').mouseover(function () {
//   $(this).find('.tooltip').removeClass('hidden');
// }).mouseout(function () {
//   $(this).find('.tooltip').addClass('hidden');
// });

function run(ev) {
  Object.assign(document, {
    wrapper: document.querySelector('#wrapper'),
    loading: document.querySelector('.loading'),
    main: document.querySelector('main'),
    editLink: document.querySelector('#wp-admin-bar-edit a'),
  });

  compose(
    setRouter(),
    setLinkBehavior(),
    setTransitions(),
    handleInitialTransition(),
  );
}

document.addEventListener('DOMContentLoaded', run);
