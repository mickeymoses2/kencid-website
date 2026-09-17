<?php
/**
 * Editorial course content sourced from the public KENCID course catalogue.
 *
 * The old catalogue uses one shared admissions pathway for every course. The
 * detailed copy below keeps course descriptions useful and scannable while
 * leaving intake dates, fees, and accreditation claims to the admissions team.
 *
 * @package KCIDCollege
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Course names that existed in older KENCID URLs but have a newer catalogue
 * name. These are resolved to the current page so old links remain useful.
 */
function kcid_course_aliases(): array {
	static $aliases = null;

	if ( null !== $aliases ) {
		return $aliases;
	}

	$aliases = array(
		'landscape-architecture-2'          => 'landscape-architecture',
		'urban-design-2'                    => 'urban-design',
		'construction-management-2'         => 'construction-management',
		'preservation-design-2'              => 'preservation-design',
		'universal-design-2'                 => 'universal-design',
		'architectural-history-2'             => 'architectural-history',
		'interior-architecture-2'            => 'interior-architecture',
		'jewelry-design-and-metal-arts-2'    => 'jewelry-design-and-metal-arts',
		'game-design'                       => 'game-design-and-development',
		'fiber-and-textile-design'           => 'fiber-textile-design',
		'interactive-design'                => 'interactive-media-design',
		'interactive-media-design-2'         => 'interactive-media-design',
		'user-experience-design-and-research-2' => 'user-experience-design-and-research',
		'industrial-design-2'                => 'industrial-design',
		'knitwear-design-2'                  => 'knitwear-design',
		'sneaker-design-2'                   => 'sneaker-design',
		'design-2'                           => 'design',
		'cinema-studies-2'                   => 'cinema-studies',
		'communications-2'                   => 'communications',
		'film-and-tv-2'                      => 'film-and-tv',
		'french-2'                           => 'french',
		'visual-effects-2'                   => 'visual-effects',
		'animation-and-visual-effects-2'     => 'animation-and-visual-effects',
		'journalism-media-studies'          => 'journalism-and-media-studies',
		'journalism-and-media-studies-2'     => 'journalism-and-media-studies',
		'writing-and-directing-for-film-2'   => 'writing-and-directing-for-film',
		'screenwriting-2'                    => 'screenwriting',
		'cinematography-2'                   => 'cinematography',
		'cyber-security'                    => 'cybersecurity',
		'social-media-management'           => 'social-media-management',
		'painting-2'                         => 'painting',
		'photography-2'                     => 'photography',
		'television-production-3'            => 'television-production',
		'sound-design-2'                    => 'sound-design',
		'music-production-2'                => 'music-production',
		'drawing-2'                          => 'drawing',
		'carpentry-and-joinery-2'            => 'carpentry-and-joinery',
		'community-health-worker-2'          => 'community-health-worker',
	);

	return $aliases;
}

/**
 * Shared admissions information from the old KENCID course page.
 */
function kcid_course_pathways(): array {
	static $pathways = null;

	if ( null !== $pathways ) {
		return $pathways;
	}

	$pathways = array(
		array(
			'label'      => 'Diploma program',
			'entry'      => 'KCSE C- or an accredited and recognized equivalent',
			'duration'   => '6 semesters',
			'credential' => 'Diploma',
		),
		array(
			'label'      => 'Certificate program',
			'entry'      => 'KCSE D or an accredited and recognized equivalent',
			'duration'   => '3 semesters',
			'credential' => 'Certificate',
		),
		array(
			'label'      => 'Foundation program',
			'entry'      => 'KCSE D- or an accredited and recognized equivalent',
			'duration'   => '2 semesters',
			'credential' => 'Foundation',
		),
	);

	return $pathways;
}

/**
 * Exact short descriptions available on the legacy KENCID courses page,
 * augmented with course-specific editorial detail for the course pages.
 */
