<?php
/**
 * KENCID College theme bootstrap.
 *
 * @package KCIDCollege
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_theme_file_path( 'inc/theme-data.php' );
require_once get_theme_file_path( 'inc/course-content.php' );

add_action(
	'after_setup_theme',
	function (): void {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
		add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 220, 'flex-height' => true, 'flex-width' => true ) );

		register_nav_menus(
			array(
				'primary' => __( 'Primary Navigation', 'kencid-college' ),
				'footer'  => __( 'Footer Navigation', 'kencid-college' ),
			)
		);
	}
);

add_action(
	'wp_enqueue_scripts',
	function (): void {
		wp_enqueue_style(
			'kencid-college',
			get_theme_file_uri( 'assets/css/theme.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);

		wp_enqueue_script(
			'kencid-college',
			get_theme_file_uri( 'assets/js/site.js' ),
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
);

function kcid_asset( string $path ): string {
	return esc_url( get_theme_file_uri( 'assets/' . ltrim( $path, '/' ) ) );
}

/**
 * YouTube embed slots used by the editorial pages.
 *
 * Add full YouTube embed URLs here when the final videos are ready, for example:
 * https://www.youtube-nocookie.com/embed/VIDEO_ID
 */
function kcid_video_embeds(): array {
	return array(
		'student_life_featured' => 'https://www.youtube.com/embed/yV3XYer3_Bk?si=IiuXxqzkEKTsDzTe&autoplay=1&mute=0&playsinline=1',
		'about_story'           => 'https://www.youtube.com/embed/hVzNvs4SXcM?si=aq0CTj-WWzGo9jpX&autoplay=1&mute=0&playsinline=1',
	);
}

/**
 * Add the provider-specific parameters required for audible autoplay and looping.
 */
function kcid_prepare_video_embed_url( string $url ): string {
	$parsed_url = wp_parse_url( $url );
	$host       = isset( $parsed_url['host'] ) ? strtolower( (string) $parsed_url['host'] ) : '';

	if ( ! in_array( $host, array( 'youtube.com', 'www.youtube.com', 'youtube-nocookie.com', 'www.youtube-nocookie.com', 'vimeo.com', 'www.vimeo.com', 'player.vimeo.com' ), true ) ) {
		return $url;
	}

	$query_args = array();
	if ( isset( $parsed_url['query'] ) ) {
		wp_parse_str( (string) $parsed_url['query'], $query_args );
	}

	$query_args['autoplay']    = '1';
	$query_args['loop']        = '1';
	$query_args['mute']        = '0';
	$query_args['playsinline'] = '1';

	// YouTube requires the video ID as a playlist for a single video to loop.
	if ( false !== strpos( $host, 'youtube' ) ) {
		$query_args['enablejsapi'] = '1';
		$path_parts                = explode( '/', trim( (string) ( $parsed_url['path'] ?? '' ), '/' ) );
		$embed_index               = array_search( 'embed', $path_parts, true );
		$video_id                  = false !== $embed_index && isset( $path_parts[ $embed_index + 1 ] ) ? $path_parts[ $embed_index + 1 ] : '';
		$video_id                  = preg_replace( '/[^A-Za-z0-9_-]/', '', (string) $video_id );

		if ( '' !== $video_id ) {
			$query_args['playlist'] = $video_id;
		}
	}

	return add_query_arg( $query_args, $url );
}

/**
 * Enforce audible autoplay/looping on native videos and supported iframe embeds,
 * including videos added through WordPress content blocks or shortcodes.
 */
