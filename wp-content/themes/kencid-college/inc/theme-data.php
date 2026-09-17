<?php
/**
 * Static content for the KENCID exportable theme.
 *
 * @package KCIDCollege
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the recurring intake schedule used across the site.
 *
 * The final day of each intake month is used as the countdown target, matching
 * the existing September intake target while keeping the schedule editable in
 * one place.
 */
function kcid_intake_schedule(): array {
	return array(
		array( 'month' => 1, 'name' => 'January', 'day' => 31 ),
		array( 'month' => 5, 'name' => 'May', 'day' => 31 ),
		array( 'month' => 9, 'name' => 'September', 'day' => 30 ),
	);
}

function kcid_intake_timezone(): DateTimeZone {
	return function_exists( 'wp_timezone' ) ? wp_timezone() : new DateTimeZone( 'Africa/Nairobi' );
}

function kcid_intake_details( DateTimeImmutable $date, array $intake ): array {
	return array(
		'name'      => $intake['name'],
		'month'     => (int) $date->format( 'n' ),
		'year'      => (int) $date->format( 'Y' ),
		'label'     => $date->format( 'F Y' ),
		'date'      => $date->format( 'Y-m-d' ),
		'iso'       => $date->format( 'c' ),
		'timestamp' => $date->getTimestamp(),
	);
}

function kcid_next_intake( ?DateTimeInterface $now = null ): array {
	$timezone = kcid_intake_timezone();
	$now      = $now ? DateTimeImmutable::createFromInterface( $now )->setTimezone( $timezone ) : new DateTimeImmutable( 'now', $timezone );
	$year     = (int) $now->format( 'Y' );

	foreach ( kcid_intake_schedule() as $intake ) {
		$date = new DateTimeImmutable(
			sprintf( '%04d-%02d-%02d 00:00:00', $year, $intake['month'], $intake['day'] ),
			$timezone
		);

		if ( $date > $now ) {
			return kcid_intake_details( $date, $intake );
		}
	}

	$first_intake = kcid_intake_schedule()[0];
	$next_date    = new DateTimeImmutable(
		sprintf( '%04d-%02d-%02d 00:00:00', $year + 1, $first_intake['month'], $first_intake['day'] ),
		$timezone
	);

	return kcid_intake_details( $next_date, $first_intake );
}

function kcid_upcoming_intakes( int $count = 3, ?DateTimeInterface $now = null ): array {
	$count    = max( 1, $count );
	$next     = kcid_next_intake( $now );
	$schedule = kcid_intake_schedule();
	$index    = 0;

	foreach ( $schedule as $schedule_index => $intake ) {
		if ( $intake['month'] === $next['month'] ) {
			$index = $schedule_index;
			break;
		}
	}

	$intakes = array();
	for ( $offset = 0; $offset < $count; $offset++ ) {
		$schedule_index = ( $index + $offset ) % count( $schedule );
		$year           = $next['year'] + (int) floor( ( $index + $offset ) / count( $schedule ) );
		$intake         = $schedule[ $schedule_index ];
		$date           = new DateTimeImmutable(
			sprintf( '%04d-%02d-%02d 00:00:00', $year, $intake['month'], $intake['day'] ),
			kcid_intake_timezone()
		);

		$intakes[] = kcid_intake_details( $date, $intake );
	}

	return $intakes;
}

