<?php
/**
 * Static page template.
 *
 * @package KCIDCollege
 */

get_header();
$slug = get_post_field( 'post_name', get_queried_object_id() );
$contact = kcid_contacts();
?>
<main id="main">
<?php
switch ( $slug ) :
	case 'programs':
		$catalog = kcid_course_catalog();
		kcid_render_page_header( 'Programs & courses', 'Find your creative direction.', 'From building sciences and design to technology, media, business, hospitality, and health, KENCID gives you room to turn curiosity into a career.' );
		?>
		<section class="section-pad page-intro page-intro--image"><div class="container page-intro__grid"><div class="page-intro__media"><img src="<?php echo esc_url( kcid_asset( 'img/hero-design-studio.png' ) ); ?>" alt="KENCID student developing a design concept in the studio" /></div><div class="page-intro__copy"><p class="script-label">Learn by making</p><h2>Practical skills for the world you want to shape.</h2><p>KENCID blends theory with studio work, projects, site visits, and industry-led critique. Choose a course that matches the way you think, make, and solve problems.</p><div class="mini-stats" aria-label="Program highlights"><div><strong>3</strong><span>entry pathways</span></div><div><strong>10</strong><span>schools</span></div><div><strong>1:1</strong><span>guidance</span></div></div></div></div></section>
		<section class="section-pad section-light course-explorer" aria-labelledby="course-explorer-title"><div class="container"><div class="section-heading-row"><div><p class="eyebrow eyebrow--blue">Course explorer</p><h2 id="course-explorer-title">Explore all course areas</h2></div><a class="button button--dark" href="<?php echo kcid_page_url( 'admissions' ); ?>">Ask about a course <?php echo kcid_icon( 'arrow' ); ?></a></div><div class="catalog-grid"><?php foreach ( $catalog as $index => $school ) : ?><article class="catalog-card" id="<?php echo esc_attr( sanitize_title( $school['name'] ) ); ?>"><div class="catalog-card__image" style="background-image: linear-gradient(180deg, rgba(5,8,9,0.05), rgba(5,8,9,0.8)), url('<?php echo esc_url( kcid_asset( 'img/' . $school['image'] ) ); ?>');"><span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span></div><div class="catalog-card__body"><p class="eyebrow eyebrow--blue"><?php echo esc_html( count( $school['courses'] ) ); ?> course areas</p><h3><?php echo esc_html( $school['name'] ); ?></h3><p><?php echo esc_html( $school['intro'] ); ?></p><ul><?php foreach ( $school['courses'] as $course ) : ?><li><?php echo esc_html( $course ); ?></li><?php endforeach; ?></ul></div></article><?php endforeach; ?></div></div></section>
		<section class="section-pad featured-programs" aria-labelledby="featured-programs-title"><div class="container"><div class="section-heading-row"><div><p class="eyebrow eyebrow--blue">Popular starting points</p><h2 id="featured-programs-title">A closer look at design</h2></div><a class="text-link" href="<?php echo kcid_page_url( 'admissions' ); ?>">See entry requirements <?php echo kcid_icon( 'arrow' ); ?></a></div><div class="program-list program-list--compact"><?php foreach ( array_slice( kcid_programs(), 0, 3 ) as $program ) : ?><article class="program-detail" id="<?php echo esc_attr( $program['slug'] ); ?>"><div class="program-detail__image <?php echo esc_attr( $program['tile'] ); ?>"></div><div><p class="eyebrow eyebrow--blue"><?php echo esc_html( $program['school'] ); ?></p><h3><?php echo esc_html( $program['title'] ); ?></h3><p><?php echo esc_html( $program['summary'] ); ?></p><a class="text-link" href="<?php echo kcid_page_url( 'admissions' ); ?>">Admission requirements <?php echo kcid_icon( 'arrow' ); ?></a></div></article><?php endforeach; ?></div></div></section>
		<?php
		break;

	case 'admissions':
	case 'apply-now':
		kcid_render_page_header( 'Admissions', 'Your next creative step starts here.', 'Applications are open for diploma, certificate, and foundation study. Get course guidance, fee information, and help choosing the right pathway.' );
		?>
		<section class="section-pad admissions-overview"><div class="container"><div class="intake-banner"><div><p class="eyebrow">Now accepting applications</p><h2>Make your next move in September 2026.</h2><p>Talk to admissions about full-time and evening options, course fit, and the documents you need to get started.</p></div><a class="button button--dark" href="tel:+254797888111">Call admissions <?php echo kcid_icon( 'phone' ); ?></a></div><div class="pathway-grid" aria-label="Study pathways"><article class="pathway-card pathway-card--yellow"><span class="pathway-card__number">01</span><h2>Diploma</h2><p>For learners ready to build a strong professional foundation.</p><strong>KCSE C-</strong><span>6 semesters</span></article><article class="pathway-card pathway-card--blue"><span class="pathway-card__number">02</span><h2>Certificate</h2><p>A focused route into practical creative and technical study.</p><strong>KCSE D- and above</strong><span>3 semesters</span></article><article class="pathway-card pathway-card--pink"><span class="pathway-card__number">03</span><h2>Foundation</h2><p>Start your design journey and build confidence through making.</p><strong>KCSE: any grade</strong><span>2 semesters</span></article></div></div></section>
		<section class="section-pad section-light"><div class="container admissions-grid admissions-grid--refreshed"><div class="admissions-copy"><p class="script-label">Ready when you are</p><h2>Bring your questions. Leave with a plan.</h2><p>Our admissions team can help you understand course options, entry requirements, fees, flexible study programs, financial aid, and scholarships for outstanding students.</p><div class="admissions-checks"><span><?php echo kcid_icon( 'cap' ); ?>Course guidance</span><span><?php echo kcid_icon( 'calendar' ); ?>Flexible study options</span><span><?php echo kcid_icon( 'shield' ); ?>Accredited programs</span></div></div><form class="admissions-form" aria-label="Application interest form"><h2>Application interest</h2><p>Share a few details and continue the conversation on WhatsApp.</p><label for="applicant-name">Full name<input id="applicant-name" type="text" name="name" autocomplete="name" required></label><label for="applicant-phone">Phone number<input id="applicant-phone" type="tel" name="phone" autocomplete="tel" required></label><label for="applicant-program">Program of interest<select id="applicant-program" name="program"><?php foreach ( kcid_programs() as $program ) : ?><option><?php echo esc_html( $program['title'] ); ?></option><?php endforeach; ?></select></label><a class="button button--dark" href="<?php echo esc_url( kcid_whatsapp_url( 'Hi KENCID, I would like to learn more about applying.' ) ); ?>" target="_blank" rel="noopener noreferrer">Continue on WhatsApp <?php echo kcid_icon( 'arrow' ); ?></a></form></div></section>
		<?php
		break;

	case 'student-life':
		kcid_render_page_header( 'Student life', 'A creative community beyond the classroom.', 'Find the support, spaces, and shared experiences that help you focus, collaborate, and grow at KENCID.' );
		?>
		<section class="section-pad life-overview"><div class="container page-intro__grid page-intro__grid--reverse"><div class="page-intro__media page-intro__media--tall"><img src="<?php echo esc_url( kcid_asset( 'img/about-students.png' ) ); ?>" alt="KENCID students collaborating on campus" /></div><div class="page-intro__copy"><p class="script-label">Find your people</p><h2>Make space for learning, making, and belonging.</h2><p>College life is more than a timetable. Student affairs, clubs, creative projects, and accommodation partners give you the structure and community to make the most of your time at KENCID.</p><a class="button button--primary" href="<?php echo kcid_page_url( 'contact' ); ?>">Ask about student life <?php echo kcid_icon( 'arrow' ); ?></a></div></div></section>
		<section class="section-pad section-light" aria-labelledby="life-support-title"><div class="container"><div class="section-heading-row"><div><p class="eyebrow eyebrow--blue">Life at KENCID</p><h2 id="life-support-title">Support for the whole student</h2></div></div><div class="feature-grid feature-grid--color"><article class="feature-card feature-card--yellow" id="affairs"><span class="feature-card__icon"><?php echo kcid_icon( 'community' ); ?></span><h3>Student affairs</h3><p>Support with academic progress, wellbeing, campus communication, and the practical rhythm of college life.</p></article><article class="feature-card feature-card--blue" id="accommodation"><span class="feature-card__icon"><?php echo kcid_icon( 'shield' ); ?></span><h3>Accommodation partners</h3><p>Qwetu and Qejani Student Residences offer furnished living, study areas, recreation, high-speed internet, CCTV, secure access, and 24/7 security.</p></article><article class="feature-card feature-card--pink" id="clubs"><span class="feature-card__icon"><?php echo kcid_icon( 'star' ); ?></span><h3>Clubs & council</h3><p>Student council, music, drama, dance, and creative clubs build friendships, leadership, and confidence outside studio time.</p></article></div></div></section>
		<section class="section-pad section-dark"><div class="container student-work__grid"><div class="section-intro"><p class="eyebrow">Studio culture</p><h2>Work that can be seen, touched, and discussed.</h2><p>Ideas move quickly when students have a place to test them together.</p></div><div class="work-strip" role="img" aria-label="Student design work and creative studio spaces"></div></div></section>
		<?php
		break;

	case 'about-us':
		kcid_render_page_header( 'About KENCID', "Kenya's college for creative and built-environment education.", 'Based in Nairobi, KENCID combines practical learning, industry relevance, and a supportive community for learners who want to make a mark.' );
		?>
		<section class="section-pad about-page-story"><div class="container page-intro__grid"><div class="page-intro__copy"><p class="script-label">Why KENCID</p><h2>Learn the craft. Build the confidence. Find your next step.</h2><p>KENCID prioritizes hands-on learning experiences so students gain practical skills and industry knowledge. Through studios, mentorship, and real-world design challenges, learners prepare for careers across design, media, construction, technology, business, and related fields.</p><a class="button button--primary" href="<?php echo kcid_page_url( 'programs' ); ?>">Explore our courses <?php echo kcid_icon( 'arrow' ); ?></a></div><div class="about-page-story__media"><img src="<?php echo esc_url( kcid_asset( 'img/why-students.png' ) ); ?>" alt="KENCID students and staff celebrating together" /></div></div></section>
		<section class="section-pad section-light"><div class="container"><div class="about-stat-grid"><div><strong>1+</strong><span>competitive courses</span></div><div><strong>99.9%</strong><span>student satisfaction</span></div><div><strong>TVETA</strong><span>accredited programs</span></div></div><div class="reason-grid reason-grid--wide reason-grid--about"><?php foreach ( kcid_reasons() as $reason ) : ?><article class="reason-card"><span><?php echo kcid_icon( $reason['icon'] ); ?></span><h3><?php echo esc_html( $reason['title'] ); ?></h3><p><?php echo esc_html( $reason['text'] ); ?></p></article><?php endforeach; ?></div></div></section>
		<?php
		break;

	case 'our-team':
		kcid_render_page_header( 'Our team', 'The people who help ideas take shape.', 'From studio mentors to admissions guides, our people help learners move from curiosity to confidence.' );
		?>
		<section class="section-pad"><div class="container"><div class="section-heading-row"><div><p class="eyebrow eyebrow--blue">People at KCID</p><h2>Support for every stage of the journey.</h2></div></div><div class="feature-grid feature-grid--color"><article class="feature-card feature-card--yellow"><span class="feature-card__icon"><?php echo kcid_icon( 'cap' ); ?></span><h3>Academic &amp; studio faculty</h3><p>Practitioners and educators bring real project experience into the classroom, studio, and workshop.</p></article><article class="feature-card feature-card--blue"><span class="feature-card__icon"><?php echo kcid_icon( 'community' ); ?></span><h3>Admissions &amp; student support</h3><p>Our team helps learners choose a course, understand the next step, and feel at home on campus.</p></article><article class="feature-card feature-card--pink"><span class="feature-card__icon"><?php echo kcid_icon( 'briefcase' ); ?></span><h3>Industry mentors</h3><p>Connections with working professionals keep learning relevant, practical, and connected to opportunity.</p></article></div></div></section>
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
			array( 'name' => 'Interior Designers Association of Kenya', 'logo' => 'partner-idak.png' ),
			array( 'name' => 'Africa Interior Design Week', 'logo' => 'partner-dw.png' ),
		);
		kcid_render_page_header( 'Partners', 'Connected to the world beyond campus.', 'Our academic and industry relationships help keep KCID learning credible, current, and connected to the creative economy.' );
		?>
		<section class="section-pad partners-section partners-section--academic"><div class="container"><h2>Academic &amp; certification partners</h2><ul class="partner-logo-grid" role="list"><?php foreach ( array_slice( $partners, 0, 4 ) as $partner ) : ?><li class="partner-logo"><img src="<?php echo esc_url( kcid_asset( 'img/' . $partner['logo'] ) ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" loading="lazy" /></li><?php endforeach; ?></ul></div></section>
		<section class="section-pad partners-section partners-section--industry"><div class="container"><h2>Industry partners</h2><ul class="partner-logo-grid partner-logo-grid--industry" role="list"><?php foreach ( array_slice( $partners, 4 ) as $partner ) : ?><li class="partner-logo"><img src="<?php echo esc_url( kcid_asset( 'img/' . $partner['logo'] ) ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" loading="lazy" /></li><?php endforeach; ?></ul></div></section>
		<?php
		break;

	case 'contact':
		kcid_render_page_header( 'Contact', 'Talk to KENCID admissions.', 'Reach the college for applications, course guidance, school visits, accommodation, and student-life support.' );
		?>
		<section class="section-pad contact-section"><div class="container contact-grid contact-grid--refreshed"><div class="contact-card contact-card--image"><div><p class="eyebrow">Come say hello</p><h2>Let’s talk about what comes next.</h2><p>Our team is ready to help you choose a course, understand the application process, or plan a visit to the Nairobi campus.</p></div><div class="contact-details"><p><?php echo kcid_icon( 'phone' ); ?><a href="tel:+254797888111"><?php echo esc_html( $contact['phone'] ); ?></a></p><p><?php echo kcid_icon( 'phone' ); ?><a href="tel:+254791888111"><?php echo esc_html( $contact['phone_alt'] ); ?></a></p><p><?php echo kcid_icon( 'mail' ); ?><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p><p><?php echo kcid_icon( 'pin' ); ?><span><?php echo esc_html( $contact['address'] ); ?></span></p></div></div><form class="contact-form contact-form--refreshed" aria-label="Contact form"><div class="form-heading"><p class="eyebrow eyebrow--blue">Send a message</p><h2>How can we help?</h2></div><label for="contact-name">Name<input id="contact-name" type="text" autocomplete="name" required></label><label for="contact-email">Email<input id="contact-email" type="email" autocomplete="email" required></label><label for="contact-message">Message<textarea id="contact-message" rows="5" required></textarea></label><a class="button button--primary" href="mailto:info@kencid.ac.ke">Send Email <?php echo kcid_icon( 'arrow' ); ?></a></form></div></section>
		<section class="section-pad section-light contact-next"><div class="container contact-next__grid"><div><p class="eyebrow eyebrow--blue">Before you visit</p><h2>Bring your questions.</h2></div><div><p>Ask us about course availability, entry requirements, fees, evening study, accommodation partners, and student support. We’ll help you find the clearest next step.</p><a class="text-link" href="<?php echo kcid_page_url( 'admissions' ); ?>">View admissions information <?php echo kcid_icon( 'arrow' ); ?></a></div></div></section>
		<?php
		break;

	default:
		?><section class="section-pad"><div class="container content-page"><?php while ( have_posts() ) : the_post(); the_title( '<h1>', '</h1>' ); the_content(); endwhile; ?></div></section><?php
endswitch;
?>
</main>
<?php get_footer();
