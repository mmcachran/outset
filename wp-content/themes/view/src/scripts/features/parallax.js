import Rellax from 'rellax';

export default function () {
    // Using Rellax Library for Parallax
    // var rellax = new Rellax('.rellax', {
    //     // speed: -2,
    //     // center: false,
    //     wrapper: null,
    //     // round: true,
    //     vertical: true,
    //     // horizontal: false
    // });
    var rellax = new Rellax('.rellax');

    console.log(rellax, 'Rellax');
    // Rellax ends here!

    // OG Parallax from Access Ventures Site //
    // const layers = [].slice.call(document.querySelectorAll('[data-type=\'parallax\']'));
    // window.addEventListener(
    //     'scroll',
    //     () => {
    //         const {scrollY = 0} = window;
    //
    //         layers.forEach(
    //             el => {
    //                 const {depth = 0} = el.dataset;
    //                 const movement = -(scrollY * parseFloat(depth));
    //                 el.style.transform = `translate3d(0, ${movement}px, 0)`;
    //             }
    //         )
    //     },
    // );
}

