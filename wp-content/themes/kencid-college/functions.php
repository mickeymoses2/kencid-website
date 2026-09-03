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

function kcid_page_url( string $slug ): string {
	$page = get_page_by_path( trim( $slug, '/' ) );

	if ( $page instanceof WP_Post ) {
		return esc_url( get_permalink( $page ) );
	}

	return esc_url( home_url( '/' . trim( $slug, '/' ) . '/' ) );
}

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

function kcid_render_page_header( string $eyebrow, string $title, string $copy ): void {
	?>
	<section class="page-hero">
		<div class="container page-hero__inner">
			<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h1><?php echo esc_html( $title ); ?></h1>
			<p><?php echo esc_html( $copy ); ?></p>
		</div>
	</section>
	<?php
}
