export default () => {

    const tabTriggers = document.querySelectorAll('[data-tabtrigger]');
    const tabTargets = document.querySelectorAll('[data-tabtarget]');

    const getTargetValue = e =>
        e.getAttribute('data-tabtrigger');

    const tabTriggerFindMatch = string =>
        document.querySelector(`[data-tabtrigger=${string}]`);

    const tabTargetFindMatch = string =>
        document.querySelector(`[data-tabtarget=${string}]`);

    const showTabTarget = e =>
        e.setAttribute('aria-hidden', false);

    const tabTriggerActivate = e =>
        e.setAttribute('aria-selected', true);

    const resetTabTriggers = () =>
        Object.keys(tabTriggers).map(key => {
            tabTriggers[key].setAttribute('aria-selected', false)
        });

    const resetTabTargets = () =>
        Object.keys(tabTargets).map(key => {
            tabTargets[key].setAttribute('aria-hidden', true)
        });
    const saveTabChoice = value =>
        localStorage.setItem('openTab', value);

    const getTabChoice = () =>
        localStorage.getItem('openTab');

    const tabChange = e => {
        // Triggers
        resetTabTriggers();
        tabTriggerActivate(e);
        // Targets
        resetTabTargets();
        let value = getTargetValue(e);
        let match = tabTargetFindMatch(value);
        saveTabChoice(value);
        showTabTarget(match);
    };

    const triggerClickEvent = e =>
        e.addEventListener('click', ev => {
            ev.preventDefault();
            tabChange(e);
        });

    // Run
    if (tabTargets.length > 0) {
        Object.keys(tabTriggers).map(key => {
            triggerClickEvent(tabTriggers[key])
        });

        document.addEventListener('DOMContentLoaded', ev => {
            let savedChoice = getTabChoice();
            if ('null' !== savedChoice) {
                let e = tabTriggerFindMatch(savedChoice);
                tabChange(e);
            }
        }, false);
    }
}