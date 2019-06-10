/**
 * @link https://developer.mozilla.org/en-US/docs/Web/Events/resize#setTimeout
 * @param callback
 */
export function windowResizeWithThrottle (callback) {

  let resizeTimeout

  const setTimeoutHandler = ev => {
    resizeTimeout = null
    callback(ev)
    // The actualResizeHandler will execute at a rate of 15fps
  }

  const resizeThrottler = ev => {
    // ignore resize events as long as an actualResizeHandler execution is in the queue
    if (!resizeTimeout) {
      resizeTimeout = setTimeout(() => setTimeoutHandler(ev), 66)
    }
  }

  window.addEventListener('resize', ev => resizeThrottler(ev), false)

}