function kcid_programs(): array {
	$next_intake = kcid_next_intake();

	return array(
		array( 'title' => 'Interior Design', 'school' => 'School of Building Sciences', 'slug' => 'interior-design', 'summary' => 'Plan residential and commercial spaces through drawing, materials, lighting, furniture, and client-led studio work.', 'tile' => 'tile-1', 'duration' => '3 years', 'mode' => 'Full-time', 'entry' => 'KCSE C- and above', 'qualification' => 'Diploma', 'intake' => $next_intake['label'], 'image' => 'courses-raster/interior-design.png' ),
		array( 'title' => 'Architecture', 'school' => 'School of Building Sciences', 'slug' => 'architecture', 'summary' => 'Build a design foundation in architectural drafting, model making, building systems, and sustainable spaces.', 'tile' => 'tile-2', 'duration' => '3 years', 'mode' => 'Full-time', 'entry' => 'KCSE C- and above', 'qualification' => 'Diploma', 'intake' => $next_intake['label'], 'image' => 'courses-raster/architecture.png' ),
		array( 'title' => 'Fashion Design', 'school' => 'School of Design', 'slug' => 'fashion-design', 'summary' => 'Explore garment construction, textile choices, fashion illustration, styling, and creative entrepreneurship.', 'tile' => 'tile-3', 'duration' => '2 years', 'mode' => 'Full-time', 'entry' => 'KCSE D+ and above', 'qualification' => 'Diploma', 'intake' => $next_intake['label'], 'image' => 'courses-raster/fashion-design.png' ),
		array( 'title' => 'Graphic Design', 'school' => 'School of Design', 'slug' => 'graphic-design', 'summary' => 'Create strong visual identities, layouts, digital campaigns, and communication systems for modern brands.', 'tile' => 'tile-4', 'duration' => '2 years', 'mode' => 'Full-time', 'entry' => 'KCSE D+ and above', 'qualification' => 'Diploma', 'intake' => $next_intake['label'], 'image' => 'courses-raster/graphic-design.png' ),
		array( 'title' => 'Film & Cinematography', 'school' => 'School of Media and Communication', 'slug' => 'film-cinematography', 'summary' => 'Learn camera craft, visual storytelling, lighting, editing, and production workflows for screen media.', 'tile' => 'tile-5', 'duration' => '2 years', 'mode' => 'Full-time', 'entry' => 'KCSE D+ and above', 'qualification' => 'Diploma', 'intake' => $next_intake['label'], 'image' => 'courses-raster/film-cinematography.png' ),
		array( 'title' => 'Construction Management', 'school' => 'School of Building Sciences', 'slug' => 'construction-management', 'summary' => 'Prepare for site coordination, project planning, safety, costing, and delivery in the built environment.', 'tile' => 'tile-6', 'duration' => '3 years', 'mode' => 'Full-time', 'entry' => 'KCSE C- and above', 'qualification' => 'Diploma', 'intake' => $next_intake['label'], 'image' => 'courses-raster/construction-management.png' ),
	);
}

/**
 * Team roster sourced from the public KENCID Our Team page.
 * Portraits are stored locally in assets/img/team for reliable rendering.
 */
