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
	$featured = array( 'interior-design', 'graphic-design', 'automotive-engineering', 'carpentry', 'artificial-intelligence', 'journalism' );

	return array_values(
		array_filter(
			kcid_catalog_programs(),
			static function ( array $program ) use ( $featured ): bool {
				return in_array( $program['slug'], $featured, true );
			}
		)
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
		'School of Building Sciences & Spatial Design',
		'School of Design, Creative & Performing Arts',
		'School of Engineering, Mobility & Manufacturing Technology',
		'School of Trades, Technical & Applied Technology',
		'School of Computing, Information & Digital Technology',
		'School of Media, Communication & Digital Content',
		'School of Business, Entrepreneurship & Management',
		'School of Hospitality, Tourism & Culinary Arts',
		'School of Health Sciences & Allied Health',
	);
}

function kcid_school_label( string $name ): string {
	return trim( (string) preg_replace( '/^School of\s+/i', '', $name ) );
}

function kcid_school_by_slug( string $slug ): ?array {
	$slug = sanitize_title( $slug );
	$legacy_slugs = array(
		'school-of-building-sciences' => 'school-of-building-sciences-spatial-design',
		'school-of-design' => 'school-of-design-creative-performing-arts',
		'school-of-engineering-automotive-design' => 'school-of-engineering-mobility-manufacturing-technology',
		'school-of-trades-technology' => 'school-of-trades-technical-applied-technology',
		'school-of-information-technology' => 'school-of-computing-information-digital-technology',
		'school-of-media-and-communication' => 'school-of-media-communication-digital-content',
		'school-of-business-management' => 'school-of-business-entrepreneurship-management',
		'school-of-hospitality-management' => 'school-of-hospitality-tourism-culinary-arts',
		'school-of-health-sciences' => 'school-of-health-sciences-allied-health',
	);
	$slug = $legacy_slugs[ $slug ] ?? $slug;

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
			'name' => 'School of Building Sciences & Spatial Design',
			'intro' => 'Shape the spaces, structures and environments where people live, work and belong.',
			'courses' => array( 'Interior Design', 'Interior Architecture', 'Architecture', 'Architectural Technology', 'Building Technology', 'Construction', 'Landscape Design', 'Urban Design', 'Spatial Planning', 'Facilities Management', 'Universal Design', 'Sustainable Design', 'BIM', 'Building Performance' ),
			'image' => 'kencid-source/school-building-sciences.jpg',
		),
		array(
			'name' => 'School of Design, Creative & Performing Arts',
			'intro' => 'Connect design, visual arts, fashion, digital creativity, entertainment and performance.',
			'courses' => array( 'Graphic Design', 'Product Design', 'Industrial Design', 'Furniture', 'Fashion', 'Textile', 'Jewellery', 'Illustration', 'Animation', 'Game Design', 'UX/UI', 'Web Design', 'AR/VR/XR', 'Fine Art', 'Sculpture', 'Acting', 'Theatre', 'Dance', 'Music', 'Vocal Performance', 'Set Design', 'Production Design' ),
			'image' => 'kencid-source/school-design.jpg',
		),
		array(
			'name' => 'School of Engineering, Mobility & Manufacturing Technology',
			'intro' => 'Apply engineering, mobility, manufacturing, automation and transportation thinking to real-world challenges.',
			'courses' => array( 'Automotive Engineering', 'Vehicle Design', 'Automotive Design', 'Bus Design', 'Motorcycle Design', 'Truck Design', 'Rail Vehicle Design', 'Marine & Boat Design', 'Transportation Design', 'Public Transport Design', 'Universal Transportation Design', 'Accessible Mobility', 'Electric Vehicles', 'Hybrid Vehicles', 'Micromobility', 'CAD/CAM', 'CNC', 'Digital Fabrication', 'Robotics', 'Automation', 'Smart Manufacturing' ),
			'image' => 'kencid-source/school-engineering.jpg',
		),
		array(
			'name' => 'School of Trades, Technical & Applied Technology',
			'intro' => 'Develop practical occupational and technical skills through applied learning.',
			'courses' => array( 'Carpentry', 'Joinery', 'Masonry', 'Plumbing', 'Electrical Installation', 'Welding', 'Fabrication', 'Painting', 'Tiling', 'Flooring', 'Ceiling Installation', 'Cabinet Making', 'Furniture Production', 'Solar Technology', 'Motor Vehicle Mechanics', 'CNC Machining', '3D Printing', 'Technical Digital Fabrication' ),
			'image' => 'courses-raster/welding-and-fabrication.webp',
		),
		array(
			'name' => 'School of Computing, Information & Digital Technology',
			'intro' => 'Prepare for the digital economy and emerging technology industries.',
			'courses' => array( 'Artificial Intelligence', 'Machine Learning', 'Data Science', 'Software Development', 'Cybersecurity', 'Cloud Computing', 'Networking', 'IoT', 'Digital Systems', 'Emerging Technologies' ),
			'image' => 'kencid-source/school-information-technology.jpg',
		),
		array(
			'name' => 'School of Media, Communication & Digital Content',
			'intro' => 'Create, communicate and distribute information across traditional and emerging media.',
			'courses' => array( 'Journalism', 'Radio', 'Television', 'Film', 'Photography', 'Videography', 'Documentary', 'Podcasting', 'Digital Content', 'Social Media', 'Advertising', 'Public Relations', 'Corporate Communication' ),
			'image' => 'kencid-source/school-media.jpeg',
		),
		array(
			'name' => 'School of Business, Entrepreneurship & Management',
			'intro' => 'Build and manage organisations, enterprises and professional opportunities.',
			'courses' => array( 'Entrepreneurship', 'Business Management', 'Marketing', 'Digital Marketing', 'Accounting', 'Finance', 'Human Resource Management', 'Procurement', 'Supply Chain', 'Project Management', 'Creative Enterprise', 'E-Commerce', 'Innovation' ),
			'image' => 'kencid-source/school-business.webp',
		),
		array(
			'name' => 'School of Hospitality, Tourism & Culinary Arts',
			'intro' => 'Prepare for hospitality, tourism, culinary, events and experience industries.',
			'courses' => array( 'Hospitality', 'Hotels', 'Restaurants', 'Culinary Arts', 'Baking', 'Pastry', 'Tourism', 'Travel', 'Events', 'Guest Experience', 'Hospitality Operations', 'Hospitality Entrepreneurship' ),
			'image' => 'kencid-source/school-hospitality-management.jpg',
		),
		array(
			'name' => 'School of Health Sciences & Allied Health',
			'intro' => 'Prepare competent professionals for health, wellness, community and allied-health environments.',
			'courses' => array( 'Community Health', 'Nutrition', 'Dietetics', 'Allied Health', 'Rehabilitation', 'Occupational Health', 'Orthopaedic Technology', 'Perioperative Technology', 'Pharmaceutical Sciences', 'Health Information', 'Digital Health' ),
			'image' => 'kencid-source/school-health-sciences.webp',
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
				'duration'      => 'Confirm with admissions',
				'mode'          => 'Subject to programme availability',
				'entry'         => 'Confirm current requirements with admissions',
				'qualification' => 'Programme area',
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
		array( 'icon' => 'cap', 'title' => 'Practical, Applied Learning', 'text' => 'Programme areas connect knowledge with making, testing, projects and real-world outcomes.' ),
		array( 'icon' => 'user', 'title' => 'Expert Faculty & Mentorship', 'text' => 'Students learn from seasoned professionals and creative practitioners.' ),
		array( 'icon' => 'tools', 'title' => 'Hands-On Learning', 'text' => 'Studios, workshops, models, material boards, and live projects shape each journey.' ),
		array( 'icon' => 'briefcase', 'title' => 'Practice & Enterprise', 'text' => 'Projects, industry engagement, professional practice and entrepreneurship turn competence into value.' ),
		array( 'icon' => 'globe', 'title' => 'Studios, Labs & Workshops', 'text' => 'Learners work across studios, laboratories, workshops and applied learning environments.' ),
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
