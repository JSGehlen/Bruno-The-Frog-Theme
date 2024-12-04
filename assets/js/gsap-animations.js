gsap.registerPlugin(ScrollTrigger);

const totalDuration = 1.5; // Total time for all animations
const cells = document.querySelectorAll('.cta-grid__grid-cell');
const duration = 0.5; // Each cell's animation duration
const stagger = (totalDuration - duration) / (cells.length - 1); // Calculate stagger

gsap.from(cells, {
  opacity: 0,
  y: () => gsap.utils.random(-50, 50), // Random vertical movement
  x: () => gsap.utils.random(-20, 20), // Random horizontal movement
  duration: duration, // Each animation lasts 0.5 seconds
  ease: 'power1.out', // Smooth easing
  stagger: stagger, // Delay between animations
  scrollTrigger: {
    trigger: '.cta-grid__grid-row',
    start: 'top 85%',
    end: 'top 60%',
  },
});