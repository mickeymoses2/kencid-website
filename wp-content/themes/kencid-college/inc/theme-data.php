<?php
/**
 * Static content for the KENCID exportable theme.
 *
 * @package KCIDCollege
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function kcid_programs(): array {
	return array(
		array( 'title' => 'Interior Design', 'school' => 'School of Building Sciences', 'slug' => 'interior-design', 'summary' => 'Plan residential and commercial spaces through drawing, materials, lighting, furniture, and client-led studio work.', 'tile' => 'tile-1' ),
		array( 'title' => 'Architecture', 'school' => 'School of Building Sciences', 'slug' => 'architecture', 'summary' => 'Build a design foundation in architectural drafting, model making, building systems, and sustainable spaces.', 'tile' => 'tile-2' ),
		array( 'title' => 'Fashion Design', 'school' => 'School of Design', 'slug' => 'fashion-design', 'summary' => 'Explore garment construction, textile choices, fashion illustration, styling, and creative entrepreneurship.', 'tile' => 'tile-3' ),
		array( 'title' => 'Graphic Design', 'school' => 'School of Design', 'slug' => 'graphic-design', 'summary' => 'Create strong visual identities, layouts, digital campaigns, and communication systems for modern brands.', 'tile' => 'tile-4' ),
		array( 'title' => 'Film & Cinematography', 'school' => 'School of Media and Communication', 'slug' => 'film-cinematography', 'summary' => 'Learn camera craft, visual storytelling, lighting, editing, and production workflows for screen media.', 'tile' => 'tile-5' ),
		array( 'title' => 'Construction Management', 'school' => 'School of Building Sciences', 'slug' => 'construction-management', 'summary' => 'Prepare for site coordination, project planning, safety, costing, and delivery in the built environment.', 'tile' => 'tile-6' ),
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
		'School of Trades and Technology',
	);
}

function kcid_course_catalog(): array {
	return array(
		array(
			'name' => 'School of Building Sciences',
			'intro' => 'Shape the spaces, structures, and places where people live and work.',
			'courses' => array( 'Interior Design', 'Architecture', 'Landscape Architecture', 'Urban Design', 'Quantity Survey', 'Construction Management', 'Building Technology', 'Preservation Design', 'Universal Design', 'Architectural History', 'Interior Architecture' ),
			'image' => 'school-building-sciences.png',
		),
		array(
			'name' => 'School of Design',
			'intro' => 'Turn ideas into visual, spatial, digital, and product experiences.',
			'courses' => array( 'Furniture Design', 'Accessory Design', 'Fashion Design', 'Jewelry Design and Metal Arts', 'Game Design and Development', 'Fiber & Textile Design', 'Graphic Design', 'Web Design and New Media', 'Interactive Media Design', 'Animation Design', 'Product Design', 'Motion Media Design', 'Industrial Design', 'User Experience Design and Research', 'Fashion Styling', 'Sneaker Design' ),
			'image' => 'school-design.png',
		),
		array(
			'name' => 'School of Media and Communication',
			'intro' => 'Build the craft and confidence to communicate through film, sound, and story.',
			'courses' => array( 'Cinema Studies', 'Communications', 'Film and TV', 'Visual Effects', 'Videography', 'Journalism and Media Studies', 'Set Design', 'Cinematography', 'Screenwriting', 'Writing and Directing for Film' ),
			'image' => 'school-media.png',
		),
		array(
			'name' => 'School of Information Technology',
			'intro' => 'Learn the digital tools and systems powering the creative economy.',
			'courses' => array( 'Information Technology', 'Business Information Technology', 'Computer Science', 'Software Development', 'Networking', 'Information Security', 'Web Development' ),
			'image' => 'school-information-technology.png',
		),
		array(
			'name' => 'School of Engineering & Automotive Design',
			'intro' => 'Combine technical thinking with the imagination to move products and mobility forward.',
			'courses' => array( 'Transportation Design', 'Electronic Design', 'Automotive Restoration', 'Automotive Design', 'Electrical Engineering', 'Structural Engineering', 'Mechanical Engineering' ),
			'image' => 'school-automotive-engineering.png',
		),
		array(
			'name' => 'School of Business Management',
			'intro' => 'Develop the strategy, leadership, and enterprise skills behind creative work.',
			'courses' => array( 'Advertising and Branding', 'Branded Entertainment', 'Business Management', 'Creative Business Leadership', 'Design Management', 'Fashion Marketing and Management', 'Business Innovation', 'Social Media Strategy and Management', 'Fashion and Visual Merchandising' ),
			'image' => 'school-business.png',
		),
		array(
			'name' => 'School of Creative & Performing Arts',
			'intro' => 'Make, perform, and tell stories that connect with audiences.',
			'courses' => array( 'Art Education', 'Acting', 'Dance', 'Vocal Performance', 'Creative Writing', 'Dramatic Writing', 'Ceramic Arts', 'Music', 'Painting', 'Photography', 'Sculpture', 'Television Production', 'Sound Design', 'Music Production', 'Drawing' ),
			'image' => 'school-creative-performing-arts.png',
		),
		array(
			'name' => 'School of Hospitality Management',
			'intro' => 'Prepare for guest experiences, operations, travel, and service leadership.',
			'courses' => array( 'Hotel & Restaurant Management', 'Tourism & Travel Management', 'Food & Beverage Management', 'Food Production Technician – Culinary Arts', 'Housekeeping and Accommodation Operations', 'Tour Operations', 'Tourism Marketing & Promotion', 'Front Office Operations' ),
			'image' => 'school-design.png',
		),
		array(
			'name' => 'School of Health Sciences',
			'intro' => 'Build practical skills for people-centred health and community services.',
			'courses' => array( 'Community Health Worker', 'Health Records and Information Technology', 'Human Nutrition and Dietetics', 'Perioperative Theatre Technology', 'Orthopedic Technology', 'Pharmacy', 'Clinical Medicine and Surgery', 'Occupational Therapy' ),
			'image' => 'school-health-sciences.png',
		),
		array(
			'name' => 'School of Trades & Technology',
			'intro' => 'Get hands-on with the technical skills that keep the built environment moving.',
			'courses' => array( 'Electrical and Electronic Engineering', 'Plumbing', 'Masonry', 'Tiling', 'Partitioning and Ceiling Installation', 'Auto Technician', 'Mechanical and Automotive Engineering', 'Welding and Fabrication', 'Automotive Engineering', 'Carpentry and Joinery' ),
			'image' => 'school-engineering.png',
		),
	);
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
