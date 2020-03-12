<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CSU_Homecoming_&_Family_Weekend
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="main-footer">
			<div class="wrapper">
				<div class="footer_widget footer-1">
					<section class="widget widget_nav_menu">
						<?php
						wp_nav_menu( array(
							'menu' => 'Footer 1',
							'depth' => 1
						) );
						?>
					</section>
				</div><!-- .footer-widget -->

				<div class="footer_widget footer-2">
					<section class="widget widget_nav_menu">
						<?php
						wp_nav_menu( array(
							'menu' => 'Footer 2',
							'depth' => 1
						) );
						?>
					</section>
				</div><!-- .footer-widget -->

				<div class="footer_widget footer-3">
					<section class="widget widget_nav_menu">
						<?php
						wp_nav_menu( array(
							'menu' => 'Footer 3',
							'depth' => 1
						) );
						?>
					</section>
				</div><!-- .footer-widget -->

				<div class="footer_widget footer-4">
					<section class="widget widget_nav_menu">
						<?php
						wp_nav_menu( array(
							'menu' => 'Footer 4',
							'depth' => 1
						) );
						?>
					</section>
				</div><!-- .footer-widget -->

				<div class="footer_widget footer-5">
					<section class="widget widget_text widget_quote">
						<?php
						if ( class_exists('acf') ) {
							$rows = get_field('quotes', 'option');
							$row_count = count($rows);
							$i = rand(0, $row_count - 1);

							if ( get_field('page_quote') ) {
								echo '<p>' . get_field('page_quote') . '</p>';
							} else {
								echo '<p>' . $rows[$i]['quote'] . '</p>';
							}
						} else {
							echo '<p>"' . __( 'My home will never be a place, but a state of mind...', 'csu-hcfw' ) . '"</p>';
						}
						?>
					</section>
				</div><!-- .footer-widget -->

				<div class="footer-widget footer-6">
					<section class="widget widget_social">
						<h2 class="widget-title screen-reader-text"><?php _e( 'Connect on Social Media', 'csu-hcfw' ); ?></h2>
						<ul class="social-links">
							<li class="social-link">
								<a href="//www.facebook.com/csualumni" target="_blank" rel="noopener" aria-label="<?php _e( 'Visit us on Facebook', 'csu-hcfw' ); ?>">
									<span class="fab fa-facebook-f"></span>
								</a>
							</li>
							<li class="social-link">
								<a href="//twitter.com/CSUAlumni" target="_blank" rel="noopener" aria-label="<?php _e( 'Visit us on Twitter', 'csu-hcfw' ); ?>">
									<span class="fab fa-twitter"></span>
								</a>
							</li>
							<li class="social-link">
								<a href="//www.instagram.com/coloradostatealumni" target="_blank" rel="noopener" aria-label="<?php _e( 'Visit us on Instagram', 'csu-hcfw' ); ?>">
									<span class="fab fa-instagram"></span>
								</a>
							</li>
						</ul>
					</section>
				</div><!-- .footer-widget -->
			</div><!-- .wrapper -->
		</div><!-- .main-footer -->

		<div class="csu-footer">
			<div class="wrapper">
				<div class="footer-details">
					<nav class="csu-nav">
						<ul class="menu">
							<li class="menu-item">
								<a href="//admissions.colostate.edu/" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Apply to CSU', 'csu-hcfw' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-contact.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Contact CSU', 'csu-hcfw' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-disclaimer.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Disclaimer', 'csu-hcfw' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-equalop.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Equal Opportunity', 'csu-hcfw' ); ?></a>
							</li><!-- .menu-item -->
							<li class="menu-item">
								<a href="//www.colostate.edu/info-privacy.aspx" class="menu-link" target="_blank" rel="noopener"><?php _e( 'Privacy Statement', 'csu-hcfw' ); ?></a>
							</li><!-- .menu-item -->
						</ul><!-- .menu -->
					</nav><!-- .csu-nav -->

					<div class="copyright">
						<span>&copy; <?php echo date('Y'); ?> <?php _e( 'Colorado State University', 'csu-hcfw' ); ?></span>
					</div><!-- .copyright -->
				</div><!-- .footer-details -->

				<div class="footer-signature">
					<a href="//www.colostate.edu/" target="_blank" rel="noopener">
						<img src="<?php echo esc_url( get_template_directory_uri().'/images/wordmark-goldring-reversed.svg' ); ?>" alt="<?php _e( 'Colorado State University', 'csu-hcfw' ); ?>">
					</a>
				</div><!-- .footer-signature -->
			</div><!-- .wrapper -->
		</div><!-- .csu-footer -->
	</footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
