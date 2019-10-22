const base = 'Tabs';

const handleTabClick = ({ tabs, tabTitles }) => ({ currentTarget: currentTabTitle }) => {
  const isSelected = currentTabTitle.getAttribute('aria-selected') === 'true';
  const { tab: tabKey } = currentTabTitle.dataset;

  if (! isSelected) {
    const selectedTabTitle = [].find.call(tabTitles, tabTitle => tabTitle.getAttribute('aria-selected') === 'true');
    const selectedTab = [].find.call(tabs, tab => tab.getAttribute('aria-expanded') === 'true');
    const currentTab = [].find.call(tabs, tab => tab.dataset.tab === tabKey);

    selectedTabTitle.setAttribute('aria-selected', false);
    currentTabTitle.setAttribute('aria-selected', true);

    selectedTab.setAttribute('aria-expanded', false);
    currentTab.setAttribute('aria-expanded', true);
  }
}

const setupTabClickHandler = ({ tabs, tabTitles }) => tabTitle => {
  tabTitle.addEventListener(
    'click',
    handleTabClick({
      tabs,
      tabTitles
    })
  )
};

const setupTabGroup = tabGroup => {
  const tabTitles = tabGroup.querySelectorAll(`.${base}__tab-title`);
  const tabs = tabGroup.querySelectorAll(`.${base}__tab-content`);

  [...tabTitles].forEach(
    setupTabClickHandler({
      tabs,
      tabTitles
    })
  );
};

const init = () => {
  const tabGroups = document.querySelectorAll(`.${base}`);

  [...tabGroups].forEach(
    setupTabGroup
  );
}

init();

window.addEventListener(
  'SwupContentReplaced',
  ev => {
    init();
  }
)