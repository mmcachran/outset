function noKeyPress() {
  window.event.preventDefault();
}

function disableUserInput(params) {
  document.body.classList.add('stop-scrolling');
  window.addEventListener('keypress', noKeyPress);
}

function enableUserInput(params) {
  document.body.classList.remove('stop-scrolling');
  window.removeEventListener('keypress', noKeyPress);
}

function setLogoClasses(string = 'reset') {
  var logo = document.querySelector('.logo');
  if ('reset' === string) {
    logo.className = 'logo';
    return;
  }
  logo.classList.add('changing');
  logo.classList.add(string);
}

function revealPageTitle() {
  var pageTitle = document.querySelector('.reveal-page-title');
  if (null === pageTitle) {
    return;
  }
  var revealInstance = new RevealFx(pageTitle, {
    revealSettings: {
      bgcolor: '#13ce66',
      delay: 200,
      onCover: function(contentEl, revealerEl) {
        contentEl.style.opacity = 1;
      },
    },
  });

  revealInstance.reveal();
}

function revealModules() {
  $('#stage .module').each(function(index, section) {
    var sectionWatcher = scrollMonitor.create(section, { top: 100 });
    if (sectionWatcher.isInViewport || sectionWatcher.isAboveViewport) {
      $(section).addClass('is-active');
    }
    sectionWatcher.stateChange(function() {
      if (sectionWatcher.isInViewport || sectionWatcher.isAboveViewport) {
        $(section).addClass('is-active');
      }
    });
  });
}

function returnToTheBeginning(ev) {
  console.log('Stage Final: fin');
  document.loading.className = 'loading';
  document.body.classList.remove('pseduo-element-mouse-prevention');
  document.body.classList.remove('gracefully-fade-elements');
  document.removeEventListener('scroll', handleScrollEvent);
  setLogoClasses('reset');
  revealModules();
  revealPageTitle();
}

function pullTheCurtain(ev) {
  // Reveal the page!
  console.log('Stage 3: reveal the page');
  document.loading.classList.add('stage-three');
  enableUserInput();
  setLogoClasses('reset');
}

function setTheStage(ev) {
  console.log('Stage 2: change curtain direction');
  document.body.classList.remove('view-is-loading');
  document.loading.classList.add('stage-two');
  document.dispatchEvent(new CustomEvent('loading/current-menu-item'));
  if (0 === window.scrollY) {
    document.dispatchEvent(new CustomEvent('loading/stage-three'));
  } else {
    window.scrollTo(0, 0);
  }
}

function dropTheCurtain(ev) {
  document.body.classList.add('view-is-loading');
  document.body.classList.add('pseduo-element-mouse-prevention');
  document.addEventListener('scroll', handleScrollEvent);
  disableUserInput();
  console.log('Stage 1: draw the curtain');
  document.loading.classList.add('stage-one');
  setLogoClasses('white');
}

function handleScrollEvent(ev) {
  switch (window.scrollY) {
    case 0:
      console.log('Should be at the top now!');
      document.dispatchEvent(new CustomEvent('loading/stage-three'));
      break;
    default:
  }
}

function handleLoadingElementTransition(ev) {
  var classList = ev.target.classList;

  // After content is reshown
  if (classList.contains('stage-three')) {
    document.dispatchEvent(new CustomEvent('loading/stage-final'));
  }

  // After content is hidden
  if (classList.contains('stage-one') && !classList.contains('stage-two')) {
    document.dispatchEvent(new CustomEvent('loading/stage-two'));
  }
}

// eslint-disable-next-line no-unused-vars
function handleInitialTransition(ev) {
  if (globals.is_initial_load) {
    document.dispatchEvent(new CustomEvent('loading/stage-one'));
    globals.is_initial_load = false;
  }
}

// eslint-disable-next-line no-unused-vars
function setTransitions() {
  document.loading.addEventListener(
    'transitionend',
    handleLoadingElementTransition,
  );
  document.addEventListener('loading/stage-one', dropTheCurtain);
  document.addEventListener('loading/stage-two', setTheStage);
  document.addEventListener('loading/stage-three', pullTheCurtain);
  document.addEventListener('loading/stage-final', returnToTheBeginning);
}
