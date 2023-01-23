<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>
		<!-- Footer -->
		<footer id="footer" class="bd-footer px-0">
			<nav class="container-fluid bg-dark bg-gradient text-light">
				<div class="footer-grid">
					<div class="py-2">
						<div id="tm_widget_contact_info-1" class="split-nav-menu clearfix widget widget-contact-info clearfix mb-20">
							<div class="tm-widget tm-widget-contact-info contact-info contact-info-style1  contact-icon-theme-colored1">
								<div class="text-left">
									<?php
									esc_html_e(
										'MRDF has identified Mon district in Nagaland as the geographical area to initiate this
										development mission with support from government authorities. This model of triggering local
										socio-economic development using DRE based mini grid platform will be scaled across NE India
										in partnership with key stakeholders.',
										'_s'
									);
									?>
								</div>
							</div>
						</div>
						<div id="tm_widget_social_list_custom-1" class="text-center">
							<ul class="nav px-0 mx-0 d-flex justify-content-between">
								<li class="nav-item"><a class="nav-link" href="#" ><i class="bi bi-facebook fs-4 text-white"></i></a></li>
								<li class="nav-item"><a class="nav-link" href="#" ><i class="bi bi-twitter fs-4 text-white"></i></a></li>
								<li class="nav-item"><a class="nav-link" href="#" ><i class="bi bi-youtube fs-4 text-white"></i></a></li>
								<li class="nav-item"><a class="nav-link" href="#" ><i class="bi bi-instagram fs-4 text-white"></i></a></li>
							</ul>
						</div>
					</div>
					<?php
					$menu_list  = wp_get_nav_menu_items( 'Secondary Menu' );
					$count      = 0;
					$nav_string = '';
					foreach ( $menu_list as $menu_item ) :
						?>
						<?php if ( 0 === $count ) : ?>
							<div class="footer-grid text-center">
								<ul id="menu-service-nav-menu d-flex justify-content-center" class="list-unstyled">
									<li class="menu-item py-2">
										<a class="text-decoration-none text-light" href="<?php echo esc_url( $menu_item->url ); ?>">
											<?php echo esc_html( $menu_item->title ); ?>
										</a>
									</li>
							<?php $count++; ?>
						<?php elseif ( 1 === $count ) : ?>
							<li class="menu-item py-2">
								<a class="text-decoration-none text-light" href="<?php echo esc_url( $menu_item->url ); ?>">
									<?php echo esc_html( $menu_item->title ); ?>
								</a>
							</li>
							<?php $count++; ?>
						<?php elseif ( 2 === $count ) : ?>
									<li class="menu-item py-2">
										<a class="text-decoration-none text-light" href="<?php echo esc_url( $menu_item->url ); ?>">
											<?php echo esc_html( $menu_item->title ); ?>
										</a>
									</li>
								</ul>
							</div>
							<?php $count = 0; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</nav>
			<!-- Copyright -->
			<div class="text-center p-4 text-white bg-secondary bg-gradient">
				<?php esc_html_e( '© 2021 Copyright:', '_s' ); ?>
				<a class="text-reset fw-bold" href="<?php echo esc_url( get_home_url() ); ?>"><?php esc_html_e( 'Mithun Rural Development Foundation', '_s' ); ?></a>
				<?php esc_html_e( 'All Rights Reserved', '_s' ); ?>
			</div>
			<!-- Copyright -->
		</footer>
		<a class="scroll-to-top" href="#"><i class="bi bi-arrow-up-circle fs-4"></i></a>
	</div><!-- #page -->

	<?php wp_footer(); ?>

</body>
</html>
