// Check if animations are allowed (you can define this logic globally)
const animationsAllowed = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Wrap all animations in an if-statement
if (animationsAllowed) {
  gsap.registerPlugin(ScrollTrigger);

  const totalDuration = 1.5; // Total time for all animations
  const cells = document.querySelectorAll('.cta-grid__grid-cell');
  const duration = 0.5; // Each cell's animation duration
  const stagger = (totalDuration - duration) / (cells.length - 1); // Calculate stagger

  // Animate cells
  gsap.from(cells, {
    opacity: 0,
    y: () => gsap.utils.random(-50, 50), // Random vertical movement
    x: () => gsap.utils.random(-20, 20), // Random horizontal movement
    duration: duration, // Each animation lasts 0.5 seconds
    ease: 'power1.out', // Smooth easing
    stagger: stagger, // Delay between animations
    scrollTrigger: {
      trigger: '.cta-grid__grid-row',
      start: 'top 65%',
      end: 'top 60%',
    },
  });

  // Select all elements with animation classes
  const animatedElements = document.querySelectorAll('.fade-in, [class*="fade-in-"]');

  animatedElements.forEach((element) => {
    // Extract delay from class name (default to 0 if no delay class is present)
    const delayClass = [...element.classList].find((cls) => cls.startsWith('delay-'));
    const delay = delayClass ? parseInt(delayClass.split('-')[1], 10) / 1000 : 0; // Convert milliseconds to seconds

    // Extract duration from class name (default to 0.5s if no duration class is present)
    const durationClass = [...element.classList].find((cls) => cls.startsWith('duration-'));
    const duration = durationClass ? parseInt(durationClass.split('-')[1], 10) / 1000 : 0.5; // Default to 500ms

    const animationType = [...element.classList].find((cls) => cls.startsWith('fade-in'));

    const animationConfig = {
      opacity: 0,
      duration: duration, // Use dynamic or default duration
      ease: 'power1.out',
      delay: delay, // Apply extracted delay
    };

    if (animationType === 'fade-in-from-bottom') {
      animationConfig.y = 50;
    } else if (animationType === 'fade-in-from-top') {
      animationConfig.y = -50;
    } else if (animationType === 'fade-in-from-left') {
      animationConfig.x = -50;
    } else if (animationType === 'fade-in-from-right') {
      animationConfig.x = 50;
    } else if (animationType === 'fade-in') {
      animationConfig.opacity = 0;
    }

    gsap.from(element, {
      ...animationConfig,
      scrollTrigger: {
        trigger: element,
        start: 'top 80%',
        toggleActions: 'play none none reset',
      },
    });
  });
}