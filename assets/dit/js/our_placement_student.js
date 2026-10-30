/**
 * The IoT Academy (TIA) - Placement & Career Portal
 * Core Interactive Scripts
 */

// ============================================
// 1. MOBILE NAVIGATION
// ============================================
function initMobileMenu() {
  const hamburger = document.getElementById('hamburger');
  const navLinks = document.getElementById('navLinks');
  const overlay = document.getElementById('navOverlay');

  if (hamburger && navLinks) {
    const toggleMenu = () => {
      hamburger.classList.toggle('active');
      navLinks.classList.toggle('open');
      if (overlay) overlay.classList.toggle('show');
    };

    hamburger.addEventListener('click', toggleMenu);
    if (overlay) overlay.addEventListener('click', toggleMenu);
    navLinks.querySelectorAll('a').forEach(link => link.addEventListener('click', toggleMenu));
  }
}

// ============================================
// HELPER: SEAMLESS 360-DEGREE INFINITE CAROUSEL
// ============================================
function createInfiniteCarousel({
  track,
  cardSelector,
  prevBtn,
  nextBtn,
  transitionDuration = 450,
  transitionTiming = 'cubic-bezier(0.25, 1, 0.5, 1)',
  getVisibleCount = () => 1,
  onIndexChange
}) {
  if (!track) return null;
  const originalCards = Array.from(track.querySelectorAll(cardSelector));
  const N = originalCards.length;
  if (N <= 1) return null;

  // 1. Prepend clones of all original cards
  const prependFrag = document.createDocumentFragment();
  originalCards.forEach((card) => {
    const clone = card.cloneNode(true);
    clone.classList.add('carousel-clone', 'clone-prepend');
    clone.setAttribute('aria-hidden', 'true');
    clone.removeAttribute('id');
    clone.querySelectorAll('[id]').forEach((el) => el.removeAttribute('id'));
    prependFrag.appendChild(clone);
  });
  track.insertBefore(prependFrag, originalCards[0]);

  // 2. Append clones of all original cards
  const appendFrag = document.createDocumentFragment();
  originalCards.forEach((card) => {
    const clone = card.cloneNode(true);
    clone.classList.add('carousel-clone', 'clone-append');
    clone.setAttribute('aria-hidden', 'true');
    clone.removeAttribute('id');
    clone.querySelectorAll('[id]').forEach((el) => el.removeAttribute('id'));
    appendFrag.appendChild(clone);
  });
  track.appendChild(appendFrag);

  // Logical index: 0 corresponds to first real card (DOM index N)
  let currentIndex = 0;
  let fallbackTimer = null;
  let lastClickTime = 0;
  const throttleMs = 120;
  const transitionCss = `transform ${transitionDuration}ms ${transitionTiming}`;

  function getStep() {
    const children = track.children;
    if (children.length > N + 1) {
      const r0 = children[N].getBoundingClientRect();
      const r1 = children[N + 1].getBoundingClientRect();
      const diff = r1.left - r0.left;
      if (diff > 0) return diff;
    }
    const first = track.querySelector(cardSelector);
    if (first) {
      const gap = parseFloat(window.getComputedStyle(track).gap) || 0;
      return first.getBoundingClientRect().width + gap;
    }
    return 0;
  }

  function applyPosition(animated) {
    if (animated) {
      track.style.transition = transitionCss;
    } else {
      track.style.transition = 'none';
    }
    const step = getStep();
    const shift = (N + currentIndex) * step;
    track.style.transform = `translateX(-${shift}px)`;
    if (track.parentElement && track.parentElement.scrollLeft !== 0) {
      track.parentElement.scrollLeft = 0;
    }
    if (!animated) {
      void track.offsetHeight; // synchronous layout flush
      track.style.transition = '';
    }
  }

  function checkBoundary() {
    clearTimeout(fallbackTimer);
    const normalized = ((currentIndex % N) + N) % N;
    if (currentIndex !== normalized) {
      track.style.transition = 'none';
      currentIndex = normalized;
      const step = getStep();
      const shift = (N + currentIndex) * step;
      track.style.transform = `translateX(-${shift}px)`;
      void track.offsetHeight;
      track.style.transition = '';
    }
    if (onIndexChange) {
      onIndexChange(((currentIndex % N) + N) % N, N);
    }
  }

  function moveTo(index) {
    currentIndex = index;
    applyPosition(true);
    if (onIndexChange) {
      onIndexChange(((currentIndex % N) + N) % N, N);
    }

    clearTimeout(fallbackTimer);
    fallbackTimer = setTimeout(checkBoundary, transitionDuration + 80);
  }

  function next() {
    const now = Date.now();
    if (now - lastClickTime < throttleMs) return;
    lastClickTime = now;

    const visible = getVisibleCount();
    // Safety clamp to never exceed cloned buffer even under rapid spam
    if (currentIndex >= 2 * N - visible) {
      checkBoundary();
    }
    moveTo(currentIndex + 1);
  }

  function prev() {
    const now = Date.now();
    if (now - lastClickTime < throttleMs) return;
    lastClickTime = now;

    if (currentIndex <= -N) {
      checkBoundary();
    }
    moveTo(currentIndex - 1);
  }

  nextBtn?.addEventListener('click', (e) => {
    e.preventDefault();
    next();
  });

  prevBtn?.addEventListener('click', (e) => {
    e.preventDefault();
    prev();
  });

  track.addEventListener('transitionend', (e) => {
    if (e.target !== track || e.propertyName !== 'transform') return;
    checkBoundary();
  });

  // Touch Swipe Support
  let touchStartX = 0;
  let touchStartY = 0;
  track.addEventListener('touchstart', (e) => {
    if (!e.touches || e.touches.length === 0) return;
    touchStartX = e.touches[0].clientX;
    touchStartY = e.touches[0].clientY;
  }, { passive: true });

  track.addEventListener('touchend', (e) => {
    if (!e.changedTouches || e.changedTouches.length === 0) return;
    const diffX = e.changedTouches[0].clientX - touchStartX;
    const diffY = e.changedTouches[0].clientY - touchStartY;
    if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
      if (diffX < 0) {
        next();
      } else {
        prev();
      }
    }
  }, { passive: true });

  // Window Resize & Page Load repositioning
  window.addEventListener('resize', () => {
    applyPosition(false);
  });
  window.addEventListener('load', () => {
    applyPosition(false);
  });

  // Initial positioning
  applyPosition(false);
  if (onIndexChange) {
    onIndexChange(0, N);
  }

  return {
    next,
    prev,
    goTo: (idx) => moveTo(idx),
    checkBoundary,
    getCurrentIndex: () => currentIndex
  };
}

