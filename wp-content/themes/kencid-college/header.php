<?php
/**
 * Site header.
 *
 * @package KCIDCollege
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'kencid-college' ); ?></a>
<header class="site-header">
	<div class="site-utility" aria-label="College updates and quick links">
		<div class="site-utility__inner">
			<div class="site-utility__left">
				<a class="site-utility__item" href="<?php echo kcid_page_url( 'admissions' ); ?>">
					<?php echo kcid_icon( 'calendar' ); ?>
					<span>Applications are now open</span>
				</a>
				<a class="site-utility__item site-utility__phone" href="tel:+254797888111">
					<?php echo kcid_icon( 'phone' ); ?>
					<span>+254 797 888 111</span>
				</a>
			</div>
			<nav class="site-utility__links" aria-label="Quick links">
				<a href="<?php echo kcid_page_url( 'programs' ); ?>">Programs</a>
				<a href="<?php echo kcid_page_url( 'admissions' ); ?>">Admissions</a>
				<a href="<?php echo kcid_page_url( 'about-us' ); ?>">About KENCID</a>
				<a href="<?php echo kcid_page_url( 'contact' ); ?>">Contact</a>
			</nav>
		</div>
	</div>
	<div class="container site-header__inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Kenya College of Interior Design home', 'kencid-college' ); ?>">
			<img class="brand__image" src="<?php echo esc_url( kcid_asset( 'img/kencid-logo.png' ) ); ?>" alt="Kenya College of Interior Design" />
		</a>

		<button class="menu-toggle" type="button" aria-controls="primary-navigation" aria-expanded="false">
			<span class="menu-toggle__bar"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Open menu', 'kencid-college' ); ?></span>
		</button>

		<nav class="primary-nav" id="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'kencid-college' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<div class="primary-nav__dropdown">
				<button class="primary-nav__toggle" type="button" aria-controls="about-submenu" aria-expanded="false" aria-haspopup="true">
					<span>About</span>
					<?php echo kcid_icon( 'chevron-down' ); ?>
				</button>
				<div class="nav-panel" id="about-submenu" hidden>
					<a href="<?php echo kcid_page_url( 'about-us' ); ?>">About us</a>
					<a href="<?php echo kcid_page_url( 'our-team' ); ?>">Our team</a>
					<a href="<?php echo kcid_page_url( 'partners' ); ?>">Partners</a>
				</div>
			</div>
			<div class="primary-nav__dropdown">
				<button class="primary-nav__toggle" type="button" aria-controls="schools-submenu" aria-expanded="false" aria-haspopup="true">
					<span>Schools</span>
					<?php echo kcid_icon( 'chevron-down' ); ?>
				</button>
				<div class="nav-panel nav-panel--schools" id="schools-submenu" hidden>
					<?php foreach ( kcid_schools() as $school ) : ?>
						<a href="<?php echo esc_url( kcid_page_url( 'programs' ) . '#' . sanitize_title( $school ) ); ?>"><?php echo esc_html( $school ); ?></a>
					<?php endforeach; ?>
				</div>
			</div>
			<a href="<?php echo kcid_page_url( 'programs' ); ?>">Courses</a>
			<a href="<?php echo kcid_page_url( 'student-life' ); ?>">Student Life</a>
			<a href="<?php echo kcid_page_url( 'about-us' ); ?>">Resources</a>
			<a href="<?php echo kcid_page_url( 'student-life' ); ?>">Events</a>
			<a href="<?php echo kcid_page_url( 'contact' ); ?>">Contact us</a>
		</nav>

		<a class="button button--primary site-header__cta" href="<?php echo kcid_page_url( 'apply-now' ); ?>">
			Apply Now <?php echo kcid_icon( 'arrow' ); ?>
		</a>
	</div>
</header>