function kcid_team_members(): array {
	return array(
		array( 'name' => 'George Washington', 'role' => 'President', 'image' => 'team/01-george-washington.jpg' ),
		array( 'name' => 'Joel Waweru', 'role' => 'Vice President, Media & Communication', 'image' => 'team/02-joel-waweru.jpg' ),
		array( 'name' => 'Vanessa Okello', 'role' => 'Vice President, Administration & Business Development', 'image' => 'team/03-vanessa-okello.jpg' ),
		array( 'name' => 'Ibasha Pauline', 'role' => 'Vice President, Corporate Affairs & Partnerships', 'image' => 'team/04-ibasha-pauline.jpg' ),
		array( 'name' => 'Cynthia Munyoki', 'role' => 'Director, Finance', 'image' => 'team/05-cynthia-munyoki.jpg' ),
		array( 'name' => 'Ida Wafula', 'role' => 'Director, Administration', 'image' => 'team/06-ida-wafula.jpg' ),
		array( 'name' => 'Catherine Nderitu', 'role' => 'Director, Academics', 'image' => 'team/07-catherine-nderitu.jpg' ),
		array( 'name' => 'Francis Nyasili', 'role' => 'Director, Research Centre for Design Science', 'image' => 'team/08-francis-nyasili.jpg' ),
		array( 'name' => 'Abubakar Ndegwa', 'role' => 'Director, KENCID Admissions Board', 'image' => 'team/09-abubakar-ndegwa.jpg' ),
		array( 'name' => 'Natasha Munee', 'role' => 'Director, Student Affairs', 'image' => 'team/10-natasha-munee.jpg' ),
		array( 'name' => 'Charity Jelagat', 'role' => 'Director, Hospitality', 'image' => 'team/11-charity-jelagat.jpg' ),
		array( 'name' => 'Geoffrey Wambua', 'role' => 'Director, Facilities', 'image' => 'team/12-geoffrey-wambua.jpg' ),
		array( 'name' => 'Tabitha Wanja', 'role' => 'Lecturer', 'image' => 'team/13-tabitha-wanja.jpeg' ),
		array( 'name' => 'Vivian Wafula', 'role' => 'Lecturer', 'image' => 'team/14-vivian-wafula.jpg' ),
		array( 'name' => 'Terry Kayieko', 'role' => 'Lecturer', 'image' => 'team/15-terry-kayieko.jpeg' ),
		array( 'name' => 'Jesse Basil', 'role' => 'Lecturer', 'image' => 'team/16-jesse-basil.jpg' ),
		array( 'name' => 'Daniel Opondo', 'role' => 'Lecturer', 'image' => 'team/17-daniel-opondo.jpg' ),
		array( 'name' => "James Ndung'u", 'role' => 'Lecturer', 'image' => 'team/18-james-ndungu.jpg' ),
		array( 'name' => 'Denis Musila', 'role' => 'Lecturer', 'image' => 'team/19-denis-musila.jpg' ),
		array( 'name' => 'Esther Waweru', 'role' => 'Lecturer', 'image' => 'team/20-esther-waweru.jpg' ),
		array( 'name' => 'Cyril Okoth', 'role' => 'Lecturer', 'image' => 'team/21-cyril-okoth.jpg' ),
		array( 'name' => 'Monica Bosita', 'role' => 'Lecturer', 'image' => 'team/22-monica-bosita.jpg' ),
		array( 'name' => 'Ngina Mwaura', 'role' => 'Lecturer', 'image' => 'team/23-ngina-mwaura.jpg' ),
		array( 'name' => 'Henry Omutayi', 'role' => 'Head of Media Team', 'image' => 'team/24-henry-omutayi.jpg' ),
		array( 'name' => 'Grace Chege', 'role' => 'Front Office Manager', 'image' => 'team/25-grace-chege.jpeg' ),
		array( 'name' => 'Cliffton Wanzala', 'role' => 'Media Team', 'image' => 'team/26-cliffton-wanzala.jpg' ),
		array( 'name' => "Faith Ng'ang'a", 'role' => 'Media Team', 'image' => 'team/27-faith-nganga.jpg' ),
		array( 'name' => 'Brenda Maramba', 'role' => 'Media Team', 'image' => 'team/28-brenda-maramba.jpg' ),
		array( 'name' => 'Kelvin Kiama', 'role' => 'Lecturer', 'image' => 'team/29-kelvin-kiama.jpg' ),
	);
}

function kcid_course_image( string $school, string $title = '' ): string {
	return 'courses-raster/' . sanitize_title( $title ) . '.png';
}

function kcid_program_by_slug( string $slug ): ?array {
	$slug    = sanitize_title( $slug );
	$aliases = function_exists( 'kcid_course_aliases' ) ? kcid_course_aliases() : array();
	$slug    = $aliases[ $slug ] ?? $slug;

	foreach ( array_merge( kcid_catalog_programs(), kcid_programs() ) as $program ) {
		if ( $program['slug'] === $slug ) {
			return $program;
		}
	}

	return null;
}