function kcid_enforce_video_playback_markup( string $html ): string {
	if ( false === stripos( $html, '<video' ) && false === stripos( $html, '<iframe' ) ) {
		return $html;
	}

	$html = preg_replace_callback(
		'/<video\b[^>]*>/i',
		static function ( array $matches ): string {
			$tag = preg_replace( '/\s+(?:autoplay|loop|muted|playsinline)(?:\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+))?/i', '', $matches[0] );
			$tag = is_string( $tag ) ? rtrim( $tag, '>' ) : $matches[0];

			return $tag . ' autoplay loop playsinline controls>';
		},
		$html
	) ?? $html;

	$html = preg_replace_callback(
		'/<iframe\b[^>]*>/i',
		static function ( array $matches ): string {
			$tag = $matches[0];

			if ( ! preg_match( '/\ssrc\s*=\s*(["\'])(.*?)\1/i', $tag, $src_match ) ) {
				return $tag;
			}

			$source_url   = html_entity_decode( $src_match[2], ENT_QUOTES, get_bloginfo( 'charset' ) ?: 'UTF-8' );
			$prepared_url = kcid_prepare_video_embed_url( $source_url );

			if ( $prepared_url === $source_url ) {
				return $tag;
			}

			$tag = preg_replace(
				'/\ssrc\s*=\s*(["\'])(.*?)\1/i',
				' src="' . esc_attr( $prepared_url ) . '"',
				$tag,
				1
			) ?? $tag;

			if ( preg_match( '/\sallow\s*=\s*(["\'])(.*?)\1/i', $tag, $allow_match ) ) {
				$allow_value = $allow_match[2];

				if ( false === stripos( $allow_value, 'autoplay' ) ) {
					$updated_allow = trim( $allow_value . '; autoplay' );
					$tag           = preg_replace(
						'/\sallow\s*=\s*(["\'])(.*?)\1/i',
						' allow="' . esc_attr( $updated_allow ) . '"',
						$tag,
						1
					) ?? $tag;
				}
			} else {
				$tag = rtrim( $tag, '>' ) . ' allow="autoplay">';
			}

			return $tag;
		},
		$html
	) ?? $html;

	return $html;
}

add_filter( 'render_block', 'kcid_enforce_video_playback_markup', 20 );
add_filter( 'the_content', 'kcid_enforce_video_playback_markup', 20 );
add_filter( 'wp_video_shortcode', 'kcid_enforce_video_playback_markup', 20 );

