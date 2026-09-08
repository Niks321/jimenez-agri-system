/**
 * Municipal Agriculture Office Jimenez - Main Application Logic
 * Path: frontend/assets/js/app.js
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initCookieBanner();
  initPolicyModals();
  initGalleryFilter();
  initScrollSpy();
  initContactForm();
  initBlueprintCarousel();
});

/**
 * 1. Mobile Navigation Drawer Toggle
 */
function initMobileMenu() {
  const menuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = document.getElementById('menu-icon');

  if (!menuBtn || !mobileMenu) return;

  menuBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isClosed = mobileMenu.classList.contains('hidden');
    if (isClosed) {
      mobileMenu.classList.remove('hidden');
      if (menuIcon) menuIcon.textContent = 'close';
    } else {
      mobileMenu.classList.add('hidden');
      if (menuIcon) menuIcon.textContent = 'menu';
    }
  });

  // Close when clicking outside
  document.addEventListener('click', (e) => {
    if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
      mobileMenu.classList.add('hidden');
      if (menuIcon) menuIcon.textContent = 'menu';
    }
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
      mobileMenu.classList.add('hidden');
      if (menuIcon) menuIcon.textContent = 'menu';
    }
  });
}

function initPolicyModals() {
  const openers = document.querySelectorAll('[data-policy-open]');
  const modals = document.querySelectorAll('.policy-modal');
  if (!openers.length || !modals.length) return;

  let lastTrigger = null;
  openers.forEach((opener) => {
    opener.addEventListener('click', (event) => {
      const modal = document.getElementById(opener.dataset.policyOpen);
      if (!modal) return;
      event.preventDefault();
      lastTrigger = opener;
      if (typeof modal.showModal === 'function') {
        modal.showModal();
      } else {
        modal.classList.add('is-open');
        document.body.classList.add('policy-modal-open');
      }
    });
  });

  modals.forEach((modal) => {
    const close = () => {
      if (typeof modal.close === 'function' && modal.open) {
        modal.close();
      } else {
        modal.classList.remove('is-open');
        document.body.classList.remove('policy-modal-open');
      }
      if (lastTrigger) lastTrigger.focus();
    };

    modal.querySelectorAll('[data-policy-close]').forEach((button) => button.addEventListener('click', close));
    modal.addEventListener('click', (event) => {
      if (event.target === modal) close();
    });
    modal.addEventListener('cancel', (event) => {
      event.preventDefault();
      close();
    });
  });
}

function closeMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = document.getElementById('menu-icon');
  if (mobileMenu) {
    mobileMenu.classList.add('hidden');
    if (menuIcon) menuIcon.textContent = 'menu';
  }
}

/**
 * 2. Cookie Consent Banner with LocalStorage Persistence
 */
function initCookieBanner() {
  const banner = document.getElementById('cookie-banner');
  const choiceButtons = banner ? banner.querySelectorAll('[data-cookie-choice]') : [];

  if (!banner) return;

  const cookieConsent = document.cookie.split('; ').find((row) => row.startsWith('mao_cookie_consent='));
  if (cookieConsent && ['accepted', 'declined'].includes(cookieConsent.split('=')[1])) {
    banner.style.display = 'none';
  } else {
    banner.style.display = 'block';
  }

  choiceButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const choice = button.dataset.cookieChoice;
      document.cookie = `mao_cookie_consent=${choice}; Max-Age=31536000; Path=/; SameSite=Lax`;
      banner.style.display = 'none';
    });
  });
}

/**
 * 3. Gallery Category Filter
 */
function initGalleryFilter() {
  const filterButtons = document.querySelectorAll('[data-gallery-filter]');
  const galleryItems = document.querySelectorAll('[data-gallery-category]');

  if (!filterButtons.length || !galleryItems.length) return;

  filterButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const targetCategory = btn.getAttribute('data-gallery-filter');

      // Update button active styles
      filterButtons.forEach((b) => {
        b.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm', 'font-bold');
        b.classList.add('text-on-surface-variant');
      });
      btn.classList.add('bg-primary', 'text-on-primary', 'shadow-sm', 'font-bold');
      btn.classList.remove('text-on-surface-variant');

      // Filter gallery cards
      galleryItems.forEach((item) => {
        const itemCategory = item.getAttribute('data-gallery-category');
        if (targetCategory === 'all' || targetCategory === itemCategory) {
          item.style.display = 'flex';
          item.classList.add('animate-fadeIn');
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
}

/**
 * 4. Active Navigation Link Highlighting (Scroll Spy)
 */
function initScrollSpy() {
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('nav a[href^="#"]');

  if (!sections.length || !navLinks.length) return;

  window.addEventListener('scroll', () => {
    let current = '';
    const scrollPosition = window.pageYOffset + 120;

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
        current = section.getAttribute('id');
      }
    });

    navLinks.forEach((link) => {
      const href = link.getAttribute('href').substring(1);
      if (href === current) {
        link.classList.add('text-secondary-fixed', 'font-bold', 'border-b-2', 'border-secondary-fixed');
        link.classList.remove('text-white/90');
      } else {
        link.classList.remove('text-secondary-fixed', 'font-bold', 'border-b-2', 'border-secondary-fixed');
        link.classList.add('text-white/90');
      }
    });
  });
}

