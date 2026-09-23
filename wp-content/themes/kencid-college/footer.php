<?php
/**
 * Site footer.
 *
 * @package KCIDCollege
 */

$contact = kcid_contacts();
$quick_links = array(
	array( 'label' => 'Programme Areas', 'slug' => 'programs', 'icon' => 'cap' ),
	array( 'label' => 'Admissions', 'slug' => 'admissions', 'icon' => 'file-text' ),
	array( 'label' => 'Student Life', 'slug' => 'student-life', 'icon' => 'community' ),
	array( 'label' => 'Projects', 'slug' => 'projects', 'icon' => 'folder' ),
	array( 'label' => 'About Us', 'slug' => 'about-us', 'icon' => 'info' ),
	array( 'label' => 'Contact', 'slug' => 'contact', 'icon' => 'mail' ),
);
$program_icons = array(
	'interior-design'         => 'sofa',
	'architecture'            => 'school',
	'fashion-design'          => 'dress',
	'graphic-design'          => 'pen-tool',
	'film-cinematography'     => 'media',
	'construction-management' => 'building',
);
$map_query     = 'Kenya College of Interior Design, ' . $contact['address'];
$map_embed_url = 'https://www.google.com/maps?q=' . rawurlencode( $map_query ) . '&output=embed';
$directions_url = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode( $map_query );
?>
<section class="prefooter-cta" aria-labelledby="prefooter-cta-title">
	<div class="prefooter-cta__shell">
		<div class="prefooter-cta__content">
			<h2 id="prefooter-cta-title"><span class="prefooter-cta__title-line">Ready to Build Your</span><span>Future?</span></h2>
			<p>Join KENCID to learn, prove your competence and prepare for<br class="prefooter-cta__desktop-break"> professional practice, enterprise and lifelong development.</p>
			<a class="button button--primary prefooter-cta__button" href="<?php echo esc_url( kcid_page_url( 'apply-now' ) ); ?>">Apply Now <?php echo kcid_icon( 'arrow-right' ); ?></a>
		</div>
	</div>
</section>
<footer id="site-footer" class="site-footer">
	<div class="footer-shell">
		<div class="footer-main">
		<div class="footer-brand footer-panel">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="brand__image" src="<?php echo esc_url( kcid_asset( 'img/kencid-logo-mustard.png' ) ); ?>" alt="Kenya College of Interior Design" />
			</a>
			<p>A comprehensive college of design, technology and applied professions.</p>
			<div class="socials" aria-label="<?php esc_attr_e( 'Social links', 'kencid-college' ); ?>">
				<a href="#" aria-label="Facebook"><?php echo kcid_icon( 'facebook' ); ?></a>
				<a href="#" aria-label="Instagram"><?php echo kcid_icon( 'instagram' ); ?></a>
				<a href="#" aria-label="LinkedIn"><?php echo kcid_icon( 'linkedin' ); ?></a>
				<a href="#" aria-label="YouTube"><?php echo kcid_icon( 'youtube' ); ?></a>
			</div>
		</div>
		<nav class="footer-links footer-panel" aria-label="<?php esc_attr_e( 'Quick links', 'kencid-college' ); ?>">
			<h2 class="footer-heading">Quick Links</h2>
			<?php foreach ( $quick_links as $item ) : ?>
				<a class="footer-link<?php echo is_page( $item['slug'] ) ? ' is-current' : ''; ?>" href="<?php echo kcid_page_url( $item['slug'] ); ?>"><span><?php echo kcid_icon( $item['icon'] ); ?></span><?php echo esc_html( $item['label'] ); ?></a>
			<?php endforeach; ?>
		</nav>
		<nav class="footer-links footer-panel" aria-label="<?php esc_attr_e( 'Programme areas', 'kencid-college' ); ?>">
			<h2 class="footer-heading">Programme Areas</h2>
			<?php foreach ( kcid_programs() as $program ) : ?>
				<a class="footer-link" href="<?php echo kcid_page_url( 'programs' ); ?>#<?php echo esc_attr( $program['slug'] ); ?>"><span><?php echo kcid_icon( $program_icons[ $program['slug'] ] ?? 'cap' ); ?></span><?php echo esc_html( $program['title'] ); ?></a>
			<?php endforeach; ?>
		</nav>
		<div class="footer-contact footer-panel">
			<h2 class="footer-heading">Contact Us</h2>
			<p><?php echo kcid_icon( 'phone' ); ?><a href="tel:+254797888111"><?php echo esc_html( $contact['phone'] ); ?></a></p>
			<p><?php echo kcid_icon( 'mail' ); ?><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
			<p><?php echo kcid_icon( 'pin' ); ?><span><?php echo esc_html( $contact['address'] ); ?></span></p>
			<p><?php echo kcid_icon( 'clock' ); ?><span>Mon - Fri: 8:00 AM - 5:00 PM<br />Sat: 8:00 AM - 1:00 PM</span></p>
		</div>
		<section class="footer-location footer-panel" aria-labelledby="footer-location-title">
			<div class="footer-location__heading">
				<h2 id="footer-location-title" class="footer-heading"><span><?php echo kcid_icon( 'pin' ); ?></span>Our Location</h2>
				<a href="<?php echo esc_url( $directions_url ); ?>" target="_blank" rel="noopener">Get Directions <?php echo kcid_icon( 'arrow' ); ?></a>
			</div>
			<div class="footer-map">
				<iframe src="<?php echo esc_url( $map_embed_url ); ?>" title="Kenya College of Interior Design location" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				<a class="footer-map__link" href="<?php echo esc_url( $directions_url ); ?>" target="_blank" rel="noopener"><?php echo kcid_icon( 'map' ); ?> View on Google Maps <?php echo kcid_icon( 'arrow' ); ?></a>
			</div>
		</section>
		</div>

		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Kenya College of Interior Design. All Rights Reserved.</p>
			<p>TVETA License: <?php echo esc_html( $contact['license'] ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