function kcid_render_video_embed( string $key, string $title, string $aspect = 'landscape' ): void {
	$embeds = kcid_video_embeds();
	$url    = isset( $embeds[ $key ] ) ? trim( $embeds[ $key ] ) : '';
	$host   = '';

	if ( '' !== $url ) {
		$parsed_url = wp_parse_url( $url );
		$host       = isset( $parsed_url['host'] ) ? strtolower( (string) $parsed_url['host'] ) : '';
	}

	$is_youtube_embed = in_array( $host, array( 'youtube.com', 'www.youtube.com', 'youtube-nocookie.com', 'www.youtube-nocookie.com' ), true );
	$url              = $is_youtube_embed ? kcid_prepare_video_embed_url( $url ) : $url;
	?>
	<div class="kcid-video-frame kcid-video-frame--<?php echo esc_attr( $aspect ); ?>">
		<?php if ( $is_youtube_embed ) : ?>
			<iframe
				src="<?php echo esc_url( $url ); ?>"
				title="<?php echo esc_attr( $title ); ?>"
				loading="<?php echo 'student_life_featured' === $key ? 'eager' : 'lazy'; ?>"
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
				referrerpolicy="strict-origin-when-cross-origin"
				allowfullscreen
			></iframe>
		<?php else : ?>
			<div class="kcid-video-placeholder">
				<span class="kcid-video-placeholder__mark" aria-hidden="true">▶</span>
				<strong>Featured video slot</strong>
				<span>Add the YouTube embed URL in <code>kcid_video_embeds()</code>.</span>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

function kcid_page_url( string $slug ): string {
	$page = get_page_by_path( trim( $slug, '/' ) );

	if ( $page instanceof WP_Post ) {
		return esc_url( get_permalink( $page ) );
	}

	return esc_url( home_url( '/' . trim( $slug, '/' ) . '/' ) );
}

function kcid_register_course_rewrites(): void {
	foreach ( kcid_catalog_programs() as $course ) {
		$course_slug = preg_quote( $course['slug'], '#' );
		$course_path = preg_quote( kcid_course_path_for_slug( $course['slug'] ), '#' );
		add_rewrite_rule( '^' . $course_path . '/?$', 'index.php?pagename=programs&kcid_course=' . $course['slug'], 'top' );
		add_rewrite_rule( '^' . $course_slug . '/?$', 'index.php?pagename=programs&kcid_course=' . $course['slug'] . '&kcid_course_root=1', 'top' );
	}

	foreach ( kcid_course_aliases() as $alias => $canonical ) {
		$alias_slug = preg_quote( $alias, '#' );
		add_rewrite_rule( '^' . $alias_slug . '/?$', 'index.php?pagename=programs&kcid_course=' . $alias . '&kcid_course_root=1', 'top' );
	}

	foreach ( kcid_course_catalog() as $school ) {
		$school_slug = preg_quote( kcid_school_route_path( $school['name'] ), '#' );
		add_rewrite_rule( '^' . $school_slug . '/?$', 'index.php?pagename=programs&kcid_school=' . sanitize_title( $school['name'] ), 'top' );
		add_rewrite_rule( '^schools/' . preg_quote( sanitize_title( $school['name'] ), '#' ) . '/?$', 'index.php?pagename=programs&kcid_school=' . sanitize_title( $school['name'] ) . '&kcid_school_legacy=1', 'top' );
	}

	add_rewrite_rule( '^schools/[^/]+/([^/]+)/?$', 'index.php?pagename=programs&kcid_course=$matches[1]', 'top' );
	add_rewrite_rule( '^school-of-design/([^/]+)/?$', 'index.php?pagename=programs&kcid_course=$matches[1]', 'top' );
}

add_action( 'init', 'kcid_register_course_rewrites' );
add_action(
	'after_switch_theme',
	function (): void {
		kcid_register_course_rewrites();
		flush_rewrite_rules();
	}
);

add_filter(
	'query_vars',
	function ( array $vars ): array {
		$vars[] = 'kcid_course';
		$vars[] = 'kcid_school';
		$vars[] = 'kcid_course_root';
		$vars[] = 'kcid_school_legacy';
		return $vars;
	}
);

function kcid_requested_course_slug(): string {
	$rewrite_slug = get_query_var( 'kcid_course' );
	if ( '' !== (string) $rewrite_slug ) {
		return sanitize_title( (string) $rewrite_slug );
	}
	if ( isset( $_GET['course'] ) ) {
		return sanitize_title( wp_unslash( $_GET['course'] ) );
	}
	return '';
}

function kcid_requested_school_slug(): string {
	$rewrite_slug = get_query_var( 'kcid_school' );
	if ( '' !== (string) $rewrite_slug ) {
		return sanitize_title( (string) $rewrite_slug );
	}
	if ( isset( $_GET['school'] ) ) {
		return sanitize_title( wp_unslash( $_GET['school'] ) );
	}
	return '';
}

function kcid_current_course(): ?array {
	$slug = kcid_requested_course_slug();
	return '' !== $slug ? kcid_program_by_slug( $slug ) : null;
}

function kcid_school_route_path( string $school ): string {
	$paths = array(
		'school-of-building-sciences'             => 'schools/school-of-building-science',
		'school-of-design'                        => 'school-of-design',
		'school-of-media-and-communication'      => 'schools/school-of-media-and-communication',
		'school-of-information-technology'        => 'schools/school-of-information-technology',
		'school-of-engineering-automotive-design' => 'schools/school-of-engineering-automotive-design',
		'school-of-business-management'           => 'schools/school-of-business-management',
		'school-of-creative-performing-arts'      => 'schools/school-of-creative-performing-arts',
		'school-of-trades-technology'             => 'schools/school-of-trades-technology',
		'school-of-hospitality-management'        => 'schools/school-of-hospitality-management',
		'school-of-health-sciences'                => 'schools/school-of-health-sciences',
	);
	$slug = sanitize_title( $school );
	return $paths[ $slug ] ?? 'schools/' . $slug;
}

function kcid_school_url( string $school ): string {
	return esc_url( home_url( '/' . kcid_school_route_path( $school ) . '/' ) );
}

function kcid_course_path_for_slug( string $slug ): string {
	$slug    = sanitize_title( $slug );
	$aliases = kcid_course_aliases();
	$slug    = $aliases[ $slug ] ?? $slug;
	$course  = kcid_program_by_slug( $slug );
	if ( ! $course ) {
		return $slug;
	}
	$school_paths = array(
		'School of Building Sciences'               => 'schools/school-of-building-science',
		'School of Design'                          => 'school-of-design',
		'School of Media and Communication'         => 'schools/school-of-media-and-communication',
		'School of Information Technology'          => 'schools/school-of-information-technology',
		'School of Engineering & Automotive Design' => 'schools/school-of-engineering-automotive-design',
		'School of Business Management'             => 'schools/school-of-business-management',
		'School of Creative & Performing Arts'      => 'schools/school-of-creative-performing-arts',
		'School of Trades & Technology'             => 'schools/school-of-trades-technology',
		'School of Hospitality Management'          => 'schools/school-of-hospitality-management',
		'School of Health Sciences'                  => 'schools/school-of-health-sciences',
	);
	$course_slugs = array(
		'landscape-architecture'              => 'landscape-architecture-2',
		'urban-design'                        => 'urban-design-2',
		'construction-management'             => 'construction-management-2',
		'preservation-design'                 => 'preservation-design-2',
		'universal-design'                    => 'universal-design-2',
		'architectural-history'               => 'architectural-history-2',
		'interior-architecture'              => 'interior-architecture-2',
		'jewelry-design-and-metal-arts'       => 'jewelry-design-and-metal-arts-2',
		'fiber-textile-design'                => 'fiber-and-textile-design',
		'interactive-media-design'            => 'interactive-media-design-2',
		'user-experience-design-and-research' => 'user-experience-design-and-research-2',
		'industrial-design'                   => 'industrial-design-2',
		'knitwear-design'                     => 'knitwear-design-2',
		'design'                              => 'design-2',
		'sneaker-design'                      => 'sneaker-design-2',
		'cinema-studies'                      => 'cinema-studies-2',
		'communications'                      => 'communications-2',
		'film-and-tv'                         => 'film-and-tv-2',
		'french'                              => 'french-2',
		'visual-effects'                      => 'visual-effects-2',
		'animation-and-visual-effects'        => 'animation-and-visual-effects-2',
		'journalism-and-media-studies'        => 'journalism-and-media-studies-2',
		'writing-and-directing-for-film'      => 'writing-and-directing-for-film-2',
		'screenwriting'                       => 'screenwriting-2',
		'cinematography'                      => 'cinematography-2',
		'painting'                            => 'painting-2',
		'photography'                         => 'photography-2',
		'television-production'               => 'television-production-3',
		'sound-design'                        => 'sound-design-2',
		'music-production'                    => 'music-production-2',
		'drawing'                             => 'drawing-2',
		'carpentry-and-joinery'               => 'carpentry-and-joinery-2',
	);
	if ( 'animation-design' === $slug ) {
		return 'animation-design';
	}
	$base = $school_paths[ $course['school'] ] ?? 'schools/' . sanitize_title( $course['school'] );
	return trim( $base . '/' . ( $course_slugs[ $slug ] ?? $slug ), '/' );
}

function kcid_course_url( string $slug ): string {
	return esc_url( home_url( '/' . kcid_course_path_for_slug( $slug ) . '/' ) );
}

add_action(
	'template_redirect',
	function (): void {
		$requested_slug = kcid_requested_course_slug();
		$course         = kcid_current_course();
		if ( $course ) {
			$legacy_query   = isset( $_GET['course'] ) || isset( $_GET['school'] );
			$alias_request  = $requested_slug !== $course['slug'];
			$root_request   = '1' === (string) get_query_var( 'kcid_course_root' );
			$request_path   = trim( (string) wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '/' ), PHP_URL_PATH ), '/' );
			$home_path      = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );
			$canonical_path = trim( (string) wp_parse_url( kcid_course_url( $course['slug'] ), PHP_URL_PATH ), '/' );
			if ( '' !== $home_path && 0 === strpos( $request_path, $home_path . '/' ) ) {
				$request_path = substr( $request_path, strlen( $home_path ) + 1 );
			}
			if ( '' !== $home_path && 0 === strpos( $canonical_path, $home_path . '/' ) ) {
				$canonical_path = substr( $canonical_path, strlen( $home_path ) + 1 );
			}
			$needs_redirect = $legacy_query || $root_request || $alias_request;
			if ( $request_path === $canonical_path && ! $legacy_query ) {
				$needs_redirect = false;
			}
			if ( $needs_redirect ) {
				wp_safe_redirect( kcid_course_url( $course['slug'] ), 301 );
				exit;
			}
			return;
		}
		$school_slug = kcid_requested_school_slug();
		$school      = '' !== $school_slug ? kcid_school_by_slug( $school_slug ) : null;
		if ( $school && ( isset( $_GET['school'] ) || '1' === (string) get_query_var( 'kcid_school_legacy' ) ) ) {
			wp_safe_redirect( kcid_school_url( $school['name'] ), 301 );
			exit;
		}
	},
	1
);

