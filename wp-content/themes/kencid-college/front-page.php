<?php
/**
 * Front page template.
 *
 * @package KCIDCollege
 */

get_header();
$schools = kcid_schools();
$school_images = array(
	'School of Building Sciences & Spatial Design'               => 'kencid-source/school-building-sciences.jpg',
	'School of Design, Creative & Performing Arts'               => 'kencid-source/school-design.jpg',
	'School of Engineering, Mobility & Manufacturing Technology' => 'kencid-source/school-engineering.jpg',
	'School of Trades, Technical & Applied Technology'           => 'courses-raster/welding-and-fabrication.webp',
	'School of Computing, Information & Digital Technology'      => 'kencid-source/school-information-technology.jpg',
	'School of Media, Communication & Digital Content'           => 'kencid-source/school-media.jpeg',
	'School of Business, Entrepreneurship & Management'          => 'kencid-source/school-business.webp',
	'School of Hospitality, Tourism & Culinary Arts'             => 'kencid-source/school-hospitality-management.jpg',
	'School of Health Sciences & Allied Health'                  => 'kencid-source/school-health-sciences.webp',
);
$school_card_content = array(
	'School of Building Sciences & Spatial Design'               => array( 'description' => 'Shape the places where people live, work and belong.', 'icon' => 'building' ),
	'School of Design, Creative & Performing Arts'               => array( 'description' => 'Create, perform and make work that matters.', 'icon' => 'palette' ),
	'School of Engineering, Mobility & Manufacturing Technology' => array( 'description' => 'Design, build and move practical solutions forward.', 'icon' => 'tools' ),
	'School of Trades, Technical & Applied Technology'           => array( 'description' => 'Build technical capability through applied learning.', 'icon' => 'tools' ),
	'School of Computing, Information & Digital Technology'      => array( 'description' => 'Develop the digital skills for emerging industries.', 'icon' => 'monitor' ),
	'School of Media, Communication & Digital Content'           => array( 'description' => 'Create stories and information for changing platforms.', 'icon' => 'media' ),
	'School of Business, Entrepreneurship & Management'          => array( 'description' => 'Turn knowledge, ideas and opportunity into value.', 'icon' => 'briefcase' ),
	'School of Hospitality, Tourism & Culinary Arts'             => array( 'description' => 'Create thoughtful guest, travel and culinary experiences.', 'icon' => 'sofa' ),
	'School of Health Sciences & Allied Health'                  => array( 'description' => 'Support health, wellbeing and community care.', 'icon' => 'heart' ),
	'School of Building Sciences'               => array( 'description' => 'Design and build a better tomorrow.', 'icon' => 'building' ),
	'School of Design'                          => array( 'description' => 'Create inspiring spaces for real life.', 'icon' => 'sofa' ),
	'School of Media and Communication'         => array( 'description' => 'Find your voice. Shape the story.', 'icon' => 'media' ),
	'School of Information Technology'         => array( 'description' => 'Gain the digital skills for what’s next.', 'icon' => 'monitor' ),
	'School of Engineering & Automotive Design' => array( 'description' => 'Turn ideas into real-world solutions.', 'icon' => 'tools' ),
	'School of Business Management'             => array( 'description' => 'Build leadership for a changing world.', 'icon' => 'briefcase' ),
	'School of Creative & Performing Arts'      => array( 'description' => 'Nurture your talent. Make an impact.', 'icon' => 'palette' ),
	'School of Health Sciences'                 => array( 'description' => 'Care. Innovate. Transform lives.', 'icon' => 'heart' ),
	'School of Hospitality Management'          => array( 'description' => 'Create memorable experiences for every guest.', 'icon' => 'sofa' ),
	'School of Trades & Technology'             => array( 'description' => 'Build practical skills for the world of work.', 'icon' => 'tools' ),
);
$next_intake = kcid_next_intake();
$countdown_remaining = max( 0, $next_intake['timestamp'] - time() );
$countdown_days = floor( $countdown_remaining / DAY_IN_SECONDS );
$countdown_hours = floor( ( $countdown_remaining % DAY_IN_SECONDS ) / HOUR_IN_SECONDS );
$countdown_minutes = floor( ( $countdown_remaining % HOUR_IN_SECONDS ) / MINUTE_IN_SECONDS );
$countdown_seconds = $countdown_remaining % MINUTE_IN_SECONDS;
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
	array( 'name' => 'Interior Designers Association of Kenya', 'logo' => 'partner-idak-cropped.png' ),
	array( 'name' => 'Design Week Africa', 'logo' => 'partner-design-week-africa.png' ),
);
$hero_slides = array(
	array(
		'eyebrow' => 'Kenya College of Interior Design',
		'title'   => 'Build Your Future. Create What Matters.',
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
		'image'   => 'hero-architecture-studio.png',
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
					<div class="hero__media" aria-hidden="true" data-hero-image="<?php echo esc_url( kcid_asset( 'img/' . $slide['image'] ) ); ?>"<?php if ( 0 === $index ) : ?> style="--hero-image: url('<?php echo esc_url( kcid_asset( 'img/' . $slide['image'] ) ); ?>');"<?php endif; ?>></div>
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
				<img src="<?php echo esc_url( kcid_asset( 'img/about-students.png' ) ); ?>" alt="KENCID students wearing the college colours together" loading="lazy" decoding="async" width="1254" height="1254" />
			</div>
			<div class="about-section__content">
				<h2 id="about-section-title"><span class="about-section__heading-lead">The Comprehensive College of</span> <span class="about-section__heading-tail">Design, Technology &amp; Applied Professions</span></h2>
				<p class="section-copy">KENCID brings together design, the built environment, engineering, technology, trades, computing, media, business, hospitality, health sciences and the creative and performing arts. Education goes beyond the classroom: knowledge becomes competence, competence becomes practice, and practice creates value.</p>
				<a class="about-section__cta" href="<?php echo kcid_page_url( 'programs' ); ?>">Explore Programme Areas <span class="about-section__cta-icon" aria-hidden="true"><?php echo kcid_icon( 'arrow-right' ); ?></span></a>
			</div>
		</div>
	</section>

	<section id="intake-section" class="intake-section" aria-labelledby="intake-section-title">
		<div class="design-wide intake-section__inner">
			<div class="intake-section__content">
				<h2 id="intake-section-title"><span data-intake-headline><?php echo esc_html( $next_intake['name'] . ' Intake' ); ?></span> <strong>Ongoing</strong></h2>
				<p class="intake-section__copy">Applications are open for the <?php echo esc_html( $next_intake['name'] ); ?> intake. Take the first step towards<br />a creative and successful future.</p>
				<p class="intake-date-pill">
					<span class="intake-date-pill__icon" aria-hidden="true"><?php echo kcid_icon( 'cap' ); ?></span>
					<span>Starts</span>
					<strong data-intake-label><?php echo esc_html( $next_intake['label'] ); ?></strong>
				</p>

				<div class="intake-countdown" data-countdown-target="<?php echo esc_attr( $next_intake['iso'] ); ?>" role="group" aria-label="Countdown to the <?php echo esc_attr( $next_intake['label'] ); ?> intake">
					<div class="intake-countdown__item">
						<strong data-countdown-unit="days"><?php echo esc_html( str_pad( (string) $countdown_days, 2, '0', STR_PAD_LEFT ) ); ?></strong>
						<span>Days</span>
					</div>
					<div class="intake-countdown__item">
						<strong data-countdown-unit="hours"><?php echo esc_html( str_pad( (string) $countdown_hours, 2, '0', STR_PAD_LEFT ) ); ?></strong>
						<span>Hrs</span>
					</div>
					<div class="intake-countdown__item">
						<strong data-countdown-unit="minutes"><?php echo esc_html( str_pad( (string) $countdown_minutes, 2, '0', STR_PAD_LEFT ) ); ?></strong>
						<span>Mins</span>
					</div>
					<div class="intake-countdown__item">
						<strong data-countdown-unit="seconds"><?php echo esc_html( str_pad( (string) $countdown_seconds, 2, '0', STR_PAD_LEFT ) ); ?></strong>
						<span>Secs</span>
					</div>
				</div>

				<div class="intake-actions">
					<a class="button button--intake" href="<?php echo kcid_page_url( 'apply-now' ); ?>">Apply Now <span class="intake-section__cta-icon" aria-hidden="true"><?php echo kcid_icon( 'arrow-right' ); ?></span></a>
				</div>
			</div>

			<div class="intake-section__visual">
				<span class="intake-section__rays" aria-hidden="true"><i></i><i></i><i></i></span>
				<span class="intake-section__blue-marks" aria-hidden="true"><i></i><i></i><i></i></span>
				<span class="intake-section__dots" aria-hidden="true"></span>
				<img src="<?php echo esc_url( kcid_asset( 'img/intake-woman-cutout-alpha.png' ) ); ?>" alt="Smiling KENCID student holding design notebooks" loading="lazy" />
				<div class="intake-starts">
					<span class="intake-starts__icon" aria-hidden="true"><?php echo kcid_icon( 'cap' ); ?></span>
					<span class="intake-starts__copy"><span>Intake Starts</span><strong data-intake-label><?php echo esc_html( $next_intake['label'] ); ?></strong></span>
				</div>
			</div>
		</div>
	</section>

	<section class="schools-section" aria-labelledby="schools-section-title">
		<div class="design-wide">
			<span class="schools-section__icon" aria-hidden="true"><?php echo kcid_icon( 'cap' ); ?></span>
			<h2 id="schools-section-title">Our <span>Schools</span></h2>
			<p class="schools-section__description">Nine multidisciplinary schools connect creativity, technology and practical learning so learners can build capability for professional practice, enterprise and lifelong development.</p>
			<form class="schools-search" role="search" aria-label="Search schools">
				<label class="screen-reader-text" for="school-search">Search schools</label>
				<svg class="schools-search__icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"></circle><path d="m16 16 5 5"></path></svg>
				<input id="school-search" type="search" placeholder="Search schools" autocomplete="off" />
				<button class="schools-search__submit" type="submit" aria-label="Search schools"><?php echo kcid_icon( 'arrow-right' ); ?></button>
			</form>
			<p class="schools-search__status" id="school-search-status" role="status" aria-live="polite"></p>
			<div class="schools-section__grid">
				<?php foreach ( $schools as $index => $school ) : ?>
					<a class="school-card" href="<?php echo esc_url( kcid_school_url( $school ) ); ?>" aria-label="Explore <?php echo esc_attr( $school ); ?>">
						<span class="school-card__image" aria-hidden="true">
							<img src="<?php echo esc_url( kcid_asset( 'img/' . ( $school_images[ $school ] ?? 'kencid-source/school-building-sciences.jpg' ) ) ); ?>" alt="" loading="lazy" decoding="async" width="218" height="265" />
							<span class="school-card__content">
								<span class="school-card__title"><?php echo esc_html( $school ); ?></span>
							</span>
							<span class="school-card__arrow"><?php echo kcid_icon( 'arrow-right' ); ?></span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="why-choose-us" aria-labelledby="why-choose-us-title">
		<div class="design-wide why-choose-us__grid">
			<div class="why-choose-us__content">
				<h2 id="why-choose-us-title"><span class="why-choose-us__heading-lead">Take the next step toward</span> <span class="why-choose-us__heading-tail">your personal and professional goals</span></h2>
				<p class="section-copy">KENCID combines practical training, projects, laboratories, studios, workshops, industry exposure, research, entrepreneurship, field experience and professional practice. Learn it. Prove it. Practice it.</p>
				<a class="why-choose-us__cta" href="<?php echo kcid_page_url( 'apply-now' ); ?>">Apply Now <span class="why-choose-us__cta-icon" aria-hidden="true"><?php echo kcid_icon( 'arrow-right' ); ?></span></a>
			</div>
			<div class="why-choose-us__media">
				<img src="<?php echo esc_url( kcid_asset( 'img/why-students.png' ) ); ?>" alt="KENCID students and staff celebrating together" loading="lazy" decoding="async" width="1254" height="1254" />
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
				<span class="blog-section__icon" aria-hidden="true"><?php echo kcid_icon( 'newspaper' ); ?></span>
				<div>
					<h2 id="blog-section-title">Blog &amp; Updates</h2>
				</div>
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
			<div class="blog-section__cta">
				<a class="button button--primary" href="https://kencid.ac.ke/blog-updates/">View all updates <?php echo kcid_icon( 'arrow' ); ?></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