function kcid_legacy_course_content(): array {
	static $content = null;

	if ( null !== $content ) {
		return $content;
	}

	$content = array(
		'Interior Design' => array(
			'summary'  => 'The art and science of enhancing the interior spaces of a building to achieve a more aesthetically pleasing and functional environment.',
			'overview' => 'Interior design brings together space planning, colour, materials, lighting, furniture, and human needs. At KENCID, students turn research and ideas into practical interior proposals for residential, commercial, hospitality, and public spaces.',
			'why'     => 'The course is a strong fit for creative learners who enjoy drawing, making, solving spatial problems, and communicating ideas visually. Studio projects help you build a portfolio while learning to balance beauty, function, safety, and context.',
			'learning' => array(
				array( 'title' => 'Design principles and space planning', 'text' => 'Use proportion, balance, colour, circulation, and human-centred thinking to shape functional interiors.' ),
				array( 'title' => 'Drawing and digital workflows', 'text' => 'Develop hand-drawing, technical drawing, CAD, presentation, and visualisation skills.' ),
				array( 'title' => 'Materials, furniture, and lighting', 'text' => 'Research finishes and furnishings, then make informed choices for atmosphere, performance, and durability.' ),
				array( 'title' => 'Professional practice', 'text' => 'Respond to briefs, communicate with clients, document proposals, and present a considered design solution.' ),
			),
			'careers' => array( 'Interior designer', 'Space planner', 'Design assistant', 'Set or exhibition designer', 'Freelance design consultant' ),
		),
		'Architecture' => array(
			'summary'  => 'The art of crafting buildings and physical structures to merge functionality with aesthetic beauty, shaping environments to fulfill human needs and desires.',
			'overview' => 'The Architecture course at KENCID blends artistic vision with scientific precision to shape tomorrow’s built environments. Learners engage with design theory, construction technology, environmental systems, urban planning, CAD modelling, site analysis, and studio-based projects.',
			'why'     => 'Located in Nairobi, the course connects architectural thinking with the realities of a growing city. Through mentorship, studio work, and critique, students learn to create responsible spaces that respond to culture, climate, users, and the built context.',
			'learning' => array(
				array( 'title' => 'Architectural design', 'text' => 'Explore briefs, spatial ideas, composition, and the process of developing a concept into a coherent proposal.' ),
				array( 'title' => 'Construction technology', 'text' => 'Understand materials, building systems, environmental considerations, and how design decisions affect construction.' ),
				array( 'title' => 'CAD and presentation', 'text' => 'Use drawings, models, digital tools, and clear visual communication to explain architectural solutions.' ),
				array( 'title' => 'Site and urban context', 'text' => 'Analyse place, movement, climate, culture, and community needs when developing a built-environment response.' ),
			),
			'careers' => array( 'Architectural assistant', 'CAD designer', 'Site supervisor', 'Project coordinator', 'Urban design consultant' ),
		),
		'Landscape Architecture' => array(
			'summary'  => 'Landscape architecture designs outdoor spaces like parks and gardens to blend with nature and fulfill human needs.',
			'overview' => 'Landscape Architecture explores the design of parks, gardens, public spaces, campuses, and other outdoor environments. Students learn to read a site, work with natural systems, and create places that are useful, resilient, and enjoyable.',
			'why'     => 'This course suits learners who are interested in the relationship between people, place, ecology, and design. It builds a practical foundation for shaping outdoor experiences in Nairobi and beyond.',
			'learning' => array(
				array( 'title' => 'Site analysis', 'text' => 'Read landform, climate, vegetation, movement, and community patterns before making design decisions.' ),
				array( 'title' => 'Planting and ecology', 'text' => 'Explore plant choices, ecological relationships, water, shade, and long-term landscape care.' ),
				array( 'title' => 'Outdoor space design', 'text' => 'Develop layouts for gardens, streetscapes, parks, and shared environments at different scales.' ),
				array( 'title' => 'Drawing and documentation', 'text' => 'Communicate landscape proposals using plans, sections, visual studies, models, and presentations.' ),
			),
			'careers' => array( 'Landscape designer', 'Landscape design assistant', 'Parks and public-space coordinator', 'Garden designer', 'Environmental design consultant' ),
		),
		'Construction Management' => array(
			'summary'  => 'Construction management is the field overseeing the entire lifecycle of a construction project, ensuring it’s built on time, within budget, and according to specifications.',
			'overview' => 'Construction Management prepares learners to coordinate the people, information, materials, costs, and timelines that move a project from brief to completion. The course brings together construction technology, estimating, site planning, safety, and project delivery.',
			'why'     => 'Kenya’s growing built environment needs people who can connect design intent with reliable delivery. Practical exercises and site-focused learning help students build confidence for work with contractors, consultants, developers, and project teams.',
			'learning' => array(
				array( 'title' => 'Building materials and systems', 'text' => 'Understand construction methods, materials, building services, and the sequence of work on site.' ),
				array( 'title' => 'Estimating and costing', 'text' => 'Develop an informed approach to quantities, budgets, procurement, and cost control.' ),
				array( 'title' => 'Site coordination', 'text' => 'Learn how programmes, teams, documentation, quality, and safety come together during delivery.' ),
				array( 'title' => 'Project communication', 'text' => 'Read drawings, report progress, manage information, and communicate with project stakeholders.' ),
			),
			'careers' => array( 'Site supervisor', 'Construction coordinator', 'Project assistant', 'Estimator', 'Construction entrepreneur' ),
		),
		'Preservation Design' => array(
			'summary'  => 'A multidisciplinary approach that aims to protect, conserve, and enhance the built environment, cultural heritage, and natural landscapes for present and future generations.',
			'overview' => 'Preservation Design connects design practice with the care of buildings, places, cultural heritage, and landscapes. Learners investigate context, document existing conditions, and develop sensitive proposals for repair, adaptation, and continued use.',
			'why'     => 'The course is for people who see value in the stories held by places. It develops a thoughtful approach to research, materials, community needs, and responsible change.',
			'learning' => array(
				array( 'title' => 'Heritage and context', 'text' => 'Research the historical, cultural, social, and environmental value of a place.' ),
				array( 'title' => 'Survey and documentation', 'text' => 'Record buildings and landscapes through measured drawings, photography, mapping, and written analysis.' ),
				array( 'title' => 'Materials and repair', 'text' => 'Explore material behaviour, conservation thinking, and compatible approaches to repair and adaptation.' ),
				array( 'title' => 'Adaptive reuse', 'text' => 'Balance continuity and change when developing a future use for an existing place.' ),
			),
			'careers' => array( 'Heritage design assistant', 'Conservation project assistant', 'Adaptive reuse designer', 'Site documentation specialist', 'Cultural-place consultant' ),
		),
		'Quantity Survey' => array(
			'summary'  => 'Managing the costs and finances of construction projects from inception to completion.',
			'overview' => 'Quantity Survey introduces the commercial and cost-management side of construction. Students learn how information from drawings, specifications, materials, and programmes becomes a reliable project budget.',
			'why'     => 'It suits organised, analytical learners who enjoy construction and want to understand how projects remain financially controlled from early idea through completion.',
			'learning' => array(
				array( 'title' => 'Measurement and quantities', 'text' => 'Read project information and develop a clear method for measuring work and materials.' ),
				array( 'title' => 'Cost planning', 'text' => 'Build budgets, compare options, and understand how design decisions influence cost.' ),
				array( 'title' => 'Procurement and contracts', 'text' => 'Explore tendering, procurement routes, documentation, and the responsibilities of project parties.' ),
				array( 'title' => 'Project reporting', 'text' => 'Communicate cost information in a way that supports better decisions throughout delivery.' ),
			),
			'careers' => array( 'Quantity survey assistant', 'Cost estimator', 'Commercial assistant', 'Procurement coordinator', 'Construction cost consultant' ),
		),
		'Graphic Design' => array(
			'summary'  => 'Visually communicating ideas and messages through the use of typography, imagery, and layout, with the aim of conveying information effectively.',
			'overview' => 'Graphic Design develops the visual thinking and making skills behind identities, publications, campaigns, digital content, and everyday communication. Students learn to move from research and concept to a clear, purposeful visual system.',
			'why'     => 'The course is a practical entry into the creative industry for learners who enjoy typography, image-making, digital tools, and solving communication problems with clarity.',
			'learning' => array(
				array( 'title' => 'Typography and layout', 'text' => 'Use type, hierarchy, grids, composition, and spacing to make information easy to understand.' ),
				array( 'title' => 'Identity and branding', 'text' => 'Translate a brand idea into a consistent visual language across different touchpoints.' ),
				array( 'title' => 'Digital production', 'text' => 'Develop confidence with image, illustration, layout, and presentation workflows.' ),
				array( 'title' => 'Creative process', 'text' => 'Research, generate, critique, refine, and present concepts through a portfolio of projects.' ),
			),
			'careers' => array( 'Graphic designer', 'Creative director', 'UX or UI designer', 'Production artist', 'Freelance visual designer' ),
		),
		'Transportation Design' => array(
			'summary'  => 'Creation and development of vehicles, ranging from automobiles to aircraft, with a focus on aesthetics, functionality, and user experience.',
			'overview' => 'Transportation Design explores how mobility products are imagined, shaped, communicated, and experienced. Learners combine visual research, form development, ergonomics, materials, and presentation to develop thoughtful vehicle concepts.',
			'why'     => 'It is a strong fit for people who are curious about movement, products, technology, and the future of mobility. The course builds a foundation in design thinking that can travel across automotive and product industries.',
			'learning' => array(
				array( 'title' => 'Form and proportion', 'text' => 'Study shape, volume, surface, proportion, and the visual language of mobility products.' ),
				array( 'title' => 'User-centred mobility', 'text' => 'Consider comfort, access, safety, behaviour, and the wider experience of moving through the world.' ),
				array( 'title' => 'Concept development', 'text' => 'Move from sketches and references to coherent design directions and resolved proposals.' ),
				array( 'title' => 'Visual communication', 'text' => 'Present design intent with drawings, models, digital studies, and clear storytelling.' ),
			),
			'careers' => array( 'Transportation designer', 'Automotive design assistant', 'Mobility product designer', 'Concept visualiser', 'Design researcher' ),
		),
		'Industrial Design' => array(
			'summary'  => 'Creating and developing products that are both functional and aesthetically pleasing, focusing on user experience, manufacturing processes, and market demands.',
			'overview' => 'Industrial Design combines creativity, technical knowledge, and problem solving to develop products, systems, and experiences. Students consider how an idea is used, made, communicated, and improved for real people and real contexts.',
			'why'     => 'The course is for curious makers who want to design objects that work well and feel meaningful. It creates a bridge between visual thinking, materials, technology, and enterprise.',
			'learning' => array(
				array( 'title' => 'Design research', 'text' => 'Observe users, identify opportunities, and turn insight into a well-framed design question.' ),
				array( 'title' => 'Form and function', 'text' => 'Develop products that balance usability, visual character, ergonomics, and context.' ),
				array( 'title' => 'Materials and making', 'text' => 'Explore material choices, prototyping, fabrication thinking, and how products can be made responsibly.' ),
				array( 'title' => 'Product communication', 'text' => 'Use sketches, models, digital tools, and presentations to explain and test a product idea.' ),
			),
			'careers' => array( 'Product designer', 'Automotive designer', 'Furniture designer', 'UX designer', 'Sustainable design consultant' ),
		),
		'Acting' => array(
			'summary'  => 'The art of embodying characters and conveying emotions, thoughts, and narratives through performance, utilizing various techniques to bring stories to life on stage, screen, or other media.',
			'overview' => 'Acting develops the performer’s instrument: body, voice, imagination, focus, and ability to listen. Learners explore character, scene work, improvisation, rehearsal, and the discipline needed to create truthful performances.',
			'why'     => 'The course supports beginners and developing performers who want a creative community, regular practice, and the confidence to take ideas from page to stage or screen.',
			'learning' => array(
				array( 'title' => 'Character and scene study', 'text' => 'Investigate text, intention, relationships, and action to build believable characters.' ),
				array( 'title' => 'Voice and movement', 'text' => 'Develop physical and vocal awareness for clear, expressive, and sustainable performance.' ),
				array( 'title' => 'Improvisation', 'text' => 'Build presence, spontaneity, collaboration, and confidence through structured play.' ),
				array( 'title' => 'Performance practice', 'text' => 'Rehearse, receive direction, work with an ensemble, and reflect on the audience experience.' ),
			),
			'careers' => array( 'Stage actor', 'Film or television actor', 'Voice actor', 'Commercial performer', 'Theatre production practitioner' ),
		),
		'Dance' => array(
			'summary'  => 'Artistic expression that involves rhythmic movement of the body, often accompanied by music, to convey emotions, tell stories, or simply celebrate the joy of movement.',
			'overview' => 'Dance builds technique, musicality, physical awareness, creative expression, and performance confidence. Learners explore movement vocabulary and the collaborative discipline of creating and presenting work.',
			'why'     => 'Whether you are beginning or returning to dance, the course offers a structured way to develop your body, your creative voice, and your ability to work with others.',
			'learning' => array(
				array( 'title' => 'Technique and conditioning', 'text' => 'Build alignment, strength, coordination, flexibility, and control through regular practice.' ),
				array( 'title' => 'Musicality and rhythm', 'text' => 'Respond to timing, phrasing, dynamics, and the relationship between music and movement.' ),
				array( 'title' => 'Choreography', 'text' => 'Generate, structure, remember, and refine movement for individual and ensemble work.' ),
				array( 'title' => 'Performance', 'text' => 'Develop stage presence, rehearsal habits, collaboration, and reflective practice.' ),
			),
			'careers' => array( 'Professional dancer', 'Choreographer', 'Dance teacher', 'Dance fitness instructor', 'Dance company practitioner' ),
		),
		'Vocal Performance' => array(
			'summary'  => 'The art of using one’s voice to convey emotions, tell stories, and express musicality, encompassing a range of techniques, styles, and genres to captivate audiences.',
			'overview' => 'Vocal Performance helps singers understand, strengthen, and express the voice. The course combines technique, repertoire, interpretation, musicianship, stage presence, and the habits needed for consistent performance.',
			'why'     => 'It is designed for learners who want to grow as soloists, ensemble singers, recording artists, or vocal educators while developing a confident and healthy practice.',
			'learning' => array(
				array( 'title' => 'Vocal technique', 'text' => 'Explore breath, resonance, articulation, range, and healthy habits for a sustainable voice.' ),
				array( 'title' => 'Repertoire and interpretation', 'text' => 'Choose, learn, and interpret songs across styles with attention to text, phrasing, and intention.' ),
				array( 'title' => 'Musicianship', 'text' => 'Build listening, rhythm, pitch, sight-reading, and ensemble skills that support performance.' ),
				array( 'title' => 'Stage and studio practice', 'text' => 'Prepare for live performance, recording, feedback, and professional collaboration.' ),
			),
			'careers' => array( 'Professional singer', 'Vocal coach', 'Session vocalist', 'Choral director', 'Recording artist' ),
		),
		'Sneaker Design' => array(
			'summary'  => 'The creative process of conceptualizing and developing athletic footwear, combining elements of fashion, functionality, and technological innovation to create shoes.',
			'overview' => 'Sneaker Design explores the relationship between footwear, movement, identity, and culture. Learners develop concepts with attention to fit, construction, materials, visual language, and the story a product tells.',
			'why'     => 'The course is for fashion and product-minded creatives who want to work at the meeting point of sport, street culture, technology, and design.',
			'learning' => array(
				array( 'title' => 'Footwear form and function', 'text' => 'Understand proportion, fit, comfort, movement, and the performance needs of a sneaker.' ),
				array( 'title' => 'Materials and construction', 'text' => 'Research textiles, leather, rubber, trims, and construction approaches for footwear.' ),
				array( 'title' => 'Concept and storytelling', 'text' => 'Build a visual direction from cultural references, user insight, and a clear product idea.' ),
				array( 'title' => 'Presentation and development', 'text' => 'Communicate designs through sketches, colourways, technical details, and product mock-ups.' ),
			),
			'careers' => array( 'Sneaker designer', 'Footwear designer', 'Product designer', 'Fashion illustrator', 'Footwear product developer' ),
		),
		'Electronic Design' => array(
			'summary'  => 'Conceptualizing, designing, and developing electronic systems, circuits, and components, incorporating principles of electrical engineering, computer science, and physics.',
			'overview' => 'Electronic Design introduces the thinking behind circuits, components, systems, and useful electronic products. Learners connect theory with practical problem solving, testing, documentation, and responsible making.',
			'why'     => 'It suits technically curious students who enjoy understanding how things work and want a foundation for building, testing, and communicating electronic solutions.',
			'learning' => array(
				array( 'title' => 'Circuit principles', 'text' => 'Build an understanding of components, current, voltage, signals, and basic circuit behaviour.' ),
				array( 'title' => 'Design and prototyping', 'text' => 'Move from a problem to a circuit concept, prototype, test, and considered improvement.' ),
				array( 'title' => 'Digital systems', 'text' => 'Explore the relationship between electronics, control, computation, and connected devices.' ),
				array( 'title' => 'Technical documentation', 'text' => 'Read diagrams, record tests, communicate decisions, and work safely with equipment.' ),
			),
			'careers' => array( 'Electronics technician', 'Electronic design assistant', 'Systems support technician', 'Product prototyping assistant', 'Technical entrepreneur' ),
		),
		'Electrical Engineering' => array(
			'summary'  => 'The study, design, and application of electrical systems and devices, encompassing areas such as power generation and distribution.',
			'overview' => 'Electrical Engineering builds a foundation in the systems that generate, distribute, control, and use electrical energy. Learners develop practical technical awareness alongside the analytical thinking needed for safe and reliable work.',
			'why'     => 'The course connects directly to the infrastructure and technology that power homes, businesses, construction, mobility, and industry across Kenya.',
			'learning' => array(
				array( 'title' => 'Electrical principles', 'text' => 'Understand current, voltage, power, circuits, measurement, and the behaviour of electrical systems.' ),
				array( 'title' => 'Installation and safety', 'text' => 'Develop careful working practices for electrical components, tools, testing, and safe installation.' ),
				array( 'title' => 'Power and control', 'text' => 'Explore generation, distribution, control, and the role of electrical systems in the built environment.' ),
				array( 'title' => 'Technical problem solving', 'text' => 'Read diagrams, diagnose faults, document work, and communicate practical solutions.' ),
			),
			'careers' => array( 'Electrical engineering assistant', 'Electrical technician', 'Installation technician', 'Maintenance technician', 'Electrical services entrepreneur' ),
		),
		'Mechanical Engineering' => array(
			'summary'  => 'The design, analysis, and manufacturing of mechanical systems and components, encompassing topics such as machine design, thermodynamics, and fluid mechanics.',
			'overview' => 'Mechanical Engineering explores the machines, mechanisms, materials, and energy systems that make products and equipment work. Students develop a practical understanding of how mechanical ideas are analysed, built, tested, and improved.',
			'why'     => 'This is a foundation for learners who are interested in tools, machines, mobility, manufacturing, and the physical principles behind everyday systems.',
			'learning' => array(
				array( 'title' => 'Mechanics and materials', 'text' => 'Explore forces, motion, material behaviour, and the principles behind reliable mechanical systems.' ),
				array( 'title' => 'Machine elements', 'text' => 'Understand the role of components, mechanisms, tolerances, and assembly in a working product.' ),
				array( 'title' => 'Energy and movement', 'text' => 'Build an introductory understanding of thermodynamics, fluids, and the transfer of energy.' ),
				array( 'title' => 'Making and testing', 'text' => 'Use drawings, tools, prototypes, measurement, and documentation to develop and evaluate ideas.' ),
			),
			'careers' => array( 'Mechanical engineering assistant', 'Maintenance technician', 'Manufacturing technician', 'Machine design assistant', 'Technical entrepreneur' ),
		),
		'Structural Engineering' => array(
			'summary'  => 'Designing and analyzing structures, covering topics such as structural analysis, mechanics of materials, structural design codes, and advanced structural systems.',
			'overview' => 'Structural Engineering introduces the systems that help buildings and other structures stand, perform, and remain safe. Learners connect loads, materials, form, analysis, and clear technical communication.',
			'why'     => 'The course is suited to analytical learners who want to understand the relationship between architectural ideas, engineering judgement, construction, and public safety.',
			'learning' => array(
				array( 'title' => 'Forces and structural behaviour', 'text' => 'Explore loads, equilibrium, reactions, movement, and how structures respond to use and environment.' ),
				array( 'title' => 'Materials and systems', 'text' => 'Study the characteristics and applications of common structural materials and systems.' ),
				array( 'title' => 'Analysis and design thinking', 'text' => 'Use structured methods to interpret structural problems and develop responsible solutions.' ),
				array( 'title' => 'Technical communication', 'text' => 'Read and produce clear diagrams, calculations, drawings, and project documentation.' ),
			),
			'careers' => array( 'Structural engineering assistant', 'CAD technician', 'Site engineering assistant', 'Technical coordinator', 'Construction project assistant' ),
		),
		'Automotive Restoration' => array(
			'summary'  => 'Involves restoring vintage or classic vehicles to their original or improved condition through meticulous refurbishment and repairs.',
			'overview' => 'Automotive Restoration combines vehicle history, diagnosis, repair, fabrication, finishing, and patient craftsmanship. Learners understand how to assess an existing vehicle and plan a restoration that respects its character while making it usable again.',
			'why'     => 'It is a hands-on route for people who enjoy vehicles, tools, materials, detail, and the satisfaction of bringing something with a story back to life.',
			'learning' => array(
				array( 'title' => 'Vehicle assessment', 'text' => 'Inspect condition, identify systems, research a vehicle’s history, and plan a realistic restoration.' ),
				array( 'title' => 'Mechanical systems', 'text' => 'Develop an understanding of engines, running gear, electrical systems, and practical fault finding.' ),
				array( 'title' => 'Bodywork and finishes', 'text' => 'Explore preparation, repair, surface work, materials, and finishing with care and precision.' ),
				array( 'title' => 'Workshop practice', 'text' => 'Work safely, organise tools and parts, document progress, and collaborate on a complex project.' ),
			),
			'careers' => array( 'Automotive restoration technician', 'Vehicle repair technician', 'Classic car workshop assistant', 'Automotive detailer', 'Restoration entrepreneur' ),
		),
		'Business Management' => array(
			'summary'  => 'Equips students with essential knowledge and skills in areas such as organizational behavior, marketing, finance, operations, and strategic management, preparing them to lead and succeed in a variety of business environments and industries.',
			'overview' => 'The Business Management course at KENCID shapes future leaders and entrepreneurs with a foundation in marketing, finance, human resources, operations, entrepreneurship, and strategic management. Students connect classroom ideas with practical business situations.',
			'why'     => 'Business skills travel across every industry. The course is useful for school leavers, career changers, and creative practitioners who want to lead teams, make informed decisions, or start and grow an enterprise.',
			'learning' => array(
				array( 'title' => 'Business foundations', 'text' => 'Understand how organisations create value through people, customers, operations, finance, and strategy.' ),
				array( 'title' => 'Marketing and customers', 'text' => 'Explore positioning, communication, customer insight, and the decisions behind a strong market offer.' ),
				array( 'title' => 'People and leadership', 'text' => 'Build practical awareness of teamwork, organisational behaviour, leadership, and responsible decision making.' ),
				array( 'title' => 'Entrepreneurship and operations', 'text' => 'Develop ideas, plan delivery, manage resources, and understand the realities of running a business.' ),
			),
			'careers' => array( 'Business analyst', 'Marketing executive', 'Operations manager', 'Sales manager', 'Entrepreneur' ),
		),
		'Design Management' => array(
			'summary'  => 'Combines design thinking, business strategy, and project management to effectively harness the power of design within organizations, ensuring alignment between creative endeavors and overarching business objectives while facilitating innovation and driving competitive advantage.',
			'overview' => 'Design Management develops the ability to guide creative work from opportunity to outcome. Learners connect design thinking, strategy, teams, budgets, communication, and delivery across organisations.',
			'why'     => 'This course suits people who enjoy both creative ideas and the practical work of making them happen. It is a bridge between designers, clients, leaders, and communities.',
			'learning' => array(
				array( 'title' => 'Design strategy', 'text' => 'Frame opportunities, understand users, and connect design decisions to meaningful organisational goals.' ),
				array( 'title' => 'Project planning', 'text' => 'Scope work, coordinate resources, set milestones, and keep a creative project moving.' ),
				array( 'title' => 'Teams and communication', 'text' => 'Facilitate collaboration, give direction, and communicate across creative and business disciplines.' ),
				array( 'title' => 'Innovation and value', 'text' => 'Use design thinking to support better products, services, experiences, and sustainable business choices.' ),
			),
			'careers' => array( 'Design manager', 'Creative project coordinator', 'Brand strategist', 'Innovation consultant', 'Design operations assistant' ),
		),
		'Advertising and Branding' => array(
			'summary'  => 'Involves creating compelling narratives and visual identities to communicate brand messages effectively.',
			'overview' => 'Advertising and Branding explores how ideas become memorable campaigns and coherent identities. Students learn to understand an audience, shape a message, develop a creative direction, and communicate it across media.',
			'why'     => 'The course is made for strategic and imaginative learners who want to work with words, images, brands, culture, and the fast-moving world of communication.',
			'learning' => array(
				array( 'title' => 'Brand thinking', 'text' => 'Explore positioning, values, tone, identity, and the choices that make a brand recognisable.' ),
				array( 'title' => 'Campaign development', 'text' => 'Turn insight into a strong concept, message, visual direction, and campaign system.' ),
				array( 'title' => 'Creative production', 'text' => 'Develop copy, layouts, visual assets, presentations, and content for different channels.' ),
				array( 'title' => 'Audience and strategy', 'text' => 'Read context, understand people, and evaluate whether communication is clear and purposeful.' ),
			),
			'careers' => array( 'Advertising creative', 'Brand strategist', 'Copywriter', 'Art director', 'Marketing communications specialist' ),
		),
		'Public Relations' => array(
			'summary'  => 'Public relations manages communication to shape a positive public image and foster trust between organizations and stakeholders.',
			'overview' => 'Public Relations develops the communication skills needed to build trust, protect reputation, and create useful relationships between organisations and their audiences. Learners explore messages, media, events, digital channels, and communication planning.',
			'why'     => 'It suits confident listeners and clear communicators who enjoy people, current affairs, storytelling, organisation, and the responsibility of representing an organisation well.',
			'learning' => array(
				array( 'title' => 'Communication planning', 'text' => 'Set objectives, understand audiences, shape messages, and choose appropriate channels.' ),
				array( 'title' => 'Media and storytelling', 'text' => 'Write releases, prepare media materials, and present information with clarity and accuracy.' ),
				array( 'title' => 'Events and engagement', 'text' => 'Plan experiences and touchpoints that help organisations build real relationships with people.' ),
				array( 'title' => 'Reputation and ethics', 'text' => 'Think critically about trust, transparency, issues, crisis communication, and responsible practice.' ),
			),
			'careers' => array( 'Public relations assistant', 'Communications officer', 'Media relations coordinator', 'Events coordinator', 'Community engagement officer' ),
		),
		'Journalism and Media Studies' => array(
			'summary'  => 'Analysing and reporting on news events and media content, exploring their societal impact, and studying the principles and practices of mass communication.',
			'overview' => 'Journalism and Media Studies builds the habits of research, verification, interviewing, writing, editing, and critical media analysis. Students learn how stories are made, circulated, and understood in society.',
			'why'     => 'The course is for curious people who want to ask better questions, understand the world around them, and communicate information responsibly across print, digital, audio, and video formats.',
			'learning' => array(
				array( 'title' => 'Research and reporting', 'text' => 'Find, verify, organise, and explain information from people, documents, places, and data.' ),
				array( 'title' => 'Writing and editing', 'text' => 'Build a clear voice, accurate structure, strong headlines, and careful editing habits.' ),
				array( 'title' => 'Media production', 'text' => 'Explore photography, audio, video, digital publishing, and the practical workflow of a story.' ),
				array( 'title' => 'Media and society', 'text' => 'Analyse representation, power, audiences, ethics, and the impact of media on public life.' ),
			),
			'careers' => array( 'Journalist', 'Reporter', 'Editor', 'Content producer', 'Digital media specialist' ),
		),
		'Videography' => array(
			'summary'  => 'Capturing, editing, and producing video content for various purposes, including storytelling, entertainment, marketing, and documentation.',
			'overview' => 'Videography develops the craft of planning, capturing, shaping, and delivering moving images. Learners work with camera, light, sound, composition, editing, and the storytelling choices that give a video purpose.',
			'why'     => 'The course gives aspiring creators a practical foundation for content, documentary, events, marketing, social media, and independent production work.',
			'learning' => array(
				array( 'title' => 'Camera and composition', 'text' => 'Use framing, focus, movement, exposure, and visual rhythm to capture purposeful footage.' ),
				array( 'title' => 'Story and pre-production', 'text' => 'Turn a brief into research, treatment, storyboard, shot list, schedule, and a workable plan.' ),
				array( 'title' => 'Sound and lighting', 'text' => 'Understand the role of clean sound and intentional light in a credible moving-image piece.' ),
				array( 'title' => 'Editing and delivery', 'text' => 'Select, structure, edit, finish, and export video for the audience and platform it serves.' ),
			),
			'careers' => array( 'Videographer', 'Video editor', 'Camera assistant', 'Content producer', 'Freelance filmmaker' ),
		),
		'Photography' => array(
			'summary'  => 'Mastering camera settings and composition principles to understanding lighting techniques and post-processing.',
			'overview' => 'Photography develops the technical control and visual judgement needed to make meaningful images. Students explore camera craft, light, composition, editing, image ethics, and the discipline of building a body of work.',
			'why'     => 'It is a useful foundation for people who want to work with portraits, products, spaces, events, documentary, fashion, or their own creative practice.',
			'learning' => array(
				array( 'title' => 'Camera craft', 'text' => 'Build confidence with exposure, focus, lenses, depth, movement, and the relationship between settings and intent.' ),
				array( 'title' => 'Light and composition', 'text' => 'Shape images through available and controlled light, framing, colour, space, and timing.' ),
				array( 'title' => 'Genres and visual stories', 'text' => 'Work across briefs while developing a point of view and a responsible approach to subjects.' ),
				array( 'title' => 'Editing and portfolio', 'text' => 'Select, process, sequence, present, and discuss images as a coherent body of work.' ),
			),
			'careers' => array( 'Photographer', 'Photo assistant', 'Product photographer', 'Fashion photographer', 'Image editor' ),
		),
		'Social Media Management' => array(
			'summary'  => 'Overseeing a brand’s online presence across platforms, aiming to engage audiences, boost brand awareness, and achieve marketing objectives.',
			'overview' => 'Social Media Management turns communication strategy into consistent, useful, and engaging digital activity. Learners explore audiences, content planning, platform formats, community, analytics, and the day-to-day discipline behind a strong online presence.',
			'why'     => 'The course suits organised, creative communicators who want to work with brands, communities, campaigns, content, and measurable digital outcomes.',
			'learning' => array(
				array( 'title' => 'Content strategy', 'text' => 'Understand audiences, objectives, themes, formats, calendars, and the role of each platform.' ),
				array( 'title' => 'Content creation', 'text' => 'Develop copy, images, short video, layouts, and stories that are clear, useful, and on-brand.' ),
				array( 'title' => 'Community and reputation', 'text' => 'Respond to people, build relationships, and handle online communication with care and consistency.' ),
				array( 'title' => 'Analytics and optimisation', 'text' => 'Read performance signals, learn from results, and improve future content and campaigns.' ),
			),
			'careers' => array( 'Social media manager', 'Content strategist', 'Community manager', 'Digital marketing assistant', 'Social media entrepreneur' ),
		),
		'Information Technology' => array(
			'summary'  => 'Involves using computer systems and software to manage and process data for communication, decision-making, and automation.',
			'overview' => 'Information Technology introduces the systems, software, networks, data, and support practices that keep organisations working. Learners build practical digital confidence while developing a problem-solving approach to technology.',
			'why'     => 'IT skills are useful in almost every modern workplace. This course suits learners who enjoy troubleshooting, learning new tools, and helping people use technology well.',
			'learning' => array(
				array( 'title' => 'Computer systems', 'text' => 'Understand hardware, operating systems, software, data, and the way digital tools support work.' ),
				array( 'title' => 'Networks and support', 'text' => 'Explore connectivity, user support, setup, maintenance, and the habits of reliable technical service.' ),
				array( 'title' => 'Data and productivity', 'text' => 'Use digital tools to organise information, communicate clearly, and support everyday decisions.' ),
				array( 'title' => 'Professional practice', 'text' => 'Develop documentation, troubleshooting, security awareness, and responsible technology habits.' ),
			),
			'careers' => array( 'IT support technician', 'Systems assistant', 'Network support assistant', 'ICT officer', 'Technology services entrepreneur' ),
		),
		'Cybersecurity' => array(
			'summary'  => 'Involves protecting computer systems, networks, and data from unauthorized access, breaches, and cyber threats through the implementation of security measures and protocols.',
			'overview' => 'Cybersecurity introduces the principles behind protecting systems, information, people, and organisations. Students build awareness of threats, access, networks, safe practice, incident thinking, and the shared responsibility of digital security.',
			'why'     => 'As more services and businesses move online, organisations need people who can spot risk, communicate clearly, and support safer digital environments.',
			'learning' => array(
				array( 'title' => 'Security foundations', 'text' => 'Understand threats, vulnerabilities, access, identity, privacy, and the role of policy and good practice.' ),
				array( 'title' => 'Networks and systems', 'text' => 'Explore how devices and networks connect, where risk appears, and how systems are monitored.' ),
				array( 'title' => 'Safe digital behaviour', 'text' => 'Develop practical habits for protecting accounts, data, devices, and the people who use them.' ),
				array( 'title' => 'Incident awareness', 'text' => 'Learn to recognise, document, communicate, and respond to common security concerns responsibly.' ),
			),
			'careers' => array( 'Cybersecurity support assistant', 'IT security technician', 'Systems support assistant', 'Compliance assistant', 'Security awareness coordinator' ),
		),
		'Software Development' => array(
			'summary'  => 'Entails designing, creating, and maintaining computer programs and applications to meet specific user needs and requirements.',
			'overview' => 'Software Development builds the problem-solving habits behind useful digital products. Learners move from understanding a need to planning, building, testing, improving, and explaining a working application.',
			'why'     => 'The course is for people who enjoy logic, creativity, systems, and making tools that help others. It provides a foundation for further technical study and entry-level development work.',
			'learning' => array(
				array( 'title' => 'Programming foundations', 'text' => 'Develop core ideas in logic, variables, data, control flow, functions, and readable code.' ),
				array( 'title' => 'Web and application thinking', 'text' => 'Explore how interfaces, services, data, and user needs fit together in a digital product.' ),
				array( 'title' => 'Testing and debugging', 'text' => 'Learn to inspect behaviour, find problems, test assumptions, and improve a solution methodically.' ),
				array( 'title' => 'Projects and collaboration', 'text' => 'Plan work, use versioned practice, document decisions, and present a working result.' ),
			),
			'careers' => array( 'Junior software developer', 'Web developer', 'QA or testing assistant', 'Application support assistant', 'Freelance developer' ),
		),
	);

	return $content;
}