// ============================================
// 2. HERO SHOWCASE CAROUSEL
// ============================================
function initHeroCarousel() {
  const placementCardsGrid = document.getElementById('placementCardsGrid');
  const boardPrev = document.getElementById('boardPrev');
  const boardNext = document.getElementById('boardNext');

  createInfiniteCarousel({
    track: placementCardsGrid,
    cardSelector: '.showcase-card',
    prevBtn: boardPrev,
    nextBtn: boardNext,
    transitionDuration: 450,
    transitionTiming: 'cubic-bezier(0.25, 1, 0.5, 1)',
    getVisibleCount: () => (window.innerWidth <= 576 ? 1 : 2)
  });
}

// ============================================
// 3. LINKEDIN STUDENT STORIES CAROUSEL
// ============================================
function initLinkedInCarousel() {
  const linkedinCardsGrid = document.getElementById('linkedinCardsGrid');
  const linkedinNext = document.getElementById('linkedinNext');
  const linkedinPrev = document.getElementById('linkedinPrev');

  function getLinkedInVisibleCount() {
    if (window.innerWidth <= 576) return 1;
    if (window.innerWidth <= 1024) return 2;
    return 3;
  }

  createInfiniteCarousel({
    track: linkedinCardsGrid,
    cardSelector: '.linkedin-student-card',
    prevBtn: linkedinPrev,
    nextBtn: linkedinNext,
    transitionDuration: 450,
    transitionTiming: 'cubic-bezier(0.25, 1, 0.5, 1)',
    getVisibleCount: getLinkedInVisibleCount
  });
}

// ============================================
// 4. CAREER TRANSITIONS CONTROLS
// ============================================
function initCareerCarousel() {
  const careerCardsGrid = document.getElementById('careerCardsGrid');
  document.getElementById('careerNext')?.addEventListener('click', () => {
    if (careerCardsGrid) {
      careerCardsGrid.scrollBy({ left: 370, behavior: 'smooth' });
    }
  });
  document.getElementById('careerPrev')?.addEventListener('click', () => {
    if (careerCardsGrid) {
      careerCardsGrid.scrollBy({ left: -370, behavior: 'smooth' });
    }
  });
}

