// Check if animations are allowed
const animationsAllowed = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (animationsAllowed) {
  gsap.registerPlugin(ScrollTrigger);

  // Animate cells with staggered random animations
  const cells = document.querySelectorAll('.cta-grid__grid-cell');
  const totalDuration = 1.5; // Total animation time for all cells
  const duration = 0.5; // Each cell's animation duration
  const stagger = (totalDuration - duration) / (cells.length - 1); // Calculate stagger delay

  gsap.from(cells, {
    opacity: 0,
    y: () => gsap.utils.random(-50, 50), // Random vertical movement
    x: () => gsap.utils.random(-20, 20), // Random horizontal movement
    duration: duration, // Each animation lasts 0.5 seconds
    ease: 'power1.out', // Smooth easing
    stagger: stagger, // Delay between animations
    scrollTrigger: {
      trigger: '.cta-grid__grid-row', // The grid container
      start: 'top 80%', // Start animation when grid enters viewport
      toggleActions: 'play none none reset', // Replay on re-entry
    },
  });

  // Helper function to apply animations
  const applyAnimation = (element, config, isReplay) => {
    const animationConfig = { ...config };

    if (element.classList.contains('fade-in-from-bottom')) {
      animationConfig.y = 50;
    } else if (element.classList.contains('fade-in-from-top')) {
      animationConfig.y = -50;
    } else if (element.classList.contains('fade-in-from-left')) {
      animationConfig.x = Math.min(-50, -window.innerWidth / 10); // Limit movement to a fraction of the viewport width
    } else if (element.classList.contains('fade-in-from-right')) {
      animationConfig.x = Math.min(50, window.innerWidth / 10); // Same for right movement
    }

    gsap.fromTo(
      element,
      { opacity: 0, x: animationConfig.x || 0, y: animationConfig.y || 0 },
      {
        opacity: 1,
        x: 0,
        y: 0,
        duration: animationConfig.duration,
        delay: animationConfig.delay,
        scrollTrigger: {
          trigger: isReplay ? element.closest('.replay') || element : element,
          start: 'top 80%',
          toggleActions: isReplay ? 'play reset play reset' : 'play none none none',
        },
      }
    );
  };

  // Animate all elements with fade-in classes
  const animatedElements = document.querySelectorAll('.fade-in, [class*="fade-in-"]');
  animatedElements.forEach((element) => {
    const delayClass = [...element.classList].find((cls) => cls.startsWith('delay-'));
    const delay = delayClass ? parseInt(delayClass.split('-')[1], 10) / 1000 : 0;

    const durationClass = [...element.classList].find((cls) => cls.startsWith('duration-'));
    const duration = durationClass ? parseInt(durationClass.split('-')[1], 10) / 1000 : 0.5;

    const isReplay = element.closest('.replay') !== null;

    applyAnimation(element, { duration, delay }, isReplay);
  });

  // Refresh ScrollTrigger
  ScrollTrigger.refresh();
}