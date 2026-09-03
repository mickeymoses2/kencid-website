<?php
/**
 * Site footer.
 *
 * @package KCIDCollege
 */

$contact = kcid_contacts();
?>
<footer class="site-footer">
	<div class="footer-cta">
		<div class="footer-cta__decor footer-cta__decor--pink" aria-hidden="true"></div>
		<div class="footer-cta__decor footer-cta__decor--blue" aria-hidden="true"></div>
		<div class="container footer-cta__inner">
			<div class="footer-cta__copy">
				<h2><span>Ready to Begin</span><br> <span>Your Design Journey?</span></h2>
				<a class="button button--dark" href="<?php echo kcid_page_url( 'apply-now' ); ?>">
					Apply Now <?php echo kcid_icon( 'arrow' ); ?>
				</a>
			</div>
			<div class="footer-cta__people">
				<img src="<?php echo esc_url( kcid_asset( 'img/cta-students-cutout-alpha.png' ) ); ?>" alt="Two smiling prospective KENCID students" loading="lazy" />
			</div>
		</div>
	</div>

	<div class="container footer-main">
		<div class="footer-brand">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="brand__image" src="<?php echo esc_url( kcid_asset( 'img/kencid-logo.png' ) ); ?>" alt="Kenya College of Interior Design" />
			</a>
			<p>Empowering creatives to design spaces, shape stories, and move the world.</p>
			<div class="socials" aria-label="<?php esc_attr_e( 'Social links', 'kencid-college' ); ?>">
				<a href="#" aria-label="Facebook">f</a>
				<a href="#" aria-label="Instagram">ig</a>
				<a href="#" aria-label="LinkedIn">in</a>
				<a href="#" aria-label="YouTube">yt</a>
			</div>
		</div>
		<nav class="footer-links" aria-label="<?php esc_attr_e( 'Quick links', 'kencid-college' ); ?>">
			<h3>Quick Links</h3>
			<a href="<?php echo kcid_page_url( 'programs' ); ?>">Programs</a>
			<a href="<?php echo kcid_page_url( 'admissions' ); ?>">Admissions</a>
			<a href="<?php echo kcid_page_url( 'student-life' ); ?>">Student Life</a>
			<a href="<?php echo kcid_page_url( 'about-us' ); ?>">About Us</a>
			<a href="<?php echo kcid_page_url( 'contact' ); ?>">Contact</a>
		</nav>
		<nav class="footer-links" aria-label="<?php esc_attr_e( 'Programs', 'kencid-college' ); ?>">
			<h3>Programs</h3>
			<?php foreach ( kcid_programs() as $program ) : ?>
				<a href="<?php echo kcid_page_url( 'programs' ); ?>#<?php echo esc_attr( $program['slug'] ); ?>"><?php echo esc_html( $program['title'] ); ?></a>
			<?php endforeach; ?>
		</nav>
		<div class="footer-contact">
			<h3>Contact Us</h3>
			<p><?php echo kcid_icon( 'phone' ); ?><a href="tel:+254797888111"><?php echo esc_html( $contact['phone'] ); ?></a></p>
			<p><?php echo kcid_icon( 'mail' ); ?><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
			<p><?php echo kcid_icon( 'pin' ); ?><span><?php echo esc_html( $contact['address'] ); ?></span></p>
		</div>
	</div>

	<div class="container footer-bottom">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Kenya College of Interior Design. All Rights Reserved.</p>
		<p>TVETA License: <?php echo esc_html( $contact['license'] ); ?></p>
	</div>
</footer>

<?php $whatsapp_url = kcid_whatsapp_url( 'Hi KENCID, I would like to learn more about your courses.' ); ?>
<aside class="whatsapp-chat" aria-label="WhatsApp chat">
	<a class="whatsapp-chat__link" href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Open Chatty on WhatsApp">
		<span class="whatsapp-chat__icon" aria-hidden="true"><?php echo kcid_icon( 'whatsapp' ); ?></span>
		<span class="whatsapp-chat__copy"><strong>Chatty</strong><span>Chat with KENCID</span></span>
	</a>
</aside>
<?php wp_footer(); ?>
</body>
</html>
