<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'py-0 my-0' ); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

		<header id="masthead" class="site-header">
			<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo           = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			?>
			<nav class="navbar navbar-expand-lg navbar-light bg-white mdrf-header-container">
				<div class="container-fluid">
					<a class="navbar-brand py-4" href="<?php echo esc_url( get_home_url() ); ?>" style="max-width:60%;"> <!-- .site-branding -->
						<?php
						if ( has_custom_logo() ) :
							?>
							<picture>
								<source srcset="<?php echo esc_url( wp_get_attachment_url( $custom_logo_id ) ); ?>" media="(min-width: 1024px)">
								<source srcset="<?php echo esc_url( wp_get_attachment_url( $custom_logo_id ) ); ?>" media="(min-width: 300px)">
								<source srcset="<?php echo esc_url( wp_get_attachment_url( $custom_logo_id ) ); ?>" media="(min-width: 150px)">
								<img srcset="<?php echo esc_url( wp_get_attachment_url( $custom_logo_id ) ); ?>" class="bg-white" style="max-height:90px;" alt="Mithun Test Project" />
							</picture>
						<?php endif; ?>
					</a>
					<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'menu-1',
							'depth'           => 0, // 1 = no dropdowns, 2 = with dropdowns.
							'container'       => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarTogglerDemo02',
							'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
							'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
							'walker'          => new WP_Bootstrap_Navwalker(),
						)
					);

					?>
				</div>
			</nav><!-- #site-navigation -->


		</header><!-- #masthead -->
