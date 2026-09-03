<?php
/**
 * Front page template.
 *
 * @package KCIDCollege
 */

get_header();
$schools = array_slice( kcid_schools(), 0, 8 );
$academic_partners = array(
	array( 'name' => 'Kenya National Examinations Council', 'logo' => 'partner-knec.png' ),
	array( 'name' => 'TVET Curriculum Development, Assessment and Certification Council', 'logo' => 'partner-academic-mark.png' ),
	array( 'name' => 'ICM', 'logo' => 'partner-academic-mark-2.png' ),
	array( 'name' => 'BTEC', 'logo' => 'partner-btec.jpg' ),
);
$industry_partners = array(
	array( 'name' => 'KENCID Interiors', 'logo' => 'partner-kencid-interiors.png' ),
	array( 'name' => 'The African Institute of the Interior Design Professions', 'logo' => 'partner-iid.png' ),
	array( 'name' => 'Victoria Courts', 'logo' => 'partner-victoria-courts.png' ),
	array( 'name' => 'Interior Designers Association of Kenya', 'logo' => 'partner-idak.png' ),
	array( 'name' => 'Africa Interior Design Week', 'logo' => 'partner-dw.png' ),
);
$hero_slides = array(
	array(
		'eyebrow' => 'Welcome to',
		'title'   => 'Kenya College of Interior Design',
		'image'   => 'hero-interior-design.png',
		'cta'     => 'Apply Now',
		'url'     => kcid_page_url( 'apply-now' ),
	),
	array(
		'eyebrow' => 'Study',
		'title'   => 'Interior Design',
		'image'   => 'hero-interior-design-studio.png',
		'cta'     => 'Apply Now',
		'url'     => kcid_page_url( 'apply-now' ),
	),
	array(
		'eyebrow' => 'Study',
		'title'   => 'Architecture',
		'image'   => 'school-building-sciences.png',
		'cta'     => 'Apply Now',
		'url'     => kcid_page_url( 'apply-now' ),
	),
	array(
		'eyebrow' => 'Study',
		'title'   => 'Media',
		'image'   => 'hero-media-studio.png',
		'cta'     => 'Apply Now',
		'url'     => kcid_page_url( 'apply-now' ),
	),
	array(
		'eyebrow' => 'Study',
		'title'   => 'Business',
		'image'   => 'hero-business-studio.png',
		'cta'     => 'Apply Now',
		'url'     => kcid_page_url( 'apply-now' ),
	),
	array(
		'eyebrow' => 'Study',
		'title'   => 'Fashion Design',
		'image'   => 'hero-fashion-design.png',
		'cta'     => 'Apply Now',
		'url'     => kcid_page_url( 'apply-now' ),
	),
);
$blog_posts = array(
	array(
		'title' => 'What Next After KCSE? Building a Future in Kenya’s Construction & Design Industry',
		'date'  => '05 Jan 2026',
		'url'   => 'https://kencid.ac.ke/what-next-after-kcse-building-a-future-in-kenyas-construction-design-industry/',
		'image' => 'school-building-sciences.png',
		'alt'   => 'Architecture models and contemporary design campus',
	),
	array(
		'title' => 'Best Interior Design Colleges in Kenya',
		'date'  => '11 Dec 2025',
		'url'   => 'https://kencid.ac.ke/best-interior-design-colleges-in-kenya/',
		'image' => 'hero-design-studio.png',
		'alt'   => 'KENCID student working on an interior design drawing',
	),
	array(
		'title' => 'Kenya College of Interior Design (KENCID)',
		'date'  => '17 Nov 2025',
		'url'   => 'https://kencid.ac.ke/kenya-college-of-interior-design-kencid/',
		'image' => 'about-students.png',
		'alt'   => 'KENCID students together on campus',
	),
);
?>
<main id="main">
	<section class="hero" aria-label="KENCID study areas" data-hero-slider>
		<div class="hero__slides" aria-live="polite">
			<?php foreach ( $hero_slides as $index => $slide ) : ?>
				<article
					class="hero__slide hero__slide--<?php echo esc_attr( sanitize_title( $slide['title'] ) ); ?><?php echo 0 === $index ? ' is-active' : ''; ?>"
					data-hero-slide="<?php echo esc_attr( $index ); ?>"
					role="group"
					aria-hidden="<?php echo 0 === $index ? 'false' : 'true'; ?>"
					aria-roledescription="slide"
					aria-label="<?php echo esc_attr( (string) ( $index + 1 ) . ' of ' . count( $hero_slides ) . ': ' . $slide['title'] ); ?>"
				>
					<div class="hero__media" aria-hidden="true" style="--hero-image: url('<?php echo esc_url( kcid_asset( 'img/' . $slide['image'] ) ); ?>');"></div>
					<div class="container hero__content">
						<p class="hero__welcome"><?php echo esc_html( $slide['eyebrow'] ); ?></p>
						<h1<?php echo 0 === $index ? ' id="hero-title"' : ''; ?>><?php echo esc_html( $slide['title'] ); ?></h1>
						<div class="hero__actions">
							<a class="button button--primary" href="<?php echo esc_url( $slide['url'] ); ?>"><?php echo esc_html( $slide['cta'] ); ?> <?php echo kcid_icon( 'arrow' ); ?></a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="hero__controls">
			<div class="hero__dots" aria-label="Choose hero slide">
				<?php foreach ( $hero_slides as $index => $slide ) : ?>
					<button class="hero__dot<?php echo 0 === $index ? ' is-active' : ''; ?>" type="button" data-hero-control="<?php echo esc_attr( $index ); ?>" aria-label="Show <?php echo esc_attr( $slide['title'] ); ?> slide"<?php echo 0 === $index ? ' aria-current="true"' : ''; ?>></button>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="about-section" aria-labelledby="about-section-title">
		<div class="design-wide about-section__grid">
			<div class="about-section__media">
				<img src="<?php echo esc_url( kcid_asset( 'img/about-students.png' ) ); ?>" alt="KENCID students wearing the college colours together" />
			</div>
			<div class="about-section__content">
				<p class="script-label">Who we are</p>
				<h2 id="about-section-title">The Comprehensive College of Design</h2>
				<p class="section-copy">At KENCID, we believe that every great design begins with a single step, and that step starts with you. Whether you dream of crafting breathtaking interiors, designing awe-inspiring architecture, or shaping captivating landscapes, our college is the perfect place to begin your journey.</p>
				<a class="button button--primary" href="<?php echo kcid_page_url( 'programs' ); ?>">Our Programs <?php echo kcid_icon( 'arrow' ); ?></a>
			</div>
		</div>
	</section>

	<section id="intake-section" class="intake-section" aria-labelledby="intake-section-title">
		<div class="design-wide intake-section__inner">
			<div class="intake-section__content">
				<p class="intake-kicker">
					<span class="intake-kicker__icon" aria-hidden="true"><?php echo kcid_icon( 'calendar' ); ?></span>
					<span>New Intake</span>
				</p>
				<h2 id="intake-section-title"><span>Your Future</span><strong>Starts Now!</strong></h2>
				<div class="intake-section__accent" aria-hidden="true"></div>
				<p class="intake-section__copy">Join our upcoming intake and take the first step towards a creative and successful future.</p>

				<div class="intake-countdown" data-countdown-target="2026-09-30T00:00:00+03:00" role="group" aria-label="Countdown to the September 2026 intake">
					<div class="intake-countdown__item">
						<strong data-countdown-unit="days">18</strong>
						<span>Days</span>
					</div>
					<div class="intake-countdown__item">
						<strong data-countdown-unit="hours">07</strong>
						<span>Hrs</span>
					</div>
					<div class="intake-countdown__item">
						<strong data-countdown-unit="minutes">42</strong>
						<span>Mins</span>
					</div>
					<div class="intake-countdown__item">
						<strong data-countdown-unit="seconds">35</strong>
						<span>Secs</span>
					</div>
				</div>

				<div class="intake-actions">
					<a class="button button--intake" href="<?php echo kcid_page_url( 'apply-now' ); ?>">Apply Now <?php echo kcid_icon( 'arrow' ); ?></a>
					<a class="intake-call" href="tel:+254797888111">
						<span class="intake-call__icon" aria-hidden="true"><?php echo kcid_icon( 'phone' ); ?></span>
						<span class="intake-call__copy"><span>Questions? Call us</span><strong>+254 797 888 111</strong></span>
					</a>
				</div>
			</div>

			<div class="intake-section__visual">
				<img src="<?php echo esc_url( kcid_asset( 'img/cta-students-cutout-alpha.png' ) ); ?>" alt="Smiling KENCID students holding design books" loading="lazy" />
				<div class="intake-starts">
					<span class="intake-starts__icon" aria-hidden="true"><?php echo kcid_icon( 'cap' ); ?></span>
					<span class="intake-starts__copy"><span>Intake Starts</span><strong>September 2026</strong></span>
				</div>
			</div>
		</div>
	</section>

	<section class="schools-section" aria-labelledby="schools-section-title">
		<div class="design-wide">
			<h2 id="schools-section-title">Our Schools</h2>
			<p class="schools-section__description">At KENCID, we believe that every great design begins with a single step, and that step starts with you. Whether you dream of crafting breathtaking interiors, designing awe-inspiring architecture, or shaping captivating landscapes, our college is the perfect place to begin your journey.</p>
			<form class="schools-search" role="search" aria-label="Search schools">
				<label class="screen-reader-text" for="school-search">Search schools</label>
				<svg class="schools-search__icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m16 16 5 5"></path></svg>
				<input id="school-search" type="search" placeholder="Search schools" autocomplete="off" />
			</form>
			<p class="schools-search__status" id="school-search-status" role="status" aria-live="polite"></p>
			<div class="schools-section__grid">
				<?php foreach ( $schools as $index => $school ) : ?>
					<a class="school-card" href="<?php echo kcid_page_url( 'programs' ); ?>" aria-label="Explore <?php echo esc_attr( $school ); ?>">
						<span class="school-card__image" aria-hidden="true">
							<span class="school-card__index"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<span class="school-card__title"><?php echo esc_html( $school ); ?></span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="why-choose-us" aria-labelledby="why-choose-us-title">
		<div class="design-wide why-choose-us__grid">
			<div class="why-choose-us__content">
				<p class="script-label">Why Choose us</p>
				<h2 id="why-choose-us-title">Take the next step toward your personal and professional goals</h2>
				<p class="section-copy">We prioritize hands-on learning experiences to ensure students gain practical skills and industry knowledge. Our commitment to excellence fosters a supportive environment where students can thrive and pursue their passions with confidence.</p>
				<a class="button button--primary" href="<?php echo kcid_page_url( 'apply-now' ); ?>">Apply Now <?php echo kcid_icon( 'arrow' ); ?></a>
			</div>
			<div class="why-choose-us__media">
				<img src="<?php echo esc_url( kcid_asset( 'img/why-students.png' ) ); ?>" alt="KENCID students and staff celebrating together" />
			</div>
		</div>
	</section>

	<section class="partners-section partners-section--academic" aria-labelledby="academic-partners-title">
		<div class="design-wide">
			<h2 id="academic-partners-title">Academic Partners</h2>
			<ul class="partner-logo-grid" role="list">
				<?php foreach ( $academic_partners as $partner ) : ?>
					<li class="partner-logo">
						<img src="<?php echo esc_url( kcid_asset( 'img/' . $partner['logo'] ) ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" loading="lazy" />
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="partners-section partners-section--industry" aria-labelledby="industry-partners-title">
		<div class="design-wide">
			<h2 id="industry-partners-title">Industry Partners</h2>
			<ul class="partner-logo-grid partner-logo-grid--industry" role="list">
				<?php foreach ( $industry_partners as $partner ) : ?>
					<li class="partner-logo">
						<img src="<?php echo esc_url( kcid_asset( 'img/' . $partner['logo'] ) ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" loading="lazy" />
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="blog-section" aria-labelledby="blog-section-title">
		<div class="design-wide">
			<div class="blog-section__header">
				<div>
					<p class="script-label">From the journal</p>
					<h2 id="blog-section-title">Blog &amp; Updates</h2>
				</div>
				<a class="button button--primary" href="https://kencid.ac.ke/blog-updates/">View all updates <?php echo kcid_icon( 'arrow' ); ?></a>
			</div>
			<div class="blog-card-grid">
				<?php foreach ( $blog_posts as $post ) : ?>
					<article class="blog-card">
						<img class="blog-card__image" src="<?php echo esc_url( kcid_asset( 'img/' . $post['image'] ) ); ?>" alt="<?php echo esc_attr( $post['alt'] ); ?>" loading="lazy" />
						<div class="blog-card__body">
							<p class="blog-card__meta">Blog <span aria-hidden="true">•</span> <time datetime="<?php echo esc_attr( gmdate( 'Y-m-d', strtotime( $post['date'] ) ) ); ?>"><?php echo esc_html( $post['date'] ); ?></time></p>
							<h3><?php echo esc_html( $post['title'] ); ?></h3>
							<a class="blog-card__link" href="<?php echo esc_url( $post['url'] ); ?>">Read more <?php echo kcid_icon( 'arrow' ); ?></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
