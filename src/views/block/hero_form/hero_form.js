import anime from "animejs";

// Get list of objects to animate
const base = "HeroForm--homepage";

const init = () => {
  const animatedWrapperClass = `${base}__animated-wrapper`;
  const animeObjects = document.querySelectorAll(
    `.${animatedWrapperClass} .${base}__animated-parent`
  );
  const animationDuration = 750;
  const animationDelay = 3000;

  const animationTimeline = anime.timeline({
    easing: "easeInOutSine",
    duration: animeObjects.length * (animationDuration + animationDelay),
    loop: true,
    autoplay: true
  });

  [...animeObjects].forEach((parent, i) => {
    const timelineOffset = i === 0 ? 0 : animationDuration / 2;
    const background = parent.querySelector(`.${base}__animated-background`);

    animationTimeline.add(
      {
        targets: parent,
        changeBegin: ({ animatables }) => {
          const { clientHeight: wrapperheight } = animatables[0].target;

          parent.parentElement.style.height = `${wrapperheight}px`;
        },
        translateX: [
          {
            duration: 0,
            value: "-20px"
          },
          {
            duration: animationDuration / 2,
            value: "0"
          },
          {
            duration: animationDelay - animationDuration / 2,
            value: "0"
          },
          {
            duration: animationDuration / 2,
            value: "100%"
          }
        ],
        opacity: [
          {
            duration: 0,
            value: 0
          },
          {
            duration: animationDuration / 2,
            value: 1
          },
          {
            duration: animationDelay,
            value: 1
          },
          {
            duration: 0,
            value: 0
          }
        ]
      },
      `-=${timelineOffset}`
    );

    animationTimeline.add(
      {
        targets: background,
        width: [
          {
            duration: 0,
            value: "0"
          },
          {
            duration: 0,
            value: "0"
          },
          {
            duration: animationDuration / 2,
            value: "100%"
          }
        ]
      },
      `-=${animationDuration}`
    );
  });
};

init();

window.addEventListener(
  'SwupContentReplaced',
  ev => {
    init();
  }
)