function kcid_projects(): array {
	return array(
		array(
			'title'       => 'The Material House',
			'discipline'  => 'Interior Design',
			'designer'    => 'Wanjiku Njeri',
			'year'        => '2025',
			'summary'     => 'A warm, tactile hospitality concept shaped around locally inspired materials and quiet moments of arrival.',
			'cover'       => 'course-detail-interior-design.png',
			'images'      => array( 'course-detail-interior-design.png', 'student-work-strip.png', 'hero-design-studio.png' ),
		),
		array(
			'title'       => 'Lightwell Learning Hub',
			'discipline'  => 'Architecture',
			'designer'    => 'Brian Otieno',
			'year'        => '2025',
			'summary'     => 'A community learning space that uses light, shade, and shared courtyards to make learning feel open and connected.',
			'cover'       => 'school-building-sciences.png',
			'images'      => array( 'school-building-sciences.png', 'student-work-strip.png', 'program-sheet.png' ),
		),
		array(
			'title'       => 'Form / Function',
			'discipline'  => 'Fashion Design',
			'designer'    => 'Akinyi Auma',
			'year'        => '2024',
			'summary'     => 'A contemporary capsule collection exploring structure, movement, and the expressive potential of everyday silhouettes.',
			'cover'       => 'hero-fashion-design.png',
			'images'      => array( 'hero-fashion-design.png', 'school-design.png', 'student-work-strip.png' ),
		),
		array(
			'title'       => 'New African Marks',
			'discipline'  => 'Graphic Design',
			'designer'    => 'David Mwangi',
			'year'        => '2025',
			'summary'     => 'A visual identity system balancing bold geometry with a generous, human tone for a new creative collective.',
			'cover'       => 'school-design.png',
			'images'      => array( 'school-design.png', 'hero-design-studio.png', 'student-work-strip.png' ),
		),
		array(
			'title'       => 'Between Takes',
			'discipline'  => 'Film & Cinematography',
			'designer'    => 'Njeri Kamau',
			'year'        => '2024',
			'summary'     => 'A short-film concept told through contrast, texture, and the small details that live between a scene and its next take.',
			'cover'       => 'hero-media-studio.png',
			'images'      => array( 'hero-media-studio.png', 'hero-design-studio.png', 'student-work-strip.png' ),
		),
		array(
			'title'       => 'Grounded Futures',
			'discipline'  => 'Construction & Built Environment',
			'designer'    => 'Kevin Kiptoo',
			'year'        => '2025',
			'summary'     => 'A resilient mixed-use campus proposal designed for everyday life, climate responsiveness, and long-term community use.',
			'cover'       => 'school-engineering.png',
			'images'      => array( 'school-engineering.png', 'school-building-sciences.png', 'course-detail-interior-design.png' ),
		),
	);
}

/**
 * Upcoming KENCID events used by the public events listing.
 *
 * Keep the event shape intentionally small so this can be swapped for a
 * custom post type or ticketing API later without changing the page markup.
 */
