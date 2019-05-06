import { pipe } from 'ramda';
import { menuMobile, mobileMenu } from './menu/menuMobile';
import { lineClamping } from './features/lineClamping';
import verticalSlider from './features/verticalSlider';
// import parallax from './features/parallax';
import fadeIntro from './features/fadeIntro';
import scrollDir from 'scrolldir';

/**
 * TODO:
 * 1. Mobile Menu Toggle (keep menu separate)
 * 2. Line Clamping
 * 3. Flickity
 * 4. Object Fit
 * 5. Smooth Scroll
 * 6. Lazy Loading
 * 7. (srcset) SRC IE11 Fallback (TEST THIS FIRST)
 * 8. Menu Keyboard Tabbing
 * 9. Implement advanced font loading strategies
 * 10. Parallax library
 * 11. Animation Library (maybe just CSS)
 * 12. In view library https://github.com/w3c/IntersectionObserver/blob/master/explainer.md
 */

pipe(
  scrollDir,
  menuMobile,
  lineClamping,
  verticalSlider,
  // parallax,
  fadeIntro,
)();