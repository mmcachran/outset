import lozad from 'lozad';

function lazyLoading() {
  const observer = lozad('.lozad', {
    rootMargin: '10px 0px', // syntax similar to that of CSS Margin
    threshold: 0.1, // ratio of element convergence
  });

  observer.observe();
}

export { lazyLoading };