function kcid_events(): array {
	return array(
		array(
			'slug'        => 'design-open-studio',
			'title'       => 'KENCID Design Open Studio',
			'category'    => 'Open day',
			'format'      => 'In person',
			'date'        => 'Saturday, 19 September 2026',
			'date_short'  => '19 Sep 2026',
			'day'         => '19',
			'month'       => 'SEP',
			'time'        => '10:00 AM – 2:00 PM',
			'location'    => 'KENCID Main Campus',
			'summary'     => 'Walk through our studios, meet the tutors, and get a feel for the people and projects behind a KENCID education.',
			'image'       => 'hero-design-studio.png',
			'price'       => 0,
			'price_label' => 'Free entry',
			'capacity'    => '120 spots available',
			'tickets'     => array( array( 'label' => 'Free reservation', 'price' => 0 ) ),
		),
		array(
			'slug'        => 'texture-light-space',
			'title'       => 'Texture, Light & Space',
			'category'    => 'Workshop',
			'format'      => 'In person',
			'date'        => 'Saturday, 26 September 2026',
			'date_short'  => '26 Sep 2026',
			'day'         => '26',
			'month'       => 'SEP',
			'time'        => '10:00 AM – 1:00 PM',
			'location'    => 'KENCID Studio 2',
			'summary'     => 'A hands-on material workshop exploring how light, texture, and colour change the feeling of an interior.',
			'image'       => 'course-detail-interior-design.png',
			'price'       => 1500,
			'price_label' => 'From KSh 1,500',
			'capacity'    => '24 spots left',
			'tickets'     => array(
				array( 'label' => 'General admission', 'price' => 1500 ),
				array( 'label' => 'Student pass', 'price' => 800 ),
			),
		),
		array(
			'slug'        => 'student-work-showcase',
			'title'       => 'Student Work Showcase',
			'category'    => 'Exhibition',
			'format'      => 'In person',
			'date'        => 'Saturday, 3 October 2026',
			'date_short'  => '3 Oct 2026',
			'day'         => '03',
			'month'       => 'OCT',
			'time'        => '11:00 AM – 4:00 PM',
			'location'    => 'Gallery & courtyard',
			'summary'     => 'See the ideas, experiments, and finished pieces our students are making across design, media, fashion, and the built environment.',
			'image'       => 'student-work-strip.png',
			'price'       => 0,
			'price_label' => 'Free entry',
			'capacity'    => 'Open entry',
			'tickets'     => array( array( 'label' => 'Free reservation', 'price' => 0 ) ),
		),
		array(
			'slug'        => 'creative-careers-night',
			'title'       => 'Creative Careers Night',
			'category'    => 'Talks & panels',
			'format'      => 'In person',
			'date'        => 'Friday, 9 October 2026',
			'date_short'  => '9 Oct 2026',
			'day'         => '09',
			'month'       => 'OCT',
			'time'        => '5:30 PM – 8:00 PM',
			'location'    => 'The Commons, KENCID',
			'summary'     => 'Meet creative practitioners from across the industry and leave with honest advice for building your first portfolio and career move.',
			'image'       => 'hero-media-studio-v2.png',
			'price'       => 500,
			'price_label' => 'From KSh 500',
			'capacity'    => '80 spots left',
			'tickets'     => array(
				array( 'label' => 'General admission', 'price' => 500 ),
				array( 'label' => 'KENCID student', 'price' => 250 ),
			),
		),
		array(
			'slug'        => 'campus-tour-course-clinic',
			'title'       => 'Campus Tour & Course Clinic',
			'category'    => 'Open day',
			'format'      => 'In person',
			'date'        => 'Saturday, 17 October 2026',
			'date_short'  => '17 Oct 2026',
			'day'         => '17',
			'month'       => 'OCT',
			'time'        => '9:00 AM – 12:00 PM',
			'location'    => 'KENCID Main Campus',
			'summary'     => 'Tour the campus, compare study pathways, and get one-to-one guidance on the course that fits your next chapter.',
			'image'       => 'about-students.png',
			'price'       => 0,
			'price_label' => 'Free entry',
			'capacity'    => '60 spots available',
			'tickets'     => array( array( 'label' => 'Free reservation', 'price' => 0 ) ),
		),
		array(
			'slug'        => 'fashion-film-night',
			'title'       => 'Fashion & Film Night',
			'category'    => 'Showcase',
			'format'      => 'In person',
			'date'        => 'Saturday, 31 October 2026',
			'date_short'  => '31 Oct 2026',
			'day'         => '31',
			'month'       => 'OCT',
			'time'        => '6:00 PM – 9:30 PM',
			'location'    => 'KENCID Creative Hall',
			'summary'     => 'An evening of moving image, styling, performance, and the bold new work coming out of our creative schools.',
			'image'       => 'hero-fashion-design-v2.png',
			'price'       => 1000,
			'price_label' => 'From KSh 1,000',
			'capacity'    => '150 seats available',
			'tickets'     => array(
				array( 'label' => 'General admission', 'price' => 1000 ),
				array( 'label' => 'Student pass', 'price' => 500 ),
			),
		),
	);
}

function kcid_schools(): array {
	return array(
		'School of Building Sciences',
		'School of Design',
		'School of Media and Communication',
		'School of Information Technology',
		'School of Engineering & Automotive Design',
		'School of Business Management',
		'School of Creative & Performing Arts',
		'School of Health Sciences',
		'School of Hospitality Management',
		'School of Trades & Technology',
	);
}

function kcid_school_label( string $name ): string {
	return trim( (string) preg_replace( '/^School of\s+/i', '', $name ) );
}

function kcid_school_by_slug( string $slug ): ?array {
	$slug = sanitize_title( $slug );

	foreach ( kcid_course_catalog() as $school ) {
		if ( sanitize_title( $school['name'] ) === $slug ) {
			return $school;
		}
	}

	return null;
}

