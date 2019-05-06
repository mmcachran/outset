export default () => {
    let targets = document.querySelectorAll('section');
    for (let i = 0; i < targets.length; i++) {
        if (!isVisible(targets[i]) && !isAbove(targets[i])) {
            targets[i].classList.add('fade-intro-hidden');
        }
    }

    function isAbove(elm) {
        let rect = elm.getBoundingClientRect();
        let viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
        return rect.bottom < viewHeight;
    }

    function isVisible(elm) {
        let rect = elm.getBoundingClientRect();
        let viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
        return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    function fadeCheck() {
        let remainingTargets = document.querySelectorAll('section.fade-intro-hidden');
        if (remainingTargets.length === 0) {
            window.removeEventListener('scroll', fadeCheck);
        }
        for (let i = 0; i < targets.length; i++) {
            if (isVisible(targets[i])) {
                targets[i].classList.remove('fade-intro-hidden');
            }
        }
    }

    window.addEventListener('scroll', fadeCheck);
}