add_filter(
	'pre_get_document_title',
	function ( string $title ): string {
		$course = kcid_current_course();
		return $course ? $course['title'] . ' Course in Kenya | KENCID' : $title;
	}
);

add_filter(
	'get_canonical_url',
	function ( ?string $canonical_url, WP_Post $post ): string {
		$course = kcid_current_course();
		return $course ? kcid_course_url( $course['slug'] ) : (string) $canonical_url;
	},
	10,
	2
);

add_action(
	'wp_head',
	function (): void {
		$course = kcid_current_course();
		if ( ! $course ) {
			return;
		}
		$description = wp_trim_words( wp_strip_all_tags( $course['overview'] ), 28, '...' );
		$url         = kcid_course_url( $course['slug'] );
		$image       = kcid_asset( 'img/' . $course['image'] );
		$schema      = array(
			'@context'          => 'https://schema.org',
			'@type'             => 'Course',
			'name'              => $course['title'],
			'description'       => $description,
			'url'               => $url,
			'courseMode'        => 'Full-time and evening',
			'provider'          => array( '@type' => 'CollegeOrUniversity', 'name' => 'Kenya College of Interior Design', 'url' => home_url( '/' ) ),
			'hasCourseInstance' => array_map(
				function ( array $pathway ): array {
					return array( '@type' => 'CourseInstance', 'name' => $pathway['label'], 'courseMode' => 'Full-time and evening', 'description' => $pathway['entry'] . '; ' . $pathway['duration'] . '.' );
				},
				$course['pathways']
			),
			'about'             => $course['school'],
		);
		$breadcrumbs = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => array(
				array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
				array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Courses', 'item' => kcid_page_url( 'programs' ) ),
				array( '@type' => 'ListItem', 'position' => 3, 'name' => $course['school'], 'item' => kcid_page_url( 'programs' ) ),
				array( '@type' => 'ListItem', 'position' => 4, 'name' => $course['title'], 'item' => $url ),
			),
		);
		?>
		<meta name="description" content="<?php echo esc_attr( $description ); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?php echo esc_attr( $course['title'] . ' Course in Kenya | KENCID' ); ?>" />
		<meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
		<meta property="og:url" content="<?php echo esc_url( $url ); ?>" />
		<meta property="og:image" content="<?php echo esc_url( $image ); ?>" />
		<script type="application/ld+json"><?php echo wp_json_encode( $schema ); ?></script>
		<script type="application/ld+json"><?php echo wp_json_encode( $breadcrumbs ); ?></script>
		<?php
	}
);