function kcid_course_catalog(): array {
	return array(
		array(
			'name' => 'School of Building Sciences',
			'intro' => 'Shape the spaces, structures, and places where people live and work.',
			'courses' => array( 'Interior Design', 'Architecture', 'Landscape Architecture', 'Urban Design', 'Quantity Survey', 'Construction Management', 'Building Technology', 'Preservation Design', 'Universal Design', 'Architectural History', 'Interior Architecture' ),
			'image' => 'kencid-source/school-building-sciences.jpg',
		),
		array(
			'name' => 'School of Design',
			'intro' => 'Turn ideas into visual, spatial, digital, and product experiences.',
			'courses' => array( 'Furniture Design', 'Accessory Design', 'Fashion Design', 'Jewelry Design and Metal Arts', 'Game Design and Development', 'Fiber & Textile Design', 'Graphic Design', 'Web Design and New Media', 'Interactive Media Design', 'Animation Design', 'Product Design', 'Design', 'Motion Media Design', 'Industrial Design', 'Knitwear Design', 'User Experience Design and Research', 'Textile Design', 'Costume Design', 'Printing', 'Fashion Styling', 'Sneaker Design' ),
			'image' => 'kencid-source/school-design.jpg',
		),
		array(
			'name' => 'School of Media and Communication',
			'intro' => 'Build the craft and confidence to communicate through film, sound, and story.',
			'courses' => array( 'Cinema Studies', 'Communications', 'Film and TV', 'French', 'Visual Effects', 'Fashion Journalism', 'Animation and Visual Effects', 'Videography', 'Journalism and Media Studies', 'Set Design', 'Motion Picture and Television', 'Writing and Directing for Film', 'Cinematography', 'Screenwriting' ),
			'image' => 'kencid-source/school-media.jpeg',
		),
		array(
			'name' => 'School of Information Technology',
			'intro' => 'Learn the digital tools and systems powering the creative economy.',
			'courses' => array( 'Information Technology', 'Business Information Technology', 'Computer Science', 'Software Development', 'Networking', 'Information Security', 'Cybersecurity', 'Web Development', 'Database Management' ),
			'image' => 'kencid-source/school-information-technology.jpg',
		),
		array(
			'name' => 'School of Engineering & Automotive Design',
			'intro' => 'Combine technical thinking with the imagination to move products and mobility forward.',
			'courses' => array( 'Transportation Design', 'Electronic Design', 'Automotive Restoration', 'Automotive Design', 'Electrical Engineering', 'Structural Engineering', 'Mechanical Engineering' ),
			'image' => 'kencid-source/school-engineering.jpg',
		),
		array(
			'name' => 'School of Business Management',
			'intro' => 'Develop the strategy, leadership, and enterprise skills behind creative work.',
			'courses' => array( 'Advertising and Branding', 'Branded Entertainment', 'Business Management', 'Creative Business Leadership', 'Design Management', 'Fashion Marketing and Management', 'Fibres', 'Business Innovation', 'Social Media Strategy and Management', 'Social Media Management', 'Fashion and Visual Merchandising', 'Public Relations' ),
			'image' => 'kencid-source/school-business.webp',
		),
		array(
			'name' => 'School of Creative & Performing Arts',
			'intro' => 'Make, perform, and tell stories that connect with audiences.',
			'courses' => array( 'Art Education', 'Acting', 'Dance', 'Vocal Performance', 'Creative Writing', 'Dramatic Writing', 'Ceramic Arts', 'Music', 'Art History', 'Writing for Film, TV and Digital Media', 'Painting', 'Photography', 'Sculpture', 'Television Production', 'Sound Design', 'Music Production', 'Music Scoring and Composition', 'Drawing' ),
			'image' => 'kencid-source/school-creative-performing-arts.jpg',
		),
		array(
			'name' => 'School of Hospitality Management',
			'intro' => 'Prepare for guest experiences, operations, travel, and service leadership.',
			'courses' => array( 'Hotel & Restaurant Management', 'Tourism & Travel Management', 'Food & Beverage Management', 'Food Production Technician - Culinary Arts', 'Management of Travel & Tourism Operations', 'Housekeeping and Accommodation Operations', 'Tour Operations', 'Tourism Marketing & Promotion', 'Front Office Operations' ),
			'image' => 'kencid-source/school-hospitality-management.jpg',
		),
		array(
			'name' => 'School of Health Sciences',
			'intro' => 'Build practical skills for people-centred health and community services.',
			'courses' => array( 'Community Health Worker', 'Health Records and Information Technology', 'Human Nutrition and Dietetics', 'Perioperative Theatre Technology', 'Orthopedic Technology', 'Pharmacy', 'Clinical Medicine and Surgery', 'Occupational Therapy' ),
			'image' => 'kencid-source/school-health-sciences.webp',
		),
		array(
			'name' => 'School of Trades & Technology',
			'intro' => 'Get hands-on with the technical skills that keep the built environment moving.',
			'courses' => array( 'Electrical and Electronic Engineering', 'Plumbing', 'Masonry', 'Tiling', 'Partitioning and Ceiling Installation', 'Auto Technician', 'Mechanical and Automotive Engineering', 'Welding and Fabrication', 'Automotive Engineering', 'Carpentry and Joinery' ),
			'image' => 'kencid-source/school-engineering.jpg',
		),
	);
}

