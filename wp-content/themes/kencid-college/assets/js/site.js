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

    const closeMenu = ({ returnFocus = false } = {}) => {
      setMenuState(false);
      nav.classList.remove('is-open');

      nav.querySelectorAll('.primary-nav__toggle').forEach((dropdownToggle) => {
        dropdownToggle.setAttribute('aria-expanded', 'false');
        const panel = dropdownToggle.closest('.primary-nav__dropdown')?.querySelector('.nav-panel');
        if (panel) panel.hidden = true;
      });

      if (returnFocus) toggle.focus();
    };

    toggle.addEventListener('click', () => {
      const isOpen = toggle.getAttribute('aria-expanded') === 'true';

      if (isOpen) {
        closeMenu();
      } else {
        setMenuState(true);
        nav.classList.add('is-open');
      }
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
        closeMenu();
      }
    });

    document.addEventListener('click', (event) => {
      if (toggle.getAttribute('aria-expanded') !== 'true') return;

      const target = event.target;
      if (target instanceof Node && !nav.contains(target) && !toggle.contains(target)) {
        closeMenu();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
        event.preventDefault();
        closeMenu({ returnFocus: true });
      }
    });

    const dropdowns = Array.from(nav.querySelectorAll('.primary-nav__dropdown'));

    dropdowns.forEach((dropdown) => {
      const dropdownToggle = dropdown.querySelector('.primary-nav__toggle');
      const dropdownPanel = dropdown.querySelector('.nav-panel');

      if (!dropdownToggle || !dropdownPanel) {
        return;
      }

      let closeTimer;
      const cancelScheduledClose = () => {
        if (closeTimer) {
          window.clearTimeout(closeTimer);
          closeTimer = undefined;
        }
      };

      const setDropdownState = (isOpen) => {
        if (isOpen) {
          cancelScheduledClose();
        }

        dropdownToggle.setAttribute('aria-expanded', String(isOpen));
        dropdownPanel.hidden = !isOpen;
      };

      const supportsDesktopHover = window.matchMedia('(min-width: 1101px) and (hover: hover) and (pointer: fine)');

      dropdown.addEventListener('pointerenter', (event) => {
        if (supportsDesktopHover.matches && event.pointerType === 'mouse') {
          cancelScheduledClose();
          setDropdownState(true);
        }
      });

      dropdown.addEventListener('pointerleave', (event) => {
        if (supportsDesktopHover.matches && event.pointerType === 'mouse' && !dropdown.contains(document.activeElement)) {
          cancelScheduledClose();
          closeTimer = window.setTimeout(() => {
            if (!dropdown.matches(':hover') && !dropdown.contains(document.activeElement)) {
              setDropdownState(false);
            }
          }, 250);
        }
      });

      dropdown.addEventListener('focusout', (event) => {
        if (!dropdown.contains(event.relatedTarget)) {
          setDropdownState(false);
        }
      });

      document.addEventListener('click', (event) => {
        if (!dropdown.contains(event.target)) {
          setDropdownState(false);
        }
      });

      dropdownToggle.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowDown') {
          event.preventDefault();
          setDropdownState(true);
          dropdownPanel.querySelector('a')?.focus();
        }

        if (event.key === 'Escape') {
          setDropdownState(false);
        }
      });

      dropdownPanel.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          event.preventDefault();
          setDropdownState(false);
          dropdownToggle.focus();
        }
      });
    });
  }

  // Chaty opens its WhatsApp form automatically. On compact screens that fixed
  // panel hides the primary content, so keep the launcher available and wait
  // for an intentional tap before showing the conversation.
  const mobileChatQuery = window.matchMedia('(max-width: 900px)');
  const mobileChatClass = 'kcid-chaty-collapsed-mobile';
  const syncMobileChatState = () => {
    document.body.classList.toggle(mobileChatClass, mobileChatQuery.matches);
  };

  syncMobileChatState();
  mobileChatQuery.addEventListener?.('change', syncMobileChatState);

  document.addEventListener(
    'click',
    (event) => {
      if (!mobileChatQuery.matches) return;

      const target = event.target;
      if (target instanceof Element && target.closest('.chaty-i-trigger, .chaty-cta-button, .chaty-link')) {
        document.body.classList.remove(mobileChatClass);
      }
    },
    true
  );

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
        const media = slide.querySelector('.hero__media');

        if (isActive && media && !media.style.getPropertyValue('--hero-image')) {
          const image = media.dataset.heroImage;
          if (image) media.style.setProperty('--hero-image', `url("${image}")`);
        }

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

  const schoolSearchForm = document.querySelector('.schools-search');
  const schoolSearch = document.querySelector('#school-search');
  const schoolCards = Array.from(document.querySelectorAll('.school-card'));
  const searchStatus = document.querySelector('#school-search-status');

  if (schoolSearch && schoolCards.length) {
    schoolSearchForm?.addEventListener('submit', (event) => event.preventDefault());
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

  const courseSearch = document.querySelector('#course-search');
  const courseSchoolFilter = document.querySelector('#course-school-filter');
  const courseCards = Array.from(document.querySelectorAll('[data-course-card]'));
  const courseSearchStatus = document.querySelector('#course-search-status');
  const courseSearchEmpty = document.querySelector('#course-search-empty');
  const courseSearchTags = Array.from(document.querySelectorAll('[data-course-search]'));

  if (courseSearch && courseCards.length) {
    const applyHref = document.querySelector('a[href*="apply-now"]')?.href || '?pagename=apply-now';

    courseCards.forEach((card) => {
      card.querySelector('.course-card__number')?.remove();
      card.querySelector('.course-card__body .eyebrow')?.remove();
      card.querySelector('.course-card__body > p:not(.eyebrow)')?.remove();

      const body = card.querySelector('.course-card__body');
      const detailsLink = card.querySelector('.text-link');
      const title = card.querySelector('h3')?.textContent.trim() || 'this course';
      const meta = card.querySelector('.course-card__meta');

      if (meta) {
        meta.innerHTML = '<span class="course-card__badge course-card__badge--diploma"><svg class="course-card__meta-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m2 9 10-5 10 5-10 5L2 9Z"/><path d="M6 11v5c3 3 9 3 12 0v-5"/></svg>Diploma</span><span class="course-card__badge course-card__badge--certificate"><svg class="course-card__meta-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg>Certificate</span><span class="course-card__badge course-card__badge--foundation"><svg class="course-card__meta-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m21 8-9-5-9 5 9 5 9-5Z"/><path d="M3 8v8l9 5 9-5V8M12 13v8"/></svg>Foundation</span><span class="course-card__duration"><svg class="course-card__meta-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg><strong>6 / 3 / 2</strong> semesters</span>';
      }

      if (body && detailsLink && !body.querySelector('.course-card__actions')) {
        const actions = document.createElement('div');
        actions.className = 'course-card__actions';
        detailsLink.className = 'course-card__details';
        detailsLink.innerHTML = 'Details <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 19 19 5M8 5h11v11"/></svg>';

        const applyLink = document.createElement('a');
        applyLink.className = 'course-card__apply';
        applyLink.href = applyHref;
        applyLink.setAttribute('aria-label', `Apply for ${title}`);
        applyLink.innerHTML = 'Apply now <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m2 9 10-5 10 5-10 5L2 9Z"/><path d="M6 11v5c3 3 9 3 12 0v-5"/></svg>';

        actions.append(detailsLink, applyLink);
        body.append(actions);
      }
    });

    const filterCourses = () => {
      const query = courseSearch.value.trim().toLowerCase();
      const school = courseSchoolFilter?.value || '';
      let visibleCount = 0;

      courseCards.forEach((card) => {
        const matchesQuery = !query || card.dataset.search.includes(query);
        const matchesSchool = !school || card.dataset.school === school;
        const isVisible = matchesQuery && matchesSchool;

        card.hidden = !isVisible;
        if (isVisible) visibleCount += 1;
      });

      if (courseSearchStatus) {
        courseSearchStatus.textContent = `${visibleCount} course${visibleCount === 1 ? '' : 's'} found`;
      }

      if (courseSearchEmpty) {
        courseSearchEmpty.hidden = visibleCount !== 0;
      }
    };

    courseSearch.addEventListener('input', filterCourses);
    courseSchoolFilter?.addEventListener('change', filterCourses);
    courseSearchTags.forEach((tag) => {
      tag.addEventListener('click', () => {
        courseSearch.value = tag.dataset.courseSearch || '';
        if (courseSchoolFilter) {
          courseSchoolFilter.value = '';
        }
        filterCourses();
        courseSearch.focus();
      });
    });
    filterCourses();
  }

  const eventSearch = document.querySelector('#event-search');
  const eventCategory = document.querySelector('#event-category');
  const eventCards = Array.from(document.querySelectorAll('[data-event-card]'));
  const eventPriceFilters = Array.from(document.querySelectorAll('[data-event-price-filter]'));
  const eventFilterStatus = document.querySelector('#events-filter-status');
  const eventCount = document.querySelector('#events-count');
  const eventEmpty = document.querySelector('#events-empty');
  let eventPriceFilter = 'all';

  if (eventCards.length && eventSearch) {
    const filterEvents = () => {
      const query = eventSearch.value.trim().toLowerCase();
      const category = eventCategory?.value || '';
      let visibleCount = 0;

      eventCards.forEach((card) => {
        const matchesQuery = !query || (card.dataset.eventSearch || '').includes(query);
        const matchesCategory = !category || card.dataset.eventCategory === category;
        const matchesPrice = eventPriceFilter === 'all' || card.dataset.eventPriceType === eventPriceFilter;
        const isVisible = matchesQuery && matchesCategory && matchesPrice;

        card.hidden = !isVisible;
        if (isVisible) visibleCount += 1;
      });

      if (eventFilterStatus) {
        eventFilterStatus.textContent = query || category || eventPriceFilter !== 'all'
          ? `${visibleCount} event${visibleCount === 1 ? '' : 's'} found`
          : 'Showing all upcoming events';
      }

      if (eventCount) {
        eventCount.textContent = `${visibleCount} event${visibleCount === 1 ? '' : 's'}`;
      }

      if (eventEmpty) {
        eventEmpty.hidden = visibleCount !== 0;
      }
    };

    eventSearch.addEventListener('input', filterEvents);
    eventCategory?.addEventListener('change', filterEvents);
    eventPriceFilters.forEach((filter) => {
      filter.addEventListener('click', () => {
        eventPriceFilter = filter.dataset.eventPriceFilter || 'all';
        eventPriceFilters.forEach((button) => {
          const isActive = button === filter;
          button.classList.toggle('is-active', isActive);
          button.setAttribute('aria-pressed', String(isActive));
        });
        filterEvents();
      });
    });

    filterEvents();
  }

  const eventModal = document.querySelector('#event-ticket-modal');
  const eventOpenButtons = Array.from(document.querySelectorAll('[data-event-open]'));

  if (eventModal && eventOpenButtons.length) {
    const modalDialog = eventModal.querySelector('.event-modal__dialog');
    const modalTitle = eventModal.querySelector('#event-modal-title');
    const modalDate = eventModal.querySelector('#event-modal-date');
    const modalTime = eventModal.querySelector('#event-modal-time');
    const modalLocation = eventModal.querySelector('#event-modal-location');
    const modalPriceLabel = eventModal.querySelector('#event-modal-price-label');
    const ticketOptionsList = eventModal.querySelector('#event-ticket-options-list');
    const quantitySelect = eventModal.querySelector('#event-ticket-quantity');
    const orderTicketCount = eventModal.querySelector('#event-order-ticket-count');
    const orderTotal = eventModal.querySelector('#event-order-total');
    const paymentNote = eventModal.querySelector('#event-payment-note');
    const submitButton = eventModal.querySelector('#event-ticket-submit');
    const ticketForm = eventModal.querySelector('#event-ticket-form');
    const formStatus = eventModal.querySelector('#event-ticket-form-status');
    const confirmation = eventModal.querySelector('#event-confirmation');
    const confirmationTitle = eventModal.querySelector('#event-confirmation-title');
    const confirmationCopy = eventModal.querySelector('#event-confirmation-copy');
    const closeButtons = Array.from(eventModal.querySelectorAll('[data-event-close]'));
    let activeEvent = null;
    let returnFocus = null;

    const formatPrice = (price) => price === 0 ? 'Free' : `KSh ${price.toLocaleString('en-KE')}`;

    const getTickets = (button) => {
      try {
        return JSON.parse(button.dataset.eventTickets || '[]');
      } catch (error) {
        return [{ label: 'General admission', price: Number(button.dataset.eventPrice || 0) }];
      }
    };

    const updateTotal = () => {
      const selectedTicket = ticketOptionsList?.querySelector('input:checked');
      const price = Number(selectedTicket?.dataset.price || 0);
      const quantity = Number(quantitySelect?.value || 1);

      if (orderTicketCount) orderTicketCount.textContent = `${quantity} × ticket${quantity === 1 ? '' : 's'}`;
      if (orderTotal) orderTotal.textContent = formatPrice(price * quantity);
    };

    const renderTicketOptions = (button) => {
      if (!ticketOptionsList) return;
      ticketOptionsList.innerHTML = '';

      getTickets(button).forEach((ticket, index) => {
        const label = document.createElement('label');
        label.className = 'event-ticket-option';

        const input = document.createElement('input');
        input.type = 'radio';
        input.name = 'ticket_type';
        input.value = ticket.label;
        input.dataset.price = String(ticket.price);
        input.checked = index === 0;

        const copy = document.createElement('span');
        copy.className = 'event-ticket-option__copy';
        copy.innerHTML = `<strong>${ticket.label}</strong><small>${ticket.price === 0 ? 'No payment required' : 'Includes event admission'}</small>`;

        const price = document.createElement('strong');
        price.className = 'event-ticket-option__price';
        price.textContent = formatPrice(ticket.price);

        label.append(input, copy, price);
        ticketOptionsList.appendChild(label);
      });

      ticketOptionsList.querySelectorAll('input').forEach((input) => input.addEventListener('change', updateTotal));
      updateTotal();
    };

    const openEventModal = (button) => {
      activeEvent = button;
      returnFocus = document.activeElement;
      const price = Number(button.dataset.eventPrice || 0);
      modalTitle.textContent = button.dataset.eventTitle || 'Reserve your place';
      modalDate.textContent = button.dataset.eventDate || '';
      modalTime.textContent = button.dataset.eventTime || '';
      modalLocation.textContent = button.dataset.eventLocation || '';
      modalPriceLabel.textContent = price === 0 ? 'This is a free event. Tell us where to send your confirmation.' : 'Choose your ticket type and tell us where to send your confirmation.';
      paymentNote.textContent = price === 0 ? 'No payment is required for this reservation.' : 'After you submit, we’ll send a secure payment link to complete your booking.';
      submitButton.innerHTML = `${price === 0 ? 'Reserve ticket' : 'Continue to payment'} <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 19 19 5M8 5h11v11"/></svg>`;
      ticketForm.hidden = false;
      confirmation.hidden = true;
      formStatus.textContent = '';
      renderTicketOptions(button);
      eventModal.hidden = false;
      document.body.classList.add('event-modal-open');
      modalDialog?.focus();
    };

    const closeEventModal = () => {
      eventModal.hidden = true;
      document.body.classList.remove('event-modal-open');
      ticketForm?.reset();
      confirmation.hidden = true;
      activeEvent = null;
      returnFocus?.focus();
    };

    eventOpenButtons.forEach((button) => button.addEventListener('click', () => openEventModal(button)));
    closeButtons.forEach((button) => button.addEventListener('click', closeEventModal));
    quantitySelect?.addEventListener('change', updateTotal);

    ticketForm?.addEventListener('submit', (event) => {
      event.preventDefault();

      if (!ticketForm.reportValidity() || !activeEvent) return;

      const email = ticketForm.querySelector('#event-attendee-email')?.value || 'your inbox';
      const price = Number(activeEvent.dataset.eventPrice || 0);
      confirmationTitle.textContent = price === 0 ? 'Your place is reserved.' : 'Your booking is almost ready.';
      confirmationCopy.textContent = price === 0
        ? `We’ll send your event confirmation to ${email}. We can’t wait to see you at ${activeEvent.dataset.eventTitle}.`
        : `We’ll send a secure payment link and booking details to ${email} for ${activeEvent.dataset.eventTitle}.`;
      ticketForm.hidden = true;
      confirmation.hidden = false;
      confirmation.querySelector('button')?.focus();
    });

    eventModal.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        event.preventDefault();
        closeEventModal();
      }

      if (event.key === 'Tab') {
        const focusable = Array.from(eventModal.querySelectorAll('button:not([disabled]), input:not([disabled]), select:not([disabled])'));
        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        if (event.shiftKey && document.activeElement === first) {
          event.preventDefault();
          last?.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
          event.preventDefault();
          first?.focus();
        }
      }
    });
  }

  const countdown = document.querySelector('[data-countdown-target]');

  if (countdown) {
    const intakeSchedule = [
      { month: 1, name: 'January', day: 31 },
      { month: 5, name: 'May', day: 31 },
      { month: 9, name: 'September', day: 30 },
    ];
    const intakeLabels = countdown.closest('.intake-section')?.querySelectorAll('[data-intake-label]') || [];
    const intakeHeadline = countdown.closest('.intake-section')?.querySelector('[data-intake-headline]');
    const units = {
      days: countdown.querySelector('[data-countdown-unit="days"]'),
      hours: countdown.querySelector('[data-countdown-unit="hours"]'),
      minutes: countdown.querySelector('[data-countdown-unit="minutes"]'),
      seconds: countdown.querySelector('[data-countdown-unit="seconds"]'),
    };
    let activeIntake = null;

    const getNairobiDateParts = () => {
      const parts = new Intl.DateTimeFormat('en-US', {
        timeZone: 'Africa/Nairobi',
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
      }).formatToParts(new Date());

      return parts.reduce((values, part) => {
        if (part.type === 'year' || part.type === 'month' || part.type === 'day') {
          values[part.type] = Number(part.value);
        }
        return values;
      }, {});
    };

    const getNextIntake = () => {
      const now = getNairobiDateParts();
      const year = now.year || new Date().getFullYear();

      for (const intake of intakeSchedule) {
        const target = new Date(
          `${year}-${String(intake.month).padStart(2, '0')}-${String(intake.day).padStart(2, '0')}T00:00:00+03:00`,
        );

        if (target.getTime() > Date.now()) {
          return { ...intake, year, time: target.getTime(), label: `${intake.name} ${year}` };
        }
      }

      const firstIntake = intakeSchedule[0];
      const target = new Date(
        `${year + 1}-${String(firstIntake.month).padStart(2, '0')}-${String(firstIntake.day).padStart(2, '0')}T00:00:00+03:00`,
      );

      return { ...firstIntake, year: year + 1, time: target.getTime(), label: `${firstIntake.name} ${year + 1}` };
    };

    const updateCountdown = () => {
      const nextIntake = getNextIntake();

      if (!activeIntake || activeIntake.time !== nextIntake.time) {
        activeIntake = nextIntake;
        countdown.dataset.countdownTarget = new Date(nextIntake.time).toISOString();
        countdown.setAttribute('aria-label', `Countdown to the ${nextIntake.label} intake`);
        intakeLabels.forEach((intakeLabel) => {
          intakeLabel.textContent = nextIntake.label;
        });
        if (intakeHeadline) intakeHeadline.textContent = `${nextIntake.name} Intake`;
      }

      const remaining = Math.max(0, activeIntake.time - Date.now());
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

  const projectCards = Array.from(document.querySelectorAll('[data-project-card]'));
  const projectModal = document.querySelector('#project-modal');

  if (projectCards.length && projectModal) {
    const modalDialog = projectModal.querySelector('.project-modal__dialog');
    const modalImage = projectModal.querySelector('#project-modal-image');
    const modalDiscipline = projectModal.querySelector('#project-modal-discipline');
    const modalTitle = projectModal.querySelector('#project-modal-title');
    const modalDesigner = projectModal.querySelector('#project-modal-designer');
    const modalYear = projectModal.querySelector('#project-modal-year');
    const modalSummary = projectModal.querySelector('#project-modal-summary');
    const modalThumbs = projectModal.querySelector('#project-modal-thumbs');
    const closeButtons = Array.from(projectModal.querySelectorAll('[data-project-modal-close]'));
    const previousButton = projectModal.querySelector('[data-project-prev]');
    const nextButton = projectModal.querySelector('[data-project-next]');
    let activeProject = null;
    let activeImage = 0;
    let returnFocus = null;

    const getGallery = (card) => {
      try {
        return JSON.parse(card.dataset.projectGallery || '[]');
      } catch (error) {
        return [];
      }
    };

    const renderImage = (index) => {
      if (!activeProject || !modalImage) return;
      const gallery = getGallery(activeProject);
      activeImage = (index + gallery.length) % gallery.length;
      const image = gallery[activeImage];
      modalImage.src = image.src;
      modalImage.alt = image.alt;

      Array.from(modalThumbs?.querySelectorAll('button') || []).forEach((thumb, thumbIndex) => {
        const isActive = thumbIndex === activeImage;
        thumb.classList.toggle('is-active', isActive);
        thumb.setAttribute('aria-current', String(isActive));
      });
    };

    const renderProject = (card) => {
      activeProject = card;
      const gallery = getGallery(card);
      if (!gallery.length) return;
      modalDiscipline.textContent = card.dataset.projectDiscipline || 'Project';
      modalTitle.textContent = card.dataset.projectTitle || '';
      modalDesigner.textContent = card.dataset.projectDesigner || '';
      modalYear.textContent = card.dataset.projectYear || '';
      modalSummary.textContent = card.dataset.projectSummary || '';
      modalThumbs.innerHTML = '';

      gallery.forEach((image, index) => {
        const thumb = document.createElement('button');
        thumb.type = 'button';
        thumb.className = 'project-modal__thumb';
        thumb.setAttribute('aria-label', `Show image ${index + 1} of ${gallery.length}`);
        thumb.setAttribute('aria-current', 'false');
        thumb.innerHTML = `<img src="${image.src}" alt="" />`;
        thumb.addEventListener('click', () => renderImage(index));
        modalThumbs.appendChild(thumb);
      });

      renderImage(0);
    };

    const closeModal = () => {
      projectModal.hidden = true;
      document.body.classList.remove('project-modal-open');
      activeProject = null;
      returnFocus?.focus();
    };

    const openModal = (card) => {
      returnFocus = document.activeElement;
      renderProject(card);
      projectModal.hidden = false;
      document.body.classList.add('project-modal-open');
      modalDialog?.focus();
    };

    projectCards.forEach((card) => card.addEventListener('click', () => openModal(card)));
    closeButtons.forEach((button) => button.addEventListener('click', closeModal));
    previousButton?.addEventListener('click', () => renderImage(activeImage - 1));
    nextButton?.addEventListener('click', () => renderImage(activeImage + 1));

    projectModal.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        event.preventDefault();
        closeModal();
      }

      if (event.key === 'ArrowLeft') renderImage(activeImage - 1);
      if (event.key === 'ArrowRight') renderImage(activeImage + 1);

      if (event.key === 'Tab') {
        const focusable = Array.from(projectModal.querySelectorAll('button:not([disabled])'));
        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        if (event.shiftKey && document.activeElement === first) {
          event.preventDefault();
          last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
          event.preventDefault();
          first.focus();
        }
      }
    });
  }

  const applicationForm = document.querySelector('#kencid-application-form');

  if (applicationForm) {
    const email = applicationForm.querySelector('#application-email');
    const emailConfirm = applicationForm.querySelector('#application-email-confirm');
    const certificateInput = applicationForm.querySelector('#application-certificates');
    const uploadArea = applicationForm.querySelector('.application-upload');
    const uploadFiles = applicationForm.querySelector('#application-upload-files');
    const status = applicationForm.querySelector('#application-status');

    const updateUploadState = () => {
      if (!certificateInput || !uploadFiles) return true;

      if (certificateInput.files.length > 4) {
        certificateInput.value = '';
        uploadFiles.textContent = 'Please choose no more than 4 files.';
        uploadFiles.style.color = 'var(--kcid-pink)';
        return false;
      }

      uploadFiles.style.color = '';
      uploadFiles.textContent = certificateInput.files.length
        ? `${certificateInput.files.length} file${certificateInput.files.length === 1 ? '' : 's'} selected`
        : '';
      return true;
    };

    certificateInput?.addEventListener('change', updateUploadState);

    uploadArea?.addEventListener('dragover', (event) => {
      event.preventDefault();
      uploadArea.classList.add('is-dragging');
    });

    uploadArea?.addEventListener('dragleave', () => uploadArea.classList.remove('is-dragging'));

    uploadArea?.addEventListener('drop', (event) => {
      event.preventDefault();
      uploadArea.classList.remove('is-dragging');

      if (certificateInput && event.dataTransfer?.files) {
        certificateInput.files = event.dataTransfer.files;
        updateUploadState();
      }
    });

    emailConfirm?.addEventListener('input', () => emailConfirm.setCustomValidity(''));

    applicationForm.addEventListener('submit', (event) => {
      event.preventDefault();

      if (email && emailConfirm && email.value !== emailConfirm.value) {
        emailConfirm.setCustomValidity('Email addresses must match.');
      } else {
        emailConfirm?.setCustomValidity('');
      }

      if (!updateUploadState() || !applicationForm.reportValidity()) {
        return;
      }

      if (status) {
        status.textContent = 'Thank you — your application details are ready for review.';
      }
    });
  }
})();
