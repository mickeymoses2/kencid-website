<?php
/**
 * Kencid Personal theme setup.
 *
 * @package KencidPersonal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'after_setup_theme',
	function (): void {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/theme.css' );
	}
);

add_action(
	'wp_enqueue_scripts',
	function (): void {
		wp_enqueue_style(
			'kencid-personal-theme',
			get_theme_file_uri( 'assets/css/theme.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
);

add_action(
	'init',
	function (): void {
		register_block_pattern_category(
			'kencid-personal',
			array( 'label' => __( 'Kencid Personal', 'kencid-personal' ) )
		);
	}
);