/**
 * Flatten the school catalog into the card/detail shape used by the UI.
 * Each catalog course resolves to its own course-specific photographic asset
 * so cards and detail pages never fall back to a repeated school image.
 */
function kcid_catalog_programs(): array {
	static $cached_programs = null;

	if ( null !== $cached_programs ) {
		return $cached_programs;
	}

	$programs    = array();
	$next_intake = kcid_next_intake();

	foreach ( kcid_course_catalog() as $school ) {
		foreach ( $school['courses'] as $title ) {
			$detail = kcid_course_detail( $title, $school['name'] );
			$course_image = kcid_course_image( $school['name'], $title );

			if ( ! file_exists( get_theme_file_path( 'assets/img/' . $course_image ) ) ) {
				$course_image = $school['image'];
			}

			$programs[] = array(
				'title'         => $title,
				'school'        => $school['name'],
				'slug'          => sanitize_title( $title ),
				'summary'       => $detail['summary'],
				'overview'      => $detail['overview'],
				'why'           => $detail['why'],
				'learning'      => $detail['learning'],
				'careers'       => $detail['careers'],
				'pathways'      => $detail['pathways'],
				'tile'          => '',
				'duration'      => '6 / 3 / 2 semesters',
				'mode'          => 'Full-time & evening',
				'entry'         => 'Diploma C- / Certificate D / Foundation D-',
				'qualification' => 'Diploma / Certificate / Foundation',
				'intake'        => $next_intake['label'],
				'image'         => $course_image,
			);
		}
	}

	$cached_programs = $programs;
	return $cached_programs;
}

function kcid_reasons(): array {
	return array(
		array( 'icon' => 'cap', 'title' => 'Industry-Aligned Curriculum', 'text' => 'Programs are designed around practical studio learning and real-world outcomes.' ),
		array( 'icon' => 'user', 'title' => 'Expert Faculty & Mentorship', 'text' => 'Students learn from seasoned professionals and creative practitioners.' ),
		array( 'icon' => 'tools', 'title' => 'Hands-On Learning', 'text' => 'Studios, workshops, models, material boards, and live projects shape each journey.' ),
		array( 'icon' => 'briefcase', 'title' => 'Career Ready', 'text' => 'Portfolio building, internships, and placement support prepare students for work.' ),
		array( 'icon' => 'globe', 'title' => 'Modern Facilities', 'text' => 'Students work in creative studios, labs, workshops, and library resources.' ),
		array( 'icon' => 'community', 'title' => 'Vibrant Community', 'text' => 'A diverse creative environment helps students collaborate and grow.' ),
	);
}

function kcid_contacts(): array {
	return array(
		'phone'     => '+254 797 888 111',
		'phone_alt' => '+254 791 888 111',
		'email'     => 'info@kencid.ac.ke',
		'address'   => '906 James Gichuru Road, Nairobi, Kenya',
		'license'   => 'TVETA/PRIVATE/TVC/0025/2019',
	);
}