function kcid_whatsapp_url( string $message = '' ): string {
	$url = 'https://wa.me/254797888111';

	if ( '' !== $message ) {
		$url .= '?text=' . rawurlencode( $message );
	}

	return esc_url( $url );
}

function kcid_icon( string $name ): string {
	$icons = array(
		'arrow'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 19 19 5M8 5h11v11"/></svg>',
		'chevron-down' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>',
		'calendar'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h.01M12 14h.01M16 14h.01M8 17h.01M12 17h.01M16 17h.01"/></svg>',
		'phone'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.6a2 2 0 0 1-.4 2.1L8.1 9.7a16 16 0 0 0 6.2 6.2l1.3-1.3a2 2 0 0 1 2.1-.4c.8.3 1.7.6 2.6.7a2 2 0 0 1 1.7 2Z"/></svg>',
		'mail'       => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/><path d="m22 6-10 7L2 6"/></svg>',
		'pin'        => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
		'cap'        => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m2 9 10-5 10 5-10 5L2 9Z"/><path d="M6 11v5c3 3 9 3 12 0v-5"/></svg>',
		'user'       => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>',
		'tools'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m14.7 6.3 3-3 3 3-3 3"/><path d="m3 21 8.5-8.5"/><path d="m9 5 10 10"/><path d="m5 9 10 10"/></svg>',
		'briefcase'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18"/></svg>',
		'globe'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/></svg>',
		'community'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-8 0v2"/><circle cx="12" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M2 21v-2a4 4 0 0 1 3-3.9"/></svg>',
		'star'       => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-2.9-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3Z"/></svg>',
		'box'        => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m21 8-9-5-9 5 9 5 9-5Z"/><path d="M3 8v8l9 5 9-5V8M12 13v8"/></svg>',
		'shield'     => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-5"/></svg>',
		'tag'        => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L3 13V3h10l7.6 7.6a2 2 0 0 1 0 2.8Z"/><circle cx="7.5" cy="7.5" r="1"/></svg>',
		'whatsapp'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.6 0 .3 5.3.3 11.8c0 2.1.6 4.2 1.7 6L.2 24l6.4-1.7a11.8 11.8 0 0 0 5.5 1.4h.1c6.5 0 11.8-5.3 11.8-11.8 0-3.2-1.2-6.2-3.5-8.4Zm-8.4 18.1h-.1a9.8 9.8 0 0 1-5-1.4l-.4-.2-3.8 1 1-3.7-.2-.4a9.8 9.8 0 0 1-1.5-5.2C2.1 6.4 6.5 2 12.1 2c2.6 0 5.1 1 6.9 2.9a9.8 9.8 0 0 1 2.9 7c0 5.5-4.4 9.8-9.8 9.8Z"/><path d="M17.7 14.4c-.3-.2-1.7-.8-2-.9-.3-.1-.5-.2-.7.2-.2.3-.7.9-.8 1.1-.2.2-.3.2-.6.1-1.6-.8-2.7-1.4-3.8-3.2-.3-.5.3-.5.8-1.7.1-.2 0-.4 0-.5l-.9-2.1c-.2-.5-.5-.4-.7-.4h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.8 4.3 1.8.8 2.5.9 3.4.8.5-.1 1.7-.7 2-1.3.3-.6.3-1.1.2-1.2-.1-.2-.3-.3-.6-.4Z"/></svg>',
	);

	return $icons[ $name ] ?? $icons['arrow'];
}