/**
 * School-level defaults make every catalogue entry useful even when the old
 * page only supplied a one-line course definition.
 */
function kcid_school_course_defaults( string $title, string $school ): array {
	$defaults = array(
		'School of Building Sciences' => array(
			'summary' => 'Explore the principles, tools, and practices behind ' . $title . ' in the built environment.',
			'overview' => $title . ' at KENCID develops practical understanding of the people, places, materials, systems, and decisions that shape the built environment. Learners move from research and drawing to clear proposals, documentation, and real-world problem solving.',
			'why' => 'The course is designed for learners who want to understand how the built environment works and contribute to better places through careful observation, technical skill, and creative thinking.',
			'learning' => array(
				array( 'title' => 'Foundations and context', 'text' => 'Build a clear understanding of the principles, history, people, and places connected to the discipline.' ),
				array( 'title' => 'Drawing and documentation', 'text' => 'Communicate ideas with sketches, technical drawings, digital tools, models, and presentations.' ),
				array( 'title' => 'Materials and systems', 'text' => 'Explore the materials, technologies, processes, and constraints that shape a responsible outcome.' ),
				array( 'title' => 'Projects and practice', 'text' => 'Apply learning to briefs, critique, site awareness, teamwork, and a growing portfolio.' ),
			),
			'careers' => array( $title . ' assistant', 'Design or project coordinator', 'Technical assistant', 'Site or studio practitioner', 'Independent consultant' ),
		),
		'School of Design' => array(
			'summary' => 'Develop a practical design practice through research, making, visual communication, and project work in ' . $title . '.',
			'overview' => 'The ' . $title . ' course at KENCID turns ideas into considered visual, digital, spatial, or product experiences. Students develop a point of view through research, experimentation, critique, making, and presentation.',
			'why' => 'It suits curious makers who want to grow their creative voice while learning the discipline, tools, and communication skills needed to work with clients, teams, and audiences.',
			'learning' => array(
				array( 'title' => 'Research and ideas', 'text' => 'Observe culture, people, materials, and references to frame a useful design opportunity.' ),
				array( 'title' => 'Form and making', 'text' => 'Experiment with composition, material, colour, process, and technique to develop a clear direction.' ),
				array( 'title' => 'Digital workflows', 'text' => 'Use relevant design tools to develop, refine, document, and present your work.' ),
				array( 'title' => 'Portfolio and practice', 'text' => 'Respond to briefs, receive critique, work with others, and communicate outcomes with confidence.' ),
			),
			'careers' => array( $title . ' designer', 'Design assistant', 'Creative producer', 'Visual or product developer', 'Freelance creative practitioner' ),
		),
		'School of Media and Communication' => array(
			'summary' => 'Build the craft of communicating through image, sound, story, and audience-aware production in ' . $title . '.',
			'overview' => $title . ' at KENCID develops the creative, technical, and editorial skills behind purposeful media. Learners research, plan, produce, critique, and refine work for real audiences and changing platforms.',
			'why' => 'The course is for people who are curious about stories, culture, technology, and the ways media can inform, move, and connect people.',
			'learning' => array(
				array( 'title' => 'Story and audience', 'text' => 'Understand purpose, audience, context, structure, and the choices that make communication meaningful.' ),
				array( 'title' => 'Production craft', 'text' => 'Develop practical skills with the tools, workflows, formats, and techniques used in the discipline.' ),
				array( 'title' => 'Editing and refinement', 'text' => 'Select, shape, edit, and improve work through feedback, attention to detail, and critical judgement.' ),
				array( 'title' => 'Professional projects', 'text' => 'Plan briefs, collaborate, manage files and deadlines, and present a portfolio of finished work.' ),
			),
			'careers' => array( $title . ' practitioner', 'Content producer', 'Production assistant', 'Editor or communications assistant', 'Independent media creator' ),
		),
		'School of Information Technology' => array(
			'summary' => 'Build practical digital skills and problem-solving confidence for the systems and services behind ' . $title . '.',
			'overview' => $title . ' at KENCID develops a practical understanding of digital tools, systems, information, and the people who use them. Learners connect concepts with projects, troubleshooting, documentation, and responsible technology practice.',
			'why' => 'Technology touches every sector. This course is for learners who enjoy solving problems, learning how systems work, and creating or supporting useful digital experiences.',
			'learning' => array(
				array( 'title' => 'Core concepts', 'text' => 'Build a clear foundation in the principles, tools, and vocabulary of the discipline.' ),
				array( 'title' => 'Applied problem solving', 'text' => 'Break down needs, test ideas, diagnose issues, and make improvements methodically.' ),
				array( 'title' => 'Digital practice', 'text' => 'Use relevant software, systems, tools, and documentation to complete practical work.' ),
				array( 'title' => 'Responsible technology', 'text' => 'Consider privacy, security, accessibility, reliability, teamwork, and the people affected by technology.' ),
			),
			'careers' => array( $title . ' assistant', 'IT support technician', 'Systems or data assistant', 'Digital services coordinator', 'Technology entrepreneur' ),
		),
		'School of Engineering & Automotive Design' => array(
			'summary' => 'Combine technical reasoning, practical making, and design thinking to understand ' . $title . '.',
			'overview' => $title . ' at KENCID connects technical principles with hands-on problem solving. Learners explore how materials, systems, tools, safety, measurement, and clear documentation turn an idea into something that works.',
			'why' => 'It is a useful foundation for technically curious students who enjoy understanding systems, working with tools, and contributing to products, vehicles, infrastructure, or industry.',
			'learning' => array(
				array( 'title' => 'Technical foundations', 'text' => 'Understand the principles, materials, components, and vocabulary that define the discipline.' ),
				array( 'title' => 'Workshop and practical skills', 'text' => 'Build safe, organised habits through tools, measurement, prototypes, testing, and repair or fabrication work.' ),
				array( 'title' => 'Systems and problem solving', 'text' => 'Analyse how parts work together, diagnose problems, and develop considered improvements.' ),
				array( 'title' => 'Technical communication', 'text' => 'Read and create drawings, diagrams, reports, and project records that help a team work well.' ),
			),
			'careers' => array( $title . ' assistant', 'Technical or workshop technician', 'Maintenance assistant', 'CAD or project assistant', 'Independent technical practitioner' ),
		),
		'School of Business Management' => array(
			'summary' => 'Develop the strategy, communication, leadership, and enterprise skills behind ' . $title . '.',
			'overview' => $title . ' at KENCID builds practical business awareness for a changing economy. Learners connect customers, communication, people, operations, strategy, and responsible decision making through relevant projects.',
			'why' => 'Business and communication skills are useful in creative organisations, growing enterprises, public service, NGOs, and established companies across Kenya and beyond.',
			'learning' => array(
				array( 'title' => 'People and audiences', 'text' => 'Understand the needs, motivations, relationships, and contexts that shape effective business practice.' ),
				array( 'title' => 'Strategy and communication', 'text' => 'Frame objectives, develop messages, and connect day-to-day decisions to a wider direction.' ),
				array( 'title' => 'Planning and delivery', 'text' => 'Organise projects, manage resources, work with teams, and follow through on commitments.' ),
				array( 'title' => 'Enterprise and ethics', 'text' => 'Explore value, innovation, responsibility, and the habits behind sustainable professional practice.' ),
			),
			'careers' => array( $title . ' assistant', 'Marketing or communications officer', 'Business development assistant', 'Project coordinator', 'Entrepreneur' ),
		),
		'School of Creative & Performing Arts' => array(
			'summary' => 'Develop a disciplined creative practice through making, performance, research, and communication in ' . $title . '.',
			'overview' => $title . ' at KENCID gives learners time to practise, experiment, receive feedback, and build a distinctive creative voice. The course balances technique, imagination, reflection, collaboration, and the realities of presenting work to an audience.',
			'why' => 'It is for people who want to turn curiosity into craft and grow within a supportive creative community that values both expression and professional discipline.',
			'learning' => array(
				array( 'title' => 'Foundations and technique', 'text' => 'Build the core methods, vocabulary, and habits that support confident creative work.' ),
				array( 'title' => 'Ideas and expression', 'text' => 'Develop concepts, explore references, and make choices that communicate a clear point of view.' ),
				array( 'title' => 'Practice and critique', 'text' => 'Rehearse or make regularly, receive feedback, reflect, and improve through iteration.' ),
				array( 'title' => 'Presentation and portfolio', 'text' => 'Prepare work for audiences, collaborators, opportunities, and the next stage of your creative journey.' ),
			),
			'careers' => array( $title . ' practitioner', 'Creative producer', 'Teacher or facilitator', 'Arts administrator', 'Independent creative entrepreneur' ),
		),
		'School of Hospitality Management' => array(
			'summary' => 'Build practical service, operations, guest-experience, and leadership skills for ' . $title . '.',
			'overview' => $title . ' at KENCID develops the practical and professional habits behind memorable guest experiences and well-run hospitality operations. Learners connect service, people, standards, planning, and commercial awareness.',
			'why' => 'Hospitality rewards people who are observant, organised, warm, adaptable, and committed to doing the details well. The course provides a foundation for work across hotels, restaurants, travel, events, and related services.',
			'learning' => array(
				array( 'title' => 'Service and guest experience', 'text' => 'Understand the choices, standards, communication, and care that shape a positive guest journey.' ),
				array( 'title' => 'Operations and teamwork', 'text' => 'Plan tasks, coordinate people, manage information, and keep service moving smoothly.' ),
				array( 'title' => 'Professional standards', 'text' => 'Build awareness of quality, safety, hygiene, presentation, and responsible practice.' ),
				array( 'title' => 'Industry readiness', 'text' => 'Develop confidence for real workplaces through practical scenarios, projects, and reflective learning.' ),
			),
			'careers' => array( $title . ' assistant', 'Guest services officer', 'Operations coordinator', 'Events or travel assistant', 'Hospitality entrepreneur' ),
		),
		'School of Health Sciences' => array(
			'summary' => 'Build a people-centred foundation in knowledge, practical skills, ethics, and service for ' . $title . '.',
			'overview' => $title . ' at KENCID introduces the knowledge, communication, practical awareness, and professional responsibility needed to support people and communities. Learning is grounded in care, accuracy, teamwork, safety, and respect.',
			'why' => 'This pathway is for learners who want work that makes a positive difference and who are prepared to learn carefully, communicate compassionately, and keep developing their practice.',
			'learning' => array(
				array( 'title' => 'Foundations of care', 'text' => 'Develop a clear understanding of the people, contexts, concepts, and responsibilities connected to the discipline.' ),
				array( 'title' => 'Practical skills', 'text' => 'Build careful, accurate, and safe habits through guided practical learning and observation.' ),
				array( 'title' => 'Communication and teamwork', 'text' => 'Practise respectful communication, documentation, collaboration, and professional conduct.' ),
				array( 'title' => 'Community and ethics', 'text' => 'Consider dignity, inclusion, confidentiality, responsibility, and the wider impact of health practice.' ),
			),
			'careers' => array( $title . ' assistant', 'Health services support worker', 'Community services assistant', 'Records or operations assistant', 'Further study in a health discipline' ),
		),
		'School of Trades & Technology' => array(
			'summary' => 'Gain practical, safety-conscious technical skills for ' . $title . ' and the built environment.',
			'overview' => $title . ' at KENCID is built around learning by doing. Students develop the tools, materials, processes, safety awareness, and problem-solving habits needed to contribute confidently in technical workplaces.',
			'why' => 'The course is suited to practical learners who enjoy making, fixing, installing, building, and seeing a task move from a plan to a finished result.',
			'learning' => array(
				array( 'title' => 'Tools and materials', 'text' => 'Understand the properties, uses, care, and safe handling of the materials and tools used in the trade.' ),
				array( 'title' => 'Technical methods', 'text' => 'Build step-by-step competence in the processes, measurements, joints, systems, or installations of the discipline.' ),
				array( 'title' => 'Quality and safety', 'text' => 'Work carefully, interpret instructions, manage risks, and check the quality of a finished task.' ),
				array( 'title' => 'Workplace readiness', 'text' => 'Develop teamwork, punctuality, communication, customer awareness, and practical problem solving.' ),
			),
			'careers' => array( $title . ' technician', 'Workshop assistant', 'Site technician', 'Maintenance or installation assistant', 'Skilled-trade entrepreneur' ),
		),
	);

	$detail = $defaults[ $school ] ?? $defaults['School of Design'];
	return $detail;
}

/**
 * Return the complete editorial payload for a catalogue course.
 */
function kcid_course_detail( string $title, string $school ): array {
	$legacy = kcid_legacy_course_content();
	$detail = $legacy[ $title ] ?? kcid_school_course_defaults( $title, $school );

	$detail['pathways'] = kcid_course_pathways();
	$detail['school']   = $school;
	$detail['title']    = $title;

	return $detail;
}