// ============================================
// 5. REVIEW CAROUSEL & DOTS
// ============================================
function initReviewCarousel() {
  const reviewsTrack = document.getElementById('reviewsTrack');
  const reviewNext = document.getElementById('reviewNext');
  const reviewPrev = document.getElementById('reviewPrev');
  const reviewDots = Array.from(document.querySelectorAll('.review-dot'));

  function getReviewVisibleCount() {
    if (window.innerWidth <= 576) return 1;
    if (window.innerWidth <= 1024) return 2;
    return 3;
  }

  function updateReviewDots(normalizedIndex, totalCards) {
    if (!reviewDots.length) return;
    const segmentSize = Math.ceil(totalCards / reviewDots.length);
    const activeDotIdx = Math.min(Math.floor(normalizedIndex / segmentSize), reviewDots.length - 1);
    reviewDots.forEach((dot, idx) => {
      dot.classList.toggle('active', idx === activeDotIdx);
    });
  }

  const carousel = createInfiniteCarousel({
    track: reviewsTrack,
    cardSelector: '.review-dark-card',
    prevBtn: reviewPrev,
    nextBtn: reviewNext,
    transitionDuration: 400,
    transitionTiming: 'cubic-bezier(0.25, 1, 0.5, 1)',
    getVisibleCount: getReviewVisibleCount,
    onIndexChange: updateReviewDots
  });

  // Dot click navigation with circular shortest path
  if (carousel && reviewDots.length) {
    const originalCards = reviewsTrack.querySelectorAll('.review-dark-card:not(.carousel-clone)');
    const N = originalCards.length || 8;
    const segmentSize = Math.ceil(N / reviewDots.length);

    reviewDots.forEach((dot) => {
      dot.addEventListener('click', (e) => {
        e.preventDefault();
        const dotIdx = parseInt(dot.getAttribute('data-index') || '0', 10);
        const targetCard = Math.min(dotIdx * segmentSize, N - 1);
        const currentNorm = ((carousel.getCurrentIndex() % N) + N) % N;
        let delta = targetCard - currentNorm;
        if (delta > N / 2) delta -= N;
        if (delta < -N / 2) delta += N;
        carousel.goTo(carousel.getCurrentIndex() + delta);
      });
    });
  }
}

// ============================================
// 6. FAQ SINGLE-OPEN ACCORDION
// ============================================
function initFAQAccordion() {
  const container = document.getElementById('faqGrid');
  if (!container) return;

  container.querySelectorAll('.faq-question-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.faq-card');
      if (!card) return;

      const isAlreadyActive = card.classList.contains('active');

      // Close all cards so only one can be open at a time
      container.querySelectorAll('.faq-card').forEach(c => {
        c.classList.remove('active');
      });

      // If clicked card was not open, open it
      if (!isAlreadyActive) {
        card.classList.add('active');
      }
    });
  });
}

// ============================================
// 7. SCROLL REVEAL ANIMATIONS
// ============================================
function initScrollReveal() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
}

// ============================================
// 8. RECRUITERS INFINITE SLIDER (MARQUEE)
// ============================================
function initRecruitersMarquee() {
  const grid = document.getElementById('recruitersGrid');
  if (!grid) return;

  // Duplicate cards once for seamless infinite right-to-left marquee on non-laptop screens
  const originalCards = Array.from(grid.querySelectorAll('.recruiter-card:not(.recruiter-clone)'));
  if (originalCards.length === 0) return;

  const fragment = document.createDocumentFragment();
  originalCards.forEach((card) => {
    const clone = card.cloneNode(true);
    clone.classList.add('recruiter-clone');
    clone.setAttribute('aria-hidden', 'true');
    fragment.appendChild(clone);
  });
  grid.appendChild(fragment);

  // Pause on touch and resume on release for mobile devices
  grid.addEventListener('touchstart', () => {
    grid.style.animationPlayState = 'paused';
  }, { passive: true });

  grid.addEventListener('touchend', () => {
    grid.style.animationPlayState = 'running';
  }, { passive: true });

  grid.addEventListener('touchcancel', () => {
    grid.style.animationPlayState = 'running';
  }, { passive: true });
}

// ============================================
// 9. ALUMNI CAROUSEL (NON-LAPTOP SCREENS)
// ============================================
function initAlumniCarousel() {
  const alumniCardsGrid = document.getElementById('alumniCardsGrid');
  const alumniPrev = document.getElementById('alumniPrev');
  const alumniNext = document.getElementById('alumniNext');

  function getAlumniVisibleCount() {
    if (window.innerWidth <= 576) return 1;
    if (window.innerWidth <= 1024) return 2;
    return 4;
  }

  createInfiniteCarousel({
    track: alumniCardsGrid,
    cardSelector: '.alumni-card',
    prevBtn: alumniPrev,
    nextBtn: alumniNext,
    transitionDuration: 420,
    transitionTiming: 'cubic-bezier(0.25, 1, 0.5, 1)',
    getVisibleCount: getAlumniVisibleCount
  });
}

// ============================================
// APPLICATION INITIALIZATION
// ============================================
document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initHeroCarousel();
  initLinkedInCarousel();
  initCareerCarousel();
  initReviewCarousel();
  initFAQAccordion();
  initScrollReveal();
  initRecruitersMarquee();
  initAlumniCarousel();
});
