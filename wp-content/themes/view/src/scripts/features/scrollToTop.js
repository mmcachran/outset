export default () => {
    let intervalId = 0; // Needed to cancel the scrolling when we're at the top of the page
    const scrollButton = document.querySelector('.scroll'); // Reference to our scroll button
    const speed = .1;

    const scrollStep = () => {
        // Check if we're at the top already. If so, stop scrolling by clearing the interval
        if (window.pageYOffset === 0) {
            clearInterval(intervalId);
        }
        window.scroll(0, window.pageYOffset - 50);
    };

    function scrollToTop() {
        intervalId = setInterval(scrollStep, speed);
    }

// When the DOM is loaded, this click handler is added to our scroll button
    scrollButton.addEventListener('click', scrollToTop);
}