function kcid_render_page_header( string $eyebrow, string $title, string $copy, string $image = '', string $title_break_after = '', string $modifier = '' ): void {
	$title_markup = esc_html( $title );
	$hero_class   = 'page-hero';
	$hero_style   = '';
	$hero_crops   = array(
		'programs'     => 'center 52%',
		'projects'     => 'center 50%',
		'admissions'   => '65% 48%',
		'events'       => '65% 48%',
		'student-life' => 'center 38%',
		'about'        => '68% 50%',
		'our-team'     => '65% 48%',
		'partners'     => '68% 48%',
		'contact'      => '65% 48%',
	);

	if ( '' !== $image ) {
		$image_url   = kcid_asset( 'img/' . $image );
		$hero_class .= ' page-hero--image';
		$hero_style  = sprintf(
			'--page-hero-image:url("%1$s");background-image:linear-gradient(to top,rgba(5,8,9,.88) 0%%,rgba(5,8,9,.58) 15%%,rgba(5,8,9,0) 30%%,rgba(5,8,9,0) 100%%),url("%1$s");background-position:%2$s;background-size:cover;background-repeat:no-repeat',
			esc_url( $image_url ),
			$hero_crops[ $modifier ] ?? 'center center'
		);
	}

	if ( '' !== $title_break_after ) {
		$hero_class .= ' page-hero--title-break';
		$title_parts = explode( $title_break_after, $title, 2 );

		if ( 2 === count( $title_parts ) && '' !== trim( $title_parts[1] ) ) {
			$title_markup = esc_html( rtrim( $title_parts[0] ) . ' ' . $title_break_after ) . '<br />' . esc_html( ltrim( $title_parts[1] ) );
		}
	}

	if ( '' !== $modifier ) {
		$hero_class .= ' page-hero--' . sanitize_title( $modifier );
	}
	?>
	<section class="<?php echo esc_attr( $hero_class ); ?>"<?php echo '' !== $hero_style ? ' style="' . esc_attr( $hero_style ) . '"' : ''; ?>>
		<div class="container page-hero__inner" style="min-height:clamp(26rem,60vh,42rem);display:flex;flex-direction:column;justify-content:flex-end;padding-top:clamp(3rem,8vh,6rem);padding-bottom:clamp(1.25rem,3vw,2rem)">
			<p class="eyebrow hero-kicker" style="text-shadow:0 2px 18px rgba(5,8,9,.7)"><?php echo esc_html( $eyebrow ); ?></p>
			<h1 style="text-shadow:0 2px 22px rgba(5,8,9,.55)"><?php echo $title_markup; ?></h1>
		</div>
	</section>
	<?php
}
