import {noop} from '../utils/general';

export default () => {

    const slideContent = document.querySelectorAll('.carousel-content__item');


    const handleListener = el =>
        el.classList.add('active');

    const handleIteration = el =>
        el.addEventListener('click', ev => handleListener(el));

    [...slideContent].map(el => handleIteration(el));
}