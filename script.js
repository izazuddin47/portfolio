/* ═══════════════════════════════════════════════
   IZAZ UDDIN — PORTFOLIO  |  script.js
═══════════════════════════════════════════════ */

'use strict';

/* ─── LOADER ─────────────────────────────────── */
window.addEventListener('load', () => {
  setTimeout(() => {
    const loader = document.getElementById('loader');
    if (loader) loader.classList.add('hidden');
  }, 1700);
});

/* ─── AOS INIT ───────────────────────────────── */
AOS.init({
  duration: 700,
  once: true,
  offset: 60,
  easing: 'ease-out-cubic',
});

/* ─── NAVBAR: scroll state & active link ─────── */
const navbar   = document.getElementById('navbar');
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-links a');

function onScroll() {
  /* Scrolled class */
  if (window.scrollY > 50) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }

  /* Scroll-to-top button */
  const scrollTop = document.getElementById('scrollTop');
  if (scrollTop) {
    if (window.scrollY > 400) {
      scrollTop.classList.add('visible');
    } else {
      scrollTop.classList.remove('visible');
    }
  }

  /* Active nav link */
  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 100;
    if (window.scrollY >= sectionTop) current = section.getAttribute('id');
  });
  navLinks.forEach(a => {
    a.classList.remove('active');
    if (a.getAttribute('href') === `#${current}`) a.classList.add('active');
  });
}

window.addEventListener('scroll', onScroll, { passive: true });
onScroll(); // run once on load

/* ─── SCROLL-TO-TOP ──────────────────────────── */
document.getElementById('scrollTop')?.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

/* ─── HAMBURGER MENU ─────────────────────────── */
const hamburger = document.getElementById('hamburger');
const navList   = document.getElementById('navLinks');

hamburger?.addEventListener('click', () => {
  hamburger.classList.toggle('open');
  navList.classList.toggle('open');
});

// Close on link click
navList?.querySelectorAll('a').forEach(link => {
  link.addEventListener('click', () => {
    hamburger.classList.remove('open');
    navList.classList.remove('open');
  });
});

/* ─── TYPING ANIMATION ───────────────────────── */
const typedEl   = document.getElementById('typed');
const phrases   = [
  'responsive web apps.',
  'PHP backends.',
  'clean UI/UX.',
  'MySQL databases.',
  'full-stack solutions.',
];
let phraseIndex = 0;
let charIndex   = 0;
let isDeleting  = false;

function type() {
  if (!typedEl) return;

  const current = phrases[phraseIndex];

  if (!isDeleting) {
    typedEl.textContent = current.slice(0, charIndex + 1);
    charIndex++;
    if (charIndex === current.length) {
      isDeleting = true;
      setTimeout(type, 1800); // pause before deleting
      return;
    }
    setTimeout(type, 80);
  } else {
    typedEl.textContent = current.slice(0, charIndex - 1);
    charIndex--;
    if (charIndex === 0) {
      isDeleting = false;
      phraseIndex = (phraseIndex + 1) % phrases.length;
      setTimeout(type, 400);
      return;
    }
    setTimeout(type, 45);
  }
}

// Start after loader
setTimeout(type, 1800);

/* ─── ANIMATED COUNTERS ──────────────────────── */
function animateCounter(el) {
  const target  = parseInt(el.dataset.target, 10);
  const duration = 1500;
  const step    = target / (duration / 16);
  let current   = 0;

  const timer = setInterval(() => {
    current += step;
    if (current >= target) {
      el.textContent = target;
      clearInterval(timer);
    } else {
      el.textContent = Math.floor(current);
    }
  }, 16);
}

// Trigger counters when hero is visible
const counterEls = document.querySelectorAll('.counter');
let countersStarted = false;

const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting && !countersStarted) {
      countersStarted = true;
      counterEls.forEach(el => animateCounter(el));
    }
  });
}, { threshold: 0.5 });

const heroSection = document.getElementById('hero');
if (heroSection) counterObserver.observe(heroSection);

/* ─── SKILL BARS ANIMATION ───────────────────── */
const skillFills = document.querySelectorAll('.skill-fill');

const skillObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const fill = entry.target;
      const width = fill.dataset.width;
      // Small delay so transition is visible
      setTimeout(() => {
        fill.style.width = width + '%';
      }, 200);
      skillObserver.unobserve(fill);
    }
  });
}, { threshold: 0.1 });

skillFills.forEach(fill => skillObserver.observe(fill));

/* ─── CONTACT FORM ───────────────────────────── */
// Allow the form to POST to authentication/contact_submit.php.
// No simulation here because we want real DB insertion.
const contactForm = document.getElementById('contactForm');
const formMsg     = document.getElementById('formMsg');

function showMsg(text, type) {
  if (!formMsg) return;
  formMsg.textContent = text;
  formMsg.style.color = type === 'success' ? 'var(--green)' : '#f87171';
  setTimeout(() => { formMsg.textContent = ''; }, 5000);
}


/* ─── SMOOTH SCROLL for anchor links ─────────── */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', (e) => {
    const target = document.querySelector(anchor.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

/* ─── CURSOR SPOTLIGHT (subtle) ──────────────── */
// Only on pointer devices — adds a subtle radial glow that follows the mouse
if (window.matchMedia('(pointer: fine)').matches) {
  const spotlight = document.createElement('div');
  spotlight.style.cssText = `
    position: fixed; pointer-events: none; z-index: 0;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(124,92,252,0.07) 0%, transparent 70%);
    transform: translate(-50%, -50%);
    transition: top 0.15s ease, left 0.15s ease;
    top: 50%; left: 50%;
  `;
  document.body.appendChild(spotlight);

  document.addEventListener('mousemove', (e) => {
    spotlight.style.top  = e.clientY + 'px';
    spotlight.style.left = e.clientX + 'px';
  });
}