/**
 * 5. Contact Form Handler
 */
function initContactForm() {
  const form = document.getElementById('mao-contact-form');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const nameInput = form.querySelector('input[type="text"]');
    const senderName = nameInput ? nameInput.value : 'Constituent';

    alert(`Daghang Salamat, ${senderName}! Your message has been received by the Municipal Agriculture Office Jimenez extension desk.`);
    form.reset();
  });
}

/**
 * 6. Strategic Blueprint Carousel (Vision, Mission & Core Goal)
 */
function initBlueprintCarousel() {
  const container = document.getElementById('blueprint-carousel');
  if (!container) return;

  const slides = container.querySelectorAll('[data-blueprint-slide]');
  const tabs = container.querySelectorAll('[data-blueprint-tab]');
  const dots = container.querySelectorAll('[data-blueprint-dot]');
  const prevBtn = container.querySelector('[data-blueprint-prev]');
  const nextBtn = container.querySelector('[data-blueprint-next]');
  const counter = container.querySelector('[data-blueprint-counter]');

  if (!slides.length) return;

  let currentIndex = 0;
  let autoplayTimer = null;
  const totalSlides = slides.length;

  function showSlide(index) {
    if (index < 0) index = totalSlides - 1;
    if (index >= totalSlides) index = 0;
    currentIndex = index;

    // Transition slides
    slides.forEach((slide, i) => {
      if (i === currentIndex) {
        slide.classList.remove('hidden', 'opacity-0', 'scale-95');
        slide.classList.add('block', 'opacity-100', 'scale-100');
      } else {
        slide.classList.add('hidden', 'opacity-0', 'scale-95');
        slide.classList.remove('block', 'opacity-100', 'scale-100');
      }
    });

    // Update navigation tabs
    tabs.forEach((tab, i) => {
      if (i === currentIndex) {
        tab.classList.add('bg-secondary-fixed', 'text-on-secondary-fixed', 'shadow-sm', 'font-bold');
        tab.classList.remove('text-white/80', 'hover:bg-white/10');
      } else {
        tab.classList.remove('bg-secondary-fixed', 'text-on-secondary-fixed', 'shadow-sm', 'font-bold');
        tab.classList.add('text-white/80', 'hover:bg-white/10');
      }
    });

    // Update indicator dots
    dots.forEach((dot, i) => {
      if (i === currentIndex) {
        dot.classList.add('w-8', 'bg-secondary-fixed');
        dot.classList.remove('w-2.5', 'bg-white/40');
      } else {
        dot.classList.remove('w-8', 'bg-secondary-fixed');
        dot.classList.add('w-2.5', 'bg-white/40');
      }
    });

    // Update counter display
    if (counter) {
      counter.textContent = `0${currentIndex + 1} / 0${totalSlides}`;
    }
  }

  function nextSlide() {
    showSlide(currentIndex + 1);
  }

  function prevSlide() {
    showSlide(currentIndex - 1);
  }

  function startAutoplay() {
    stopAutoplay();
    autoplayTimer = setInterval(nextSlide, 7000);
  }

  function stopAutoplay() {
    if (autoplayTimer) {
      clearInterval(autoplayTimer);
      autoplayTimer = null;
    }
  }

  // Arrow controls
  if (nextBtn) {
    nextBtn.addEventListener('click', (e) => {
      e.preventDefault();
      nextSlide();
      startAutoplay();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', (e) => {
      e.preventDefault();
      prevSlide();
      startAutoplay();
    });
  }

  // Tab controls
  tabs.forEach((tab) => {
    tab.addEventListener('click', (e) => {
      e.preventDefault();
      const idx = parseInt(tab.getAttribute('data-blueprint-tab'), 10);
      showSlide(idx);
      startAutoplay();
    });
  });

  // Dot controls
  dots.forEach((dot) => {
    dot.addEventListener('click', (e) => {
      e.preventDefault();
      const idx = parseInt(dot.getAttribute('data-blueprint-dot'), 10);
      showSlide(idx);
      startAutoplay();
    });
  });

  // Pause autoplay on hover
  container.addEventListener('mouseenter', stopAutoplay);
  container.addEventListener('mouseleave', startAutoplay);

  // Touch swipe support for mobile/tablets
  let touchStartX = 0;
  container.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  container.addEventListener('touchend', (e) => {
    const touchEndX = e.changedTouches[0].screenX;
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 40) {
      if (diff > 0) {
        nextSlide();
      } else {
        prevSlide();
      }
      startAutoplay();
    }
  }, { passive: true });

  // Initialize display and start auto-advance
  showSlide(0);
  startAutoplay();
}
