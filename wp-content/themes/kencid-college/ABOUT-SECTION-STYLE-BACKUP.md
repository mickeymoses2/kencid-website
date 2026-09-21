# About section style backup

Saved 2026-09-17. This records the About section immediately before the kicker was removed and the CTA was changed to a yellow pill.

## Previous `front-page.php` block

```php
<div class="about-section__content">
	<p class="intake-kicker about-section__kicker">
		<span class="intake-kicker__icon" aria-hidden="true"><?php echo kcid_icon( 'community' ); ?></span>
		<span class="about-section__kicker-label">Who We Are</span>
	</p>
	<h2 id="about-section-title"><span class="about-section__heading-lead">The Comprehensive College of</span> <span class="about-section__heading-tail">Design</span></h2>
	<p class="section-copy">At KENCID, we believe that every great design begins with a single step, and that step starts with you. Whether you dream of crafting breathtaking interiors, designing awe-inspiring architecture, or shaping captivating landscapes, our college is the perfect place to begin your journey.</p>
	<a class="about-section__cta" href="<?php echo kcid_page_url( 'programs' ); ?>">Explore Programs <?php echo kcid_icon( 'arrow' ); ?></a>
</div>
```

## Previous `theme.css` rules

```css
.intake-kicker.about-section__kicker {
  text-transform: none;
}

.about-section__kicker-label {
  display: inline-flex;
  align-self: stretch;
  align-items: center;
  color: var(--kcid-black);
  font-family: "DM Sans", Poppins, Inter, ui-sans-serif, system-ui, sans-serif;
  font-size: clamp(0.75rem, 0.95vw, 0.95rem);
  font-style: italic;
  font-weight: 600;
  letter-spacing: 0.01em;
  line-height: 1;
}

.about-section .about-section__cta {
  display: inline-flex;
  align-items: center;
  gap: 0.45rem;
  margin-top: 1.75rem;
  color: var(--kcid-blue);
  font-size: 1rem;
  font-weight: 600;
  line-height: 1.4;
  text-decoration: underline;
  text-decoration-thickness: 2px;
  text-underline-offset: 0.3em;
  transition: color 160ms ease;
}

.about-section .about-section__cta:hover {
  color: var(--kcid-blue);
}
```

The matching theme version at that point was `0.5.65`.
