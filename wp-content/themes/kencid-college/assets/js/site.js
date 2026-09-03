(function () {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('#primary-navigation');

  if (toggle && nav) {
    const menuLabel = toggle.querySelector('.screen-reader-text');
    const setMenuState = (isOpen) => {
      toggle.setAttribute('aria-expanded', String(isOpen));

      if (menuLabel) {
        menuLabel.textContent = isOpen ? 'Close menu' : 'Open menu';
      }
    };

    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';
      setMenuState(!isOpen);
      nav.classList.toggle('is-open', !isOpen);
    });

    nav.addEventListener('click', (event) => {
      const target = event.target;

      if (target instanceof Element) {
        const aboutToggle = target.closest('.primary-nav__toggle');

        if (aboutToggle) {
          const dropdown = aboutToggle.closest('.primary-nav__dropdown');
          const panel = dropdown?.querySelector('.nav-panel');
          const isOpen = aboutToggle.getAttribute('aria-expanded') === 'true';

          if (panel) {
            aboutToggle.setAttribute('aria-expanded', String(!isOpen));
            panel.hidden = isOpen;
          }

          return;
        }
      }

      if (target instanceof HTMLAnchorElement) {
        setMenuState(false);
        nav.classList.remove('is-open');
      }
    });

    const aboutDropdown = nav.querySelector('.primary-nav__dropdown');
    const aboutToggle = aboutDropdown?.querySelector('.primary-nav__toggle');
    const aboutPanel = aboutDropdown?.querySelector('.nav-panel');

    if (aboutDropdown && aboutToggle && aboutPanel) {
      const setAboutState = (isOpen) => {
        aboutToggle.setAttribute('aria-expanded', String(isOpen));
        aboutPanel.hidden = !isOpen;
      };

      aboutDropdown.addEventListener('focusout', (event) => {
        if (!aboutDropdown.contains(event.relatedTarget)) {
          setAboutState(false);
        }
      });

      document.addEventListener('click', (event) => {
        if (!aboutDropdown.contains(event.target)) {
          setAboutState(false);
        }
      });

      aboutToggle.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowDown') {
          event.preventDefault();
          setAboutState(true);
          aboutPanel.querySelector('a')?.focus();
        }

        if (event.key === 'Escape') {
          setAboutState(false);
        }
      });

      aboutPanel.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          event.preventDefault();
          setAboutState(false);
          aboutToggle.focus();
        }
      });
    }
  }

  const heroSlider = document.querySelector('[data-hero-slider]');

  if (heroSlider) {
    const slides = Array.from(heroSlider.querySelectorAll('[data-hero-slide]'));
    const controls = Array.from(heroSlider.querySelectorAll('[data-hero-control]'));
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const slideDuration = 6500;
    let activeIndex = 0;
    let autoplayId = 0;

    const showSlide = (nextIndex) => {
      activeIndex = (nextIndex + slides.length) % slides.length;

      slides.forEach((slide, index) => {
        const isActive = index === activeIndex;
        slide.classList.toggle('is-active', isActive);
        slide.setAttribute('aria-hidden', String(!isActive));
      });

      controls.forEach((control, index) => {
        const isActive = index === activeIndex;
        control.classList.toggle('is-active', isActive);

        if (isActive) {
          control.setAttribute('aria-current', 'true');
        } else {
          control.removeAttribute('aria-current');
        }
      });
    };

    const stopAutoplay = () => {
      window.clearInterval(autoplayId);
      autoplayId = 0;
    };

    const startAutoplay = () => {
      stopAutoplay();

      if (!reduceMotion.matches && slides.length > 1) {
        autoplayId = window.setInterval(() => showSlide(activeIndex + 1), slideDuration);
      }
    };

    controls.forEach((control, index) => {
      control.addEventListener('click', () => {
        showSlide(index);
      });
    });

    heroSlider.addEventListener('mouseenter', () => stopAutoplay());
    heroSlider.addEventListener('mouseleave', () => startAutoplay());
    heroSlider.addEventListener('focusin', () => stopAutoplay());
    heroSlider.addEventListener('focusout', (event) => {
      if (!heroSlider.contains(event.relatedTarget)) {
        startAutoplay();
      }
    });

    heroSlider.addEventListener('keydown', (event) => {
      if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') {
        return;
      }

      event.preventDefault();
      showSlide(activeIndex + (event.key === 'ArrowRight' ? 1 : -1));
    });

    reduceMotion.addEventListener?.('change', startAutoplay);
    showSlide(0);
    startAutoplay();
  }

  const schoolSearch = document.querySelector('#school-search');
  const schoolCards = Array.from(document.querySelectorAll('.school-card'));
  const searchStatus = document.querySelector('#school-search-status');

  if (schoolSearch && schoolCards.length) {
    schoolSearch.addEventListener('input', () => {
      const query = schoolSearch.value.trim().toLowerCase();
      let visibleCount = 0;

      schoolCards.forEach((card) => {
        const title = card.querySelector('.school-card__title')?.textContent.toLowerCase() || '';
        const matches = !query || title.includes(query);

        card.hidden = !matches;
        if (matches) {
          visibleCount += 1;
        }
      });

      if (searchStatus) {
        searchStatus.textContent = query
          ? `${visibleCount} school${visibleCount === 1 ? '' : 's'} found`
          : '';
      }
    });
  }

  const countdown = document.querySelector('[data-countdown-target]');

  if (countdown) {
    const targetTime = new Date(countdown.dataset.countdownTarget).getTime();
    const units = {
      days: countdown.querySelector('[data-countdown-unit="days"]'),
      hours: countdown.querySelector('[data-countdown-unit="hours"]'),
      minutes: countdown.querySelector('[data-countdown-unit="minutes"]'),
      seconds: countdown.querySelector('[data-countdown-unit="seconds"]'),
    };

    const updateCountdown = () => {
      const remaining = Math.max(0, targetTime - Date.now());
      const totalSeconds = Math.floor(remaining / 1000);
      const days = Math.floor(totalSeconds / 86400);
      const hours = Math.floor((totalSeconds % 86400) / 3600);
      const minutes = Math.floor((totalSeconds % 3600) / 60);
      const seconds = totalSeconds % 60;

      if (units.days) units.days.textContent = String(days).padStart(2, '0');
      if (units.hours) units.hours.textContent = String(hours).padStart(2, '0');
      if (units.minutes) units.minutes.textContent = String(minutes).padStart(2, '0');
      if (units.seconds) units.seconds.textContent = String(seconds).padStart(2, '0');
    };

    updateCountdown();
    window.setInterval(updateCountdown, 1000);
  }
})();
