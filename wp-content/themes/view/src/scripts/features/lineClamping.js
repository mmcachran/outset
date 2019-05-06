import lineClamp from 'line-clamp';

function lineClamping () {

  const lineClampElements = document.querySelectorAll(`[data-lineclamp]`);
  if (lineClampElements) {
    [...lineClampElements].map(item =>
      lineClamp(item, parseInt(item.getAttribute(`data-lineclamp`)))
    );
  }

  const lineClampElementsInner = document.querySelectorAll(`[data-lineclampinner]`);
  if (lineClampElementsInner) {
    [...lineClampElementsInner].map(item =>
      lineClamp(item.firstElementChild, parseInt(item.getAttribute(`data-lineclampinner`)))
    );
  }
}

export {
  lineClamping
};