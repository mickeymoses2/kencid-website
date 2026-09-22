<?php
/**
 * Static page template.
 *
 * @package KCIDCollege
 */

get_header();
$slug = get_post_field( 'post_name', get_queried_object_id() );
$contact = kcid_contacts();
$next_intake = kcid_next_intake();
?>
<main id="main"<?php echo 'events' === $slug ? ' class="events-page"' : ( 'apply-now' === $slug ? ' class="apply-page"' : '' ); ?>>
<?php
	switch ( $slug ) :
	case 'programs':
		$course_slug = kcid_requested_course_slug();
		$course      = kcid_current_course();
		$school_slug = kcid_requested_school_slug();
		$school = '' !== $school_slug ? kcid_school_by_slug( $school_slug ) : null;
		if ( $course ) :
			$course_hero_style = ' style="--course-hero-image: url(' . esc_url( kcid_asset( 'img/' . $course['image'] ) ) . ');"';
			$all_related_courses = array_values(
				array_filter(
					kcid_catalog_programs(),
					function ( array $item ) use ( $course ): bool {
						return $item['school'] === $course['school'] && $item['slug'] !== $course['slug'];
					}
				)
			);
			?>
			<section class="course-detail-hero" aria-labelledby="course-detail-title"<?php echo $course_hero_style; ?>>
				<div class="container">
					<nav class="course-detail-breadcrumbs" aria-label="Breadcrumb">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span aria-hidden="true">/</span>
						<a href="<?php echo esc_url( kcid_page_url( 'programs' ) ); ?>">Courses</a><span aria-hidden="true">/</span>
						<span><?php echo esc_html( $course['title'] ); ?></span>
					</nav>
					<div class="course-detail-hero__grid">
						<div class="course-detail-hero__copy">
							<p class="eyebrow hero-kicker">KENCID course guide <span class="course-detail-hero__school"><?php echo esc_html( $course['school'] ); ?></span></p>
							<h1 id="course-detail-title"><?php echo esc_html( $course['title'] ); ?></h1>
							<p class="course-detail-hero__lede"><?php echo esc_html( $course['summary'] ); ?></p>
							<a class="button button--primary course-detail-hero__action" href="<?php echo esc_url( kcid_page_url( 'apply-now' ) ); ?>">Apply for this course <?php echo kcid_icon( 'arrow' ); ?></a>
							<div class="course-detail-meta" aria-label="Course overview">
								<div><span>Qualification</span><strong><?php echo esc_html( $course['qualification'] ); ?></strong></div>
								<div><span>Duration</span><strong><?php echo esc_html( $course['duration'] ); ?></strong></div>
								<div><span>Study mode</span><strong><?php echo esc_html( $course['mode'] ); ?></strong></div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section-pad course-detail-content">
				<div class="container course-detail-layout">
					<article class="course-detail-article">
						<header class="course-detail-article__intro">
							<p class="eyebrow eyebrow--blue">Course overview</p>
							<h2>Build a future in <?php echo esc_html( strtolower( $course['title'] ) ); ?>.</h2>
							<p><?php echo esc_html( $course['overview'] ); ?></p>
						</header>
						<section class="course-detail-section-heading" aria-labelledby="course-why-title">
							<p class="eyebrow eyebrow--blue">Curriculum</p>
							<h3 id="course-why-title">Why study <?php echo esc_html( $course['title'] ); ?> at KENCID?</h3>
							<p><?php echo esc_html( $course['why'] ); ?></p>
						</section>
						<section class="course-detail-section-heading" aria-labelledby="course-learning-title">
							<p class="eyebrow eyebrow--blue">What you will learn</p>
							<h3 id="course-learning-title">A practical path from interest to capability.</h3>
							<p>Build your understanding through a focused blend of foundations, practical projects, feedback, and professional practice.</p>
						<ul class="course-learning-list">
							<?php foreach ( $course['learning'] as $learning_item ) : ?>
								<li><strong><?php echo esc_html( $learning_item['title'] ); ?></strong><span><?php echo esc_html( $learning_item['text'] ); ?></span></li>
							<?php endforeach; ?>
						</ul>
						</section>
						<section class="course-detail-career" aria-labelledby="course-career-title">
							<p class="eyebrow eyebrow--blue">Career direction</p>
							<h3 id="course-career-title">Where this can take you</h3>
							<p>Explore possible roles and build the confidence to take your next step in the field.</p>
							<ul class="course-career-list">
								<?php foreach ( $course['careers'] as $career ) : ?><li><?php echo esc_html( $career ); ?></li><?php endforeach; ?>
							</ul>
						</section>
					</article>
					<aside class="course-apply-card course-entry-requirements" aria-labelledby="course-entry-requirements-title">
						<p class="eyebrow eyebrow--blue">Choose your pathway</p>
						<h2 id="course-entry-requirements-title">Entry Requirements</h2>
						<p>Every KENCID course is available through the Diploma, Certificate, and Foundation pathways shown below.</p>
						<div class="course-entry-requirements__list">
							<?php foreach ( $course['pathways'] as $pathway ) : ?>
								<section class="course-entry-requirement">
									<h3><?php echo esc_html( $pathway['label'] ); ?></h3>
									<p><?php echo esc_html( $pathway['entry'] ); ?></p>
									<span>Duration: <?php echo esc_html( $pathway['duration'] ); ?></span>
								</section>
							<?php endforeach; ?>
						</div>
						<a class="button button--dark" href="<?php echo esc_url( kcid_page_url( 'apply-now' ) ); ?>">Start your application <?php echo kcid_icon( 'arrow' ); ?></a>
						<a class="text-link" href="<?php echo esc_url( kcid_page_url( 'contact' ) ); ?>">Ask admissions a question <?php echo kcid_icon( 'arrow' ); ?></a>
					</aside>
				</div>
			</section>
			<section class="course-detail-related" aria-labelledby="related-courses-title"><div class="container"><div class="blog-section__header"><div><p class="script-label">Keep exploring</p><h2 id="related-courses-title">More from <?php echo esc_html( kcid_school_label( $course['school'] ) ); ?>.</h2></div><a class="button button--primary" href="<?php echo esc_url( kcid_page_url( 'programs' ) ); ?>">View all courses <?php echo kcid_icon( 'arrow' ); ?></a></div><div class="blog-card-grid"><?php foreach ( array_slice( $all_related_courses, 0, 3 ) as $related ) : ?><article class="blog-card"><div class="course-related-card__image"><img src="<?php echo esc_url( kcid_asset( 'img/' . $related['image'] ) ); ?>" alt="Students exploring <?php echo esc_attr( $related['title'] ); ?> at KENCID" loading="lazy" /></div><div class="blog-card__body"><p class="blog-card__meta"><?php echo esc_html( $related['school'] ); ?></p><h3><?php echo esc_html( $related['title'] ); ?></h3><a class="blog-card__link" href="<?php echo esc_url( kcid_course_url( $related['slug'] ) ); ?>">View course <?php echo kcid_icon( 'arrow' ); ?></a></div></article><?php endforeach; ?></div></div></section>
			<?php
		else :
			$all_programs = kcid_catalog_programs();
			$programs = $school ? array_values( array_filter( $all_programs, function ( $program ) use ( $school ) { return $program['school'] === $school['name']; } ) ) : $all_programs;
			$school_label = $school ? kcid_school_label( $school['name'] ) : '';
			$popular_searches = $school ? array_slice( $school['courses'], 0, 5 ) : array( 'Business Management', 'Accounting', 'Marketing', 'Entrepreneurship', 'Human Resource Management' );
			$course_explorer = static function () use ( $school, $school_label, $popular_searches, $programs ): void {
				?>
				<div class="course-hero-explorer<?php echo $school ? ' course-hero-explorer--school' : ''; ?>">
					<div class="course-finder__controls">
						<div class="course-finder__searchbar">
							<label class="course-search">
								<span class="screen-reader-text">Search courses</span>
								<span class="course-search__icon"><?php echo kcid_icon( 'search' ); ?></span>
								<input id="course-search" type="search" placeholder="<?php echo esc_attr( $school ? 'Search courses...' : 'Search courses, skills, or schools...' ); ?>" autocomplete="off" />
							</label>
							<?php if ( ! $school ) : ?>
								<label class="course-filter">
									<span class="screen-reader-text">Filter by school</span>
									<span class="course-filter__icon"><?php echo kcid_icon( 'school' ); ?></span>
									<select id="course-school-filter">
										<option value="">All schools</option>
										<?php foreach ( kcid_schools() as $catalog_school ) : ?>
											<option value="<?php echo esc_attr( strtolower( $catalog_school ) ); ?>"><?php echo esc_html( $catalog_school ); ?></option>
										<?php endforeach; ?>
									</select>
									<span class="course-filter__chevron"><?php echo kcid_icon( 'chevron-down' ); ?></span>
								</label>
							<?php endif; ?>
						</div>
						<?php if ( $school ) : ?>
							<a class="button button--dark" href="<?php echo esc_url( kcid_page_url( 'programs' ) ); ?>">View all courses <?php echo kcid_icon( 'arrow-right' ); ?></a>
						<?php else : ?>
						<div class="course-finder__popular" aria-label="Popular course searches">
							<span class="course-finder__popular-label">Popular:</span>
							<?php foreach ( $popular_searches as $popular_search ) : ?>
								<button type="button" class="course-finder__tag" data-course-search="<?php echo esc_attr( $popular_search ); ?>"><?php echo esc_html( $popular_search ); ?></button>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
					<p class="course-finder__status" id="course-search-status" aria-live="polite"><?php echo esc_html( count( $programs ) . ' ' . ( 1 === count( $programs ) ? 'course' : 'courses' ) . ( $school ? ' available' : '' ) ); ?></p>
				</div>
				<?php
			};
			kcid_render_page_header(
				$school ? 'School of ' . $school_label : 'Programs & courses',
				$school ? 'School of ' . $school_label : 'Course explorer',
				$school ? $school['intro'] : 'Explore the current KENCID course catalog across ten schools. Search by course or filter by school to find your next step.',
				$school ? $school['image'] : 'course-listing-hero.png',
				'',
				$school ? 'school-programs' : 'programs',
				$course_explorer
			);
			?>
			<section class="section-pad course-finder course-finder--results<?php echo $school ? ' course-finder--school' : ''; ?>" <?php echo $school ? 'aria-label="' . esc_attr( $school_label . ' courses' ) . '"' : 'aria-label="Course results"'; ?>><div class="container"><div class="course-card-grid" id="course-card-grid"><?php foreach ( $programs as $index => $program ) : ?><article class="course-card" data-course-card data-search="<?php echo esc_attr( strtolower( $program['title'] . ' ' . $program['school'] . ' ' . $program['summary'] ) ); ?>" data-school="<?php echo esc_attr( strtolower( $program['school'] ) ); ?>"><div class="course-card__number"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></div><div class="course-card__media"><img src="<?php echo esc_url( kcid_asset( 'img/' . $program['image'] ) ); ?>" alt="Students exploring <?php echo esc_attr( $program['title'] ); ?> at KENCID" loading="lazy" /></div><div class="course-card__body"><p class="eyebrow eyebrow--blue"><?php echo esc_html( $program['school'] ); ?></p><h3><?php echo esc_html( $program['title'] ); ?></h3><p><?php echo esc_html( $program['summary'] ); ?></p><div class="course-card__meta"><span><?php echo esc_html( $program['qualification'] ); ?></span><span><?php echo esc_html( $program['duration'] ); ?></span></div><a class="text-link" href="<?php echo esc_url( kcid_course_url( $program['slug'] ) ); ?>">View course details <?php echo kcid_icon( 'arrow' ); ?></a></div></article><?php endforeach; ?></div><p class="course-finder__empty" id="course-search-empty" hidden>No courses match that search yet. Try another keyword or view all courses.</p></div></section>
			<?php
		endif;
		break;

	case 'projects':
		$projects = kcid_projects();
			kcid_render_page_header( 'KENCID projects', 'KENCID Projects', 'Explore selected student projects across interiors, architecture, fashion, media, and the built environment. Open a project to browse the full story.', 'student-work-strip.png', '', 'projects' );
		?>
		<section class="section-pad projects-section" aria-labelledby="projects-title">
			<div class="container">
				<div class="projects-section__intro">
					<div>
						<h2 id="projects-title">Made to be experienced.</h2>
					</div>
					<p>Every project starts with a question, then grows through research, making, critique, and a point of view worth sharing.</p>
				</div>
				<div class="projects-grid">
					<?php foreach ( $projects as $index => $project ) : ?>
						<button
							class="project-card"
							type="button"
							data-project-card="<?php echo esc_attr( $index ); ?>"
							data-project-title="<?php echo esc_attr( $project['title'] ); ?>"
							data-project-discipline="<?php echo esc_attr( $project['discipline'] ); ?>"
							data-project-designer="<?php echo esc_attr( $project['designer'] ); ?>"
							data-project-year="<?php echo esc_attr( $project['year'] ); ?>"
							data-project-summary="<?php echo esc_attr( $project['summary'] ); ?>"
							data-project-gallery="<?php echo esc_attr( wp_json_encode( array_map( function ( $image ) use ( $project ) { return array( 'src' => kcid_asset( 'img/' . $image ), 'alt' => $project['title'] . ' project by ' . $project['designer'] ); }, $project['images'] ) ) ); ?>"
						>
							<span class="project-card__media"><img src="<?php echo esc_url( kcid_asset( 'img/' . $project['cover'] ) ); ?>" alt="<?php echo esc_attr( $project['title'] . ' project by ' . $project['designer'] ); ?>" loading="lazy" /><span class="project-card__view">View gallery <span aria-hidden="true">&#8599;</span></span></span>
							<span class="project-card__body"><span class="project-card__discipline"><?php echo esc_html( $project['discipline'] ); ?></span><span class="project-card__title"><?php echo esc_html( $project['title'] ); ?></span><span class="project-card__meta"><span>Designer</span> <?php echo esc_html( $project['designer'] ); ?><span class="project-card__year"><?php echo esc_html( $project['year'] ); ?></span></span></span>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<div class="project-modal" id="project-modal" hidden>
			<div class="project-modal__backdrop" data-project-modal-close></div>
			<div class="project-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="project-modal-title" aria-describedby="project-modal-summary" tabindex="-1">
				<div class="project-modal__header">
					<p class="eyebrow eyebrow--blue" id="project-modal-discipline">Project</p>
					<button class="project-modal__close" type="button" data-project-modal-close aria-label="Close project gallery"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="project-modal__content">
					<div class="project-modal__visual">
						<img id="project-modal-image" src="" alt="" />
						<button class="project-modal__nav project-modal__nav--prev" type="button" data-project-prev aria-label="Previous project image">&#8592;</button>
						<button class="project-modal__nav project-modal__nav--next" type="button" data-project-next aria-label="Next project image">&#8594;</button>
					</div>
					<div class="project-modal__details">
						<div class="project-modal__title-row"><h2 id="project-modal-title"></h2><span id="project-modal-year"></span></div>
						<p class="project-modal__designer">Designed by <strong id="project-modal-designer"></strong></p>
						<p id="project-modal-summary"></p>
						<div class="project-modal__thumbs" id="project-modal-thumbs" role="group" aria-label="Project images"></div>
					</div>
				</div>
			</div>
		</div>
		<?php
		break;

	case 'admissions':
		kcid_render_page_header( 'Admissions', 'Start your creative journey.', 'Applications are open for diploma, certificate, and foundation study. Get course guidance, fee information, and help choosing the right pathway.', 'hero-interior-design-v2.png', '', 'admissions' );
		?>
		<section class="section-pad admissions-overview"><div class="container"><div class="intake-banner"><div><p class="eyebrow">Now accepting applications</p><h2>Make your next move in <?php echo esc_html( $next_intake['label'] ); ?>.</h2><p>Talk to admissions about full-time and evening options, course fit, and the documents you need to get started.</p></div><a class="button button--dark" href="tel:+254797888111">Call admissions <?php echo kcid_icon( 'phone' ); ?></a></div><div class="pathway-grid" aria-label="Study pathways"><article class="pathway-card pathway-card--yellow"><span class="pathway-card__number">01</span><h2>Diploma</h2><p>For learners ready to build a strong professional foundation.</p><strong>KCSE C-</strong><span>6 semesters</span></article><article class="pathway-card pathway-card--blue"><span class="pathway-card__number">02</span><h2>Certificate</h2><p>A focused route into practical creative and technical study.</p><strong>KCSE D- and above</strong><span>3 semesters</span></article><article class="pathway-card pathway-card--pink"><span class="pathway-card__number">03</span><h2>Foundation</h2><p>Start your design journey and build confidence through making.</p><strong>KCSE: any grade</strong><span>2 semesters</span></article></div></div></section>
		<section class="section-pad section-light"><div class="container admissions-grid admissions-grid--refreshed"><div class="admissions-copy"><h2>Bring your questions. Leave with a plan.</h2><p>Our admissions team can help you understand course options, entry requirements, fees, flexible study programs, financial aid, and scholarships for outstanding students.</p><div class="admissions-checks"><span><?php echo kcid_icon( 'cap' ); ?>Course guidance</span><span><?php echo kcid_icon( 'calendar' ); ?>Flexible study options</span><span><?php echo kcid_icon( 'shield' ); ?>Accredited programs</span></div></div><form class="admissions-form" aria-label="Application interest form"><h2>Application interest</h2><p>Share a few details and continue the conversation on WhatsApp.</p><label for="applicant-name">Full name<input id="applicant-name" type="text" name="name" autocomplete="name" required></label><label for="applicant-phone">Phone number<input id="applicant-phone" type="tel" name="phone" autocomplete="tel" required></label><label for="applicant-program">Program of interest<select id="applicant-program" name="program"><?php foreach ( kcid_catalog_programs() as $program ) : ?><option><?php echo esc_html( $program['title'] ); ?></option><?php endforeach; ?></select></label><a class="button button--dark" href="<?php echo esc_url( kcid_whatsapp_url( 'Hi KENCID, I would like to learn more about applying.' ) ); ?>" target="_blank" rel="noopener noreferrer">Continue on WhatsApp <?php echo kcid_icon( 'arrow' ); ?></a></form></div></section>
		<?php
		break;

	case 'apply-now':
		$application_courses = kcid_catalog_programs();
		$application_intakes = kcid_upcoming_intakes( 3 );
		?>
		<section class="apply-hero" aria-labelledby="apply-hero-title">
			<img class="apply-hero__image" src="<?php echo esc_url( kcid_asset( 'img/hero-application.png' ) ); ?>" alt="KENCID student working on an interior design drawing" />
			<div class="apply-hero__veil" aria-hidden="true"></div>
			<div class="container apply-hero__content">
				<p class="eyebrow hero-kicker">KENCID School of Design</p>
				<h1 id="apply-hero-title">APPLY NOW</h1>
			</div>
		</section>

		<section class="apply-section" aria-labelledby="application-title">
			<div class="apply-card">
				<div class="apply-card__intro">
					<img class="apply-card__logo" src="<?php echo esc_url( kcid_asset( 'img/kencid-logo-mustard.png' ) ); ?>" alt="KENCID School of Design" />
					<h2 id="application-title">Ready to turn your passion<br class="apply-card__desktop-break" /> into a profession?</h2>
					<p>Join KENCID today and start your journey toward a creative, innovative, and impactful career. With accredited programs, expert instructors, and hands-on learning, you’ll gain the skills needed to thrive in today’s design industry. Don’t wait — apply now and take the first step toward your dream future!</p>
				</div>

				<form class="application-form" id="kencid-application-form" aria-label="KENCID application form">
					<fieldset class="application-section">
						<legend><span class="application-section__icon application-section__icon--blue" aria-hidden="true"><?php echo kcid_icon( 'user' ); ?></span>Personal Details</legend>
						<div class="application-grid application-grid--one">
							<label class="application-field" for="application-name">Name (Start with SURNAME) <span aria-hidden="true">*</span><input id="application-name" name="name" type="text" autocomplete="name" placeholder="e.g. Wanjiku" required /></label>
						</div>
						<div class="application-grid application-grid--split">
							<fieldset class="application-field application-fieldset">
								<legend>Date of Birth <span aria-hidden="true">*</span></legend>
								<div class="date-selects">
									<label for="application-dob-month"><span class="screen-reader-text">Birth month</span><select id="application-dob-month" name="dob_month" required><option value="">MM</option><?php for ( $month = 1; $month <= 12; $month++ ) : ?><option value="<?php echo esc_attr( str_pad( (string) $month, 2, '0', STR_PAD_LEFT ) ); ?>"><?php echo esc_html( str_pad( (string) $month, 2, '0', STR_PAD_LEFT ) ); ?></option><?php endfor; ?></select></label>
									<label for="application-dob-day"><span class="screen-reader-text">Birth day</span><select id="application-dob-day" name="dob_day" required><option value="">DD</option><?php for ( $day = 1; $day <= 31; $day++ ) : ?><option value="<?php echo esc_attr( str_pad( (string) $day, 2, '0', STR_PAD_LEFT ) ); ?>"><?php echo esc_html( str_pad( (string) $day, 2, '0', STR_PAD_LEFT ) ); ?></option><?php endfor; ?></select></label>
									<label for="application-dob-year"><span class="screen-reader-text">Birth year</span><select id="application-dob-year" name="dob_year" required><option value="">YYYY</option><?php for ( $year = (int) gmdate( 'Y' ); $year >= 1950; $year-- ) : ?><option value="<?php echo esc_attr( (string) $year ); ?>"><?php echo esc_html( (string) $year ); ?></option><?php endfor; ?></select></label>
								</div>
							</fieldset>
							<fieldset class="application-field application-fieldset application-gender">
								<legend>Gender <span aria-hidden="true">*</span></legend>
								<div class="gender-options">
									<label class="gender-option gender-option--male" for="application-gender-male"><input id="application-gender-male" type="radio" name="gender" value="Male" required /><span aria-hidden="true">♂</span>Male</label>
									<label class="gender-option gender-option--female" for="application-gender-female"><input id="application-gender-female" type="radio" name="gender" value="Female" /><span aria-hidden="true">♀</span>Female</label>
								</div>
							</fieldset>
						</div>
						<div class="application-grid application-grid--three">
							<label class="application-field" for="application-phone">Phone Number <span aria-hidden="true">*</span><input id="application-phone" name="phone" type="tel" autocomplete="tel" placeholder="0712 345678" required /></label>
							<label class="application-field" for="application-email">Email Address <span aria-hidden="true">*</span><input id="application-email" name="email" type="email" autocomplete="email" placeholder="Email" required /></label>
							<label class="application-field" for="application-email-confirm">Confirm Email <span aria-hidden="true">*</span><input id="application-email-confirm" name="email_confirm" type="email" autocomplete="email" placeholder="Confirm Email" required /></label>
						</div>
					</fieldset>

					<fieldset class="application-section">
						<legend><span class="application-section__icon application-section__icon--pink" aria-hidden="true"><?php echo kcid_icon( 'community' ); ?></span>Parent / Guardian Details</legend>
						<div class="application-grid application-grid--one">
							<label class="application-field" for="guardian-name">Parent / Guardian Details Name <span aria-hidden="true">*</span><input id="guardian-name" name="guardian_name" type="text" autocomplete="name" placeholder="e.g. John Wanjiku" required /></label>
						</div>
						<div class="application-grid application-grid--split">
							<label class="application-field" for="guardian-phone">Parent / Guardian Phone Number <span aria-hidden="true">*</span><input id="guardian-phone" name="guardian_phone" type="tel" autocomplete="tel" placeholder="0712 123456" required /></label>
							<label class="application-field" for="guardian-email">Email <span aria-hidden="true">*</span><input id="guardian-email" name="guardian_email" type="email" autocomplete="email" placeholder="e.g. parent@email.com" required /></label>
						</div>
					</fieldset>

					<fieldset class="application-section application-section--details">
						<legend><span class="application-section__icon application-section__icon--yellow" aria-hidden="true"><?php echo kcid_icon( 'box' ); ?></span>Application Details</legend>
						<div class="entry-note"><span class="entry-note__icon" aria-hidden="true">i</span><p>The minimum entry requirement for Diploma Courses is KCSE mean grade of C- or its Accredited and Recognized equivalent. The minimum entry requirement for Certificate Courses is KCSE mean grade of D or its Accredited and Recognized equivalent. The minimum entry requirement for Foundation Courses is KCSE mean grade of D- or its Accredited and Recognized equivalent.</p></div>
						<div class="application-grid application-grid--one">
							<label class="application-field" for="application-course">Courses (Diploma / Certificate / Executive / Foundation / Short Courses ) <span aria-hidden="true">*</span><select id="application-course" name="course" required><?php foreach ( $application_courses as $course ) : ?><option value="<?php echo esc_attr( $course['title'] ); ?>"><?php echo esc_html( $course['title'] ); ?></option><?php endforeach; ?></select></label>
						</div>
						<div class="application-grid application-grid--split">
							<label class="application-field" for="application-intake">Intake <span aria-hidden="true">*</span><select id="application-intake" name="intake" required><?php foreach ( $application_intakes as $intake ) : ?><option value="<?php echo esc_attr( $intake['label'] ); ?>"><?php echo esc_html( $intake['label'] ); ?></option><?php endforeach; ?></select></label>
							<label class="application-field" for="application-grade">KCSE Mean Grade or its Accredited and Recognized equivalent <span aria-hidden="true">*</span><input id="application-grade" name="grade" type="text" placeholder="e.g. C-" required /></label>
						</div>
						<div class="application-grid application-grid--one">
							<div class="application-field application-upload-field"><span>Upload Certificates <span aria-hidden="true">*</span></span><label class="application-upload" for="application-certificates"><input id="application-certificates" name="certificates[]" type="file" accept=".pdf,.jpg,.jpeg,.png" multiple required /><span class="application-upload__icon" aria-hidden="true">↑</span><span><strong>Click or drag files to this area to upload.</strong><small>You can upload up to 4 files.</small><span class="application-upload__files" id="application-upload-files" aria-live="polite"></span></span></label></div>
						</div>
					</fieldset>

					<button class="application-submit" type="submit">Submit Application</button>
					<p class="application-status" id="application-status" role="status" aria-live="polite"></p>
				</form>
			</div>
		</section>
		<?php
		break;

	case 'events':
		$events = kcid_events();
		$featured_event = $events[0];
		$event_categories = array_values( array_unique( array_map( function ( $event ) { return $event['category']; }, $events ) ) );
		kcid_render_page_header( 'KENCID events', 'KENCID Events', 'Workshops, showcases, talks, and campus moments for curious minds. Find your next reason to show up, connect, and make something happen.', 'hero-media-studio-v2.png', '', 'events' );
		?>
		<section class="section-pad events-featured" aria-labelledby="featured-event-title">
			<div class="container">
				<div class="events-featured__card">
					<div class="events-featured__media">
						<img src="<?php echo esc_url( kcid_asset( 'img/' . $featured_event['image'] ) ); ?>" alt="Students working together in a KENCID design studio" />
						<span class="events-featured__badge">Featured event</span>
					</div>
					<div class="events-featured__body">
						<p class="eyebrow">Next up · <?php echo esc_html( $featured_event['category'] ); ?></p>
						<h2 id="featured-event-title"><?php echo esc_html( $featured_event['title'] ); ?></h2>
						<p><?php echo esc_html( $featured_event['summary'] ); ?></p>
						<ul class="events-featured__details" aria-label="Featured event details">
							<li><?php echo kcid_icon( 'calendar' ); ?><span><?php echo esc_html( $featured_event['date'] ); ?></span></li>
							<li><?php echo kcid_icon( 'clock' ); ?><span><?php echo esc_html( $featured_event['time'] ); ?></span></li>
							<li><?php echo kcid_icon( 'pin' ); ?><span><?php echo esc_html( $featured_event['location'] ); ?></span></li>
						</ul>
						<div class="events-featured__footer">
							<div><strong>Free entry</strong><span><?php echo esc_html( $featured_event['capacity'] ); ?></span></div>
							<button class="button button--primary" type="button" data-event-open data-event-title="<?php echo esc_attr( $featured_event['title'] ); ?>" data-event-date="<?php echo esc_attr( $featured_event['date'] ); ?>" data-event-time="<?php echo esc_attr( $featured_event['time'] ); ?>" data-event-location="<?php echo esc_attr( $featured_event['location'] ); ?>" data-event-price="<?php echo esc_attr( (string) $featured_event['price'] ); ?>" data-event-price-label="<?php echo esc_attr( $featured_event['price_label'] ); ?>" data-event-tickets="<?php echo esc_attr( wp_json_encode( $featured_event['tickets'] ) ); ?>">Reserve free ticket <?php echo kcid_icon( 'arrow' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="section-pad section-light events-listing" id="events-list" aria-labelledby="events-listing-title">
			<div class="container">
				<div class="events-listing__header">
					<div>
						<p class="eyebrow eyebrow--blue">The full line-up</p>
						<h2 id="events-listing-title">Find an event worth showing up for.</h2>
					</div>
					<p class="events-listing__count" id="events-count"><?php echo esc_html( count( $events ) . ' events' ); ?></p>
				</div>

				<form class="events-filters" id="events-filters" role="search" aria-label="Find events">
					<label class="events-search" for="event-search">
						<span class="screen-reader-text">Search events</span>
						<span class="events-search__icon"><?php echo kcid_icon( 'search' ); ?></span>
						<input id="event-search" type="search" placeholder="Search workshops, showcases, talks..." autocomplete="off" />
					</label>
					<label class="events-filter-select" for="event-category">
						<span class="screen-reader-text">Filter by event type</span>
						<span class="events-filter-select__icon"><?php echo kcid_icon( 'tag' ); ?></span>
						<select id="event-category">
							<option value="">All event types</option>
							<?php foreach ( $event_categories as $category ) : ?><option value="<?php echo esc_attr( sanitize_title( $category ) ); ?>"><?php echo esc_html( $category ); ?></option><?php endforeach; ?>
						</select>
						<span class="events-filter-select__chevron"><?php echo kcid_icon( 'chevron-down' ); ?></span>
					</label>
					<div class="events-price-filter" role="group" aria-label="Filter by ticket price">
						<span class="events-price-filter__label">Tickets</span>
						<button type="button" class="events-price-filter__button is-active" data-event-price-filter="all" aria-pressed="true">All</button>
						<button type="button" class="events-price-filter__button" data-event-price-filter="free" aria-pressed="false">Free</button>
						<button type="button" class="events-price-filter__button" data-event-price-filter="paid" aria-pressed="false">Paid</button>
					</div>
				</form>
				<p class="events-filter-status" id="events-filter-status" aria-live="polite">Showing all upcoming events</p>

				<div class="events-grid" id="events-grid">
					<?php foreach ( $events as $event ) : ?>
						<article class="event-card" data-event-card data-event-search="<?php echo esc_attr( strtolower( $event['title'] . ' ' . $event['category'] . ' ' . $event['summary'] . ' ' . $event['location'] ) ); ?>" data-event-category="<?php echo esc_attr( sanitize_title( $event['category'] ) ); ?>" data-event-price-type="<?php echo 0 === $event['price'] ? 'free' : 'paid'; ?>">
							<div class="event-card__media">
								<img src="<?php echo esc_url( kcid_asset( 'img/' . $event['image'] ) ); ?>" alt="<?php echo esc_attr( $event['title'] ); ?> at KENCID" loading="lazy" />
								<div class="event-card__date" aria-label="<?php echo esc_attr( $event['date_short'] ); ?>"><strong><?php echo esc_html( $event['day'] ); ?></strong><span><?php echo esc_html( $event['month'] ); ?></span></div>
								<span class="event-card__price event-card__price--<?php echo 0 === $event['price'] ? 'free' : 'paid'; ?>"><?php echo 0 === $event['price'] ? 'Free' : 'Paid'; ?></span>
							</div>
							<div class="event-card__body">
								<div class="event-card__eyebrow"><span><?php echo esc_html( $event['category'] ); ?></span><span><?php echo esc_html( $event['format'] ); ?></span></div>
								<h3><?php echo esc_html( $event['title'] ); ?></h3>
								<p><?php echo esc_html( $event['summary'] ); ?></p>
								<ul class="event-card__details" aria-label="Event details">
									<li><?php echo kcid_icon( 'clock' ); ?><span><?php echo esc_html( $event['time'] ); ?></span></li>
									<li><?php echo kcid_icon( 'pin' ); ?><span><?php echo esc_html( $event['location'] ); ?></span></li>
								</ul>
								<div class="event-card__footer">
									<div class="event-card__price-copy"><strong><?php echo esc_html( $event['price_label'] ); ?></strong><span><?php echo esc_html( $event['capacity'] ); ?></span></div>
									<button class="event-card__action" type="button" data-event-open data-event-title="<?php echo esc_attr( $event['title'] ); ?>" data-event-date="<?php echo esc_attr( $event['date'] ); ?>" data-event-time="<?php echo esc_attr( $event['time'] ); ?>" data-event-location="<?php echo esc_attr( $event['location'] ); ?>" data-event-price="<?php echo esc_attr( (string) $event['price'] ); ?>" data-event-price-label="<?php echo esc_attr( $event['price_label'] ); ?>" data-event-tickets="<?php echo esc_attr( wp_json_encode( $event['tickets'] ) ); ?>"><?php echo 0 === $event['price'] ? 'Reserve ticket' : 'Buy tickets'; ?> <?php echo kcid_icon( 'arrow' ); ?></button>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
				<p class="events-empty" id="events-empty" hidden>No events match that search yet. Try another keyword or reset the filters.</p>
			</div>
		</section>

		<section class="section-pad events-listing-note" aria-labelledby="events-note-title">
			<div class="container events-listing-note__grid">
				<div><p class="script-label">Planning to come?</p><h2 id="events-note-title">Bring your curiosity.</h2></div>
				<div><p>Tickets are limited for workshops and showcases. Reserve your place early, and we’ll send the event details and confirmation to your inbox.</p><a class="text-link" href="<?php echo esc_url( kcid_page_url( 'contact' ) ); ?>">Ask about an event <?php echo kcid_icon( 'arrow' ); ?></a></div>
			</div>
		</section>

		<div class="event-modal" id="event-ticket-modal" hidden>
			<div class="event-modal__backdrop" data-event-close></div>
			<div class="event-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="event-modal-title" aria-describedby="event-modal-copy" tabindex="-1">
				<div class="event-modal__header">
					<div><p class="eyebrow">Ticket checkout</p><h2 id="event-modal-title">Reserve your place</h2></div>
					<button class="event-modal__close" type="button" data-event-close aria-label="Close ticket checkout"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="event-modal__content">
					<div class="event-modal__event-meta" id="event-modal-copy">
						<span id="event-modal-date"></span><span id="event-modal-time"></span><span id="event-modal-location"></span>
					</div>
					<form class="event-ticket-form" id="event-ticket-form">
						<div class="event-ticket-form__intro"><p class="eyebrow eyebrow--blue">Your ticket</p><p id="event-modal-price-label">Choose your ticket type and tell us where to send your confirmation.</p></div>
						<fieldset class="event-ticket-options"><legend>Ticket type</legend><div id="event-ticket-options-list"></div></fieldset>
						<div class="event-ticket-form__grid">
							<label for="event-attendee-name">Full name<input id="event-attendee-name" name="name" type="text" autocomplete="name" required /></label>
							<label for="event-attendee-email">Email address<input id="event-attendee-email" name="email" type="email" autocomplete="email" required /></label>
							<label for="event-attendee-phone">Phone number<input id="event-attendee-phone" name="phone" type="tel" autocomplete="tel" required /></label>
							<label for="event-ticket-quantity">Number of tickets<select id="event-ticket-quantity" name="quantity"><option value="1">1 ticket</option><option value="2">2 tickets</option><option value="3">3 tickets</option><option value="4">4 tickets</option><option value="5">5 tickets</option><option value="6">6 tickets</option></select></label>
						</div>
						<div class="event-order-summary" aria-live="polite"><div><span>Tickets</span><strong id="event-order-ticket-count">1</strong></div><div><span>Total</span><strong id="event-order-total">Free</strong></div></div>
						<p class="event-payment-note" id="event-payment-note"></p>
						<button class="button button--dark event-ticket-form__submit" id="event-ticket-submit" type="submit">Reserve ticket <?php echo kcid_icon( 'arrow' ); ?></button>
						<p class="event-ticket-form__status" id="event-ticket-form-status" role="status" aria-live="polite"></p>
					</form>
					<div class="event-confirmation" id="event-confirmation" hidden role="status" aria-live="polite"><span class="event-confirmation__icon" aria-hidden="true">✓</span><p class="eyebrow eyebrow--blue">You’re on the list</p><h3 id="event-confirmation-title">Your place is reserved.</h3><p id="event-confirmation-copy"></p><button class="button button--dark" type="button" data-event-close>Back to events <?php echo kcid_icon( 'arrow' ); ?></button></div>
				</div>
			</div>
		</div>
		<?php
		break;

	case 'student-life':
		kcid_render_page_header( 'Student life', 'Student Life', 'Find the support, spaces, and shared experiences that help you focus, collaborate, and grow at KENCID.', 'about-students.png', 'creative', 'student-life' );
		?>
		<section class="section-pad student-life-video-section" aria-labelledby="student-life-video-title"><div class="container"><div class="student-life-video-section__intro"><p class="script-label">See campus life</p><h2 id="student-life-video-title">Watch KENCID in motion.</h2><p>Get a feel for the people, creative energy, and everyday moments that make student life here distinctive.</p></div><div class="student-life-video-grid"><article class="video-card video-card--featured"><div class="video-card__frame"><?php kcid_render_video_embed( 'student_life_featured', 'KENCID student life featured video', 'landscape' ); ?></div></article></div></div></section>
		<section class="section-pad section-light" aria-labelledby="life-support-title"><div class="container"><div class="section-heading-row"><div><p class="eyebrow eyebrow--blue">Life at KENCID</p><h2 id="life-support-title">Support for the whole student</h2></div></div><div class="feature-grid feature-grid--color"><article class="feature-card feature-card--yellow" id="affairs"><span class="feature-card__icon"><?php echo kcid_icon( 'community' ); ?></span><h3>Student affairs</h3><p>Support with academic progress, wellbeing, campus communication, and the practical rhythm of college life.</p></article><article class="feature-card feature-card--blue" id="accommodation"><span class="feature-card__icon"><?php echo kcid_icon( 'shield' ); ?></span><h3>Accommodation partners</h3><p>Qwetu and Qejani Student Residences offer furnished living, study areas, recreation, high-speed internet, CCTV, secure access, and 24/7 security.</p></article><article class="feature-card feature-card--pink" id="clubs"><span class="feature-card__icon"><?php echo kcid_icon( 'star' ); ?></span><h3>Clubs & council</h3><p>Student council, music, drama, dance, and creative clubs build friendships, leadership, and confidence outside studio time.</p></article></div></div></section>
		<section class="section-pad section-dark"><div class="container student-work__grid"><div class="section-intro"><p class="eyebrow">Studio culture</p><h2>Work that can be seen, touched, and discussed.</h2><p>Ideas move quickly when students have a place to test them together.</p></div><div class="work-strip" role="img" aria-label="Student design work and creative studio spaces"></div></div></section>
		<?php
		break;

	case 'about-us':
		kcid_render_page_header( 'About KENCID', 'About Us', 'Based in Nairobi, KENCID combines practical learning, industry relevance, and a supportive community for learners who want to make a mark.', 'hero-design-multidisciplinary-v2.png', '', 'about' );
		?>
		<section class="section-pad about-page-story"><div class="container page-intro__grid"><div class="about-page-story__media"><?php kcid_render_video_embed( 'about_story', 'About KENCID video', 'landscape' ); ?></div><div class="page-intro__copy"><h2><span class="about-page-story__heading-lead">KENCID is a college for design and</span> <span class="about-page-story__heading-tail">inclusive futures.</span></h2><p>KENCID combines practical learning, industry relevance, and a supportive community for learners who want to make a mark across design, media, construction, technology, business, and related fields.</p><a class="button button--primary" href="<?php echo kcid_page_url( 'programs' ); ?>">Explore our courses <?php echo kcid_icon( 'arrow' ); ?></a></div></div></section>
		<?php
		$reason_images = array(
			'program-sheet.webp',
			'team/03-vanessa-okello.jpg',
			'course-detail-interior-design.webp',
			'cta-design-journey-clean.png',
			'hero-design-studio.webp',
			'about-students.webp',
		);
		?>
		<section class="section-pad section-light about-why-section" aria-labelledby="about-why-title">
			<div class="container">
				<header class="about-why-section__header">
					<p class="about-why-section__eyebrow"><span aria-hidden="true"></span>Why choose KENCID</p>
					<h2 id="about-why-title">A Creative Education <span>That Works</span></h2>
					<p>Practical learning. Real opportunities. A brighter creative future.</p>
				</header>

				<div class="about-stat-grid about-stat-grid--tiles">
					<div class="about-stat-grid__tile about-stat-grid__tile--yellow"><span class="about-stat-grid__icon"><?php echo kcid_icon( 'cap' ); ?></span><strong>1+</strong><span>competitive courses</span></div>
					<div class="about-stat-grid__tile about-stat-grid__tile--pink"><span class="about-stat-grid__icon"><?php echo kcid_icon( 'community' ); ?></span><strong>99.9%</strong><span>student satisfaction</span></div>
					<div class="about-stat-grid__tile about-stat-grid__tile--blue"><span class="about-stat-grid__icon"><?php echo kcid_icon( 'star' ); ?></span><strong>TVETA</strong><span>accredited programs</span></div>
				</div>

				<div class="about-benefit-grid">
					<?php foreach ( kcid_reasons() as $reason_index => $reason ) : ?>
						<article class="about-benefit-card about-benefit-card--<?php echo esc_attr( (string) ( $reason_index % 3 ) ); ?>">
							<div class="about-benefit-card__copy"><span class="about-benefit-card__icon"><?php echo kcid_icon( $reason['icon'] ); ?></span><h3><?php echo esc_html( $reason['title'] ); ?></h3><p><?php echo esc_html( $reason['text'] ); ?></p></div>
							<div class="about-benefit-card__visual" style="background-image:url('<?php echo esc_url( kcid_asset( 'img/' . $reason_images[ $reason_index ] ) ); ?>')" aria-hidden="true"></div>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="about-why-section__actions"><a class="button button--primary" href="<?php echo esc_url( kcid_page_url( 'apply-now' ) ); ?>">Join KENCID Today <?php echo kcid_icon( 'arrow' ); ?></a><a class="about-why-section__link" href="<?php echo esc_url( kcid_page_url( 'programs' ) ); ?>">Explore Our Programs <?php echo kcid_icon( 'arrow-right' ); ?></a></div>
			</div>
		</section>
		<?php
		break;

	case 'our-team':
		$team_members = kcid_team_members();
		kcid_render_page_header( 'Our team', 'Our team', 'From studio mentors to admissions guides, our people help learners move from curiosity to confidence.', 'hero-business-v2.png', '', 'our-team' );
		?>
		<section class="section-pad team-section" aria-label="People at KENCID"><div class="container"><div class="section-heading-row"><p class="team-section__count"><?php echo esc_html( count( $team_members ) ); ?> team members</p></div><div class="team-card-grid" role="list"><?php foreach ( $team_members as $member ) : ?><article class="team-card" role="listitem"><div class="team-card__media"><img src="<?php echo esc_url( kcid_asset( 'img/' . $member['image'] ) ); ?>" alt="<?php echo esc_attr( $member['name'] . ', ' . $member['role'] ); ?>" loading="lazy" /></div><div class="team-card__body"><h3><?php echo esc_html( $member['name'] ); ?></h3><p><?php echo esc_html( $member['role'] ); ?></p></div></article><?php endforeach; ?></div></div></section>
		<?php
		break;

	case 'partners':
		$partners = array(
			array( 'name' => 'Kenya National Examinations Council', 'logo' => 'partner-knec.png' ),
			array( 'name' => 'TVET Curriculum Development, Assessment and Certification Council', 'logo' => 'partner-academic-mark.png' ),
			array( 'name' => 'ICM', 'logo' => 'partner-academic-mark-2.png' ),
			array( 'name' => 'BTEC', 'logo' => 'partner-btec.jpg' ),
			array( 'name' => 'KENCID Interiors', 'logo' => 'partner-kencid-interiors.png' ),
			array( 'name' => 'The African Institute of the Interior Design Professions', 'logo' => 'partner-iid.png' ),
			array( 'name' => 'Victoria Courts', 'logo' => 'partner-victoria-courts.png' ),
			array( 'name' => 'Interior Designers Association of Kenya', 'logo' => 'partner-idak-cropped.png' ),
			array( 'name' => 'Design Week Africa', 'logo' => 'partner-design-week-africa.png' ),
		);
		kcid_render_page_header( 'Partners', 'Our partners', 'Our academic and industry relationships help keep KCID learning credible, current, and connected to the creative economy.', 'hero-construction-management-v2.png', '', 'partners' );
		?>
		<section class="section-pad partners-section partners-section--academic"><div class="container"><h2>Academic &amp; certification partners</h2><ul class="partner-logo-grid" role="list"><?php foreach ( array_slice( $partners, 0, 4 ) as $partner ) : ?><li class="partner-logo"><img src="<?php echo esc_url( kcid_asset( 'img/' . $partner['logo'] ) ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" loading="lazy" /></li><?php endforeach; ?></ul></div></section>
		<section class="section-pad partners-section partners-section--industry"><div class="container"><h2>Industry partners</h2><ul class="partner-logo-grid partner-logo-grid--industry" role="list"><?php foreach ( array_slice( $partners, 4 ) as $partner ) : ?><li class="partner-logo"><img src="<?php echo esc_url( kcid_asset( 'img/' . $partner['logo'] ) ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" loading="lazy" /></li><?php endforeach; ?></ul></div></section>
		<?php
		break;

	case 'contact':
		kcid_render_page_header( 'Contact', 'Contact', 'Reach the college for applications, course guidance, school visits, accommodation, and student-life support.', 'hero-business-studio.png', '', 'contact' );
		?>
		<section class="section-pad contact-section"><div class="container contact-grid contact-grid--refreshed"><div class="contact-card contact-card--image"><div><p class="eyebrow">Come say hello</p><h2>Let’s talk about what comes next.</h2><p>Our team is ready to help you choose a course, understand the application process, or plan a visit to the Nairobi campus.</p></div><div class="contact-details"><p><?php echo kcid_icon( 'phone' ); ?><a href="tel:+254797888111"><?php echo esc_html( $contact['phone'] ); ?></a></p><p><?php echo kcid_icon( 'phone' ); ?><a href="tel:+254791888111"><?php echo esc_html( $contact['phone_alt'] ); ?></a></p><p><?php echo kcid_icon( 'mail' ); ?><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p><p><?php echo kcid_icon( 'pin' ); ?><span><?php echo esc_html( $contact['address'] ); ?></span></p></div></div><form class="contact-form contact-form--refreshed" aria-label="Contact form"><div class="form-heading"><p class="eyebrow eyebrow--blue">Send a message</p><h2>How can we help?</h2></div><label for="contact-name">Name<input id="contact-name" type="text" autocomplete="name" required></label><label for="contact-email">Email<input id="contact-email" type="email" autocomplete="email" required></label><label for="contact-message">Message<textarea id="contact-message" rows="5" required></textarea></label><a class="button button--primary" href="mailto:info@kencid.ac.ke">Send Email <?php echo kcid_icon( 'arrow' ); ?></a></form></div></section>
		<?php
		break;

	default:
		?><section class="section-pad"><div class="container content-page"><?php while ( have_posts() ) : the_post(); the_title( '<h1>', '</h1>' ); the_content(); endwhile; ?></div></section><?php
endswitch;
?>
</main>
<?php get_footer();
