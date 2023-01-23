<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

// get the header.
get_header();
?>

	<main id="primary" class="site-main container-fluid px-md-5 mt-0 pt-0">
		<section class="container-fluid g-4 text-white px-md-5 pt-3" style="background-color: #198754;">
			<!--Section heading-->
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<h2 class="spi-card-title text-uppercase text-left my-3">
						<strong><?php echo esc_html( get_the_title() ); ?></strong>
					</h2>
					<!--Section description-->
					<?php $msg = esc_html( 'All fields marked with (*) are mandatory' ); ?>
					<?php if ( ! empty( $msg ) ) : ?>
						<p class="text-left spi-card-text mx-auto mb-4"><?php $msg; ?></p>
					<?php endif; ?>

					<?php $content = get_the_content(); ?>
					<?php $content = apply_filters( 'the_content', $content ); ?>
						<div class="row g-5">
							<div class="col-md-6 mb-5" style="background-color: #198754;">
								<?php
								echo wp_kses(
									$content,
									array(
										'form'     => array(
											'id'     => array(),
											'name'   => array(),
											'action' => array(),
											'method' => array(),
										),
										'div'      => array(
											'class' => array(),
											'id'    => array(),
											'style' => array(),
										),
										'input'    => array(
											'type'        => array(),
											'name'        => array(),
											'class'       => array(),
											'aria-label'  => array(),
											'value'       => array(),
											'required'    => array(),
											'id'          => array(),
											'placeholder' => array(),
										),
										'label'    => array(
											'class' => array(),
											'for'   => array(),
										),
										'textarea' => array(
											'class'       => array(),
											'placeholder' => array(),
											'name'        => array(),
											'id'          => array(),
											'rows'        => array(),
											'columns'     => array(),
										),
										'a'        => array(
											'href'  => array(),
											'title' => array(),
										),
										'button'   => array(
											'type'  => array(),
											'class' => array(),
											'name'  => array(),
											'value' => array(),
										),
										'br'       => array(),
										'em'       => array(),
										'strong'   => array(),
									)
								);
								?>
							</div>
							<div class="col-md-6 pb-4">
								<p></p>
								<div class="ratio ratio-16x9">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3685.955467556482!2d88.36194731428297!3d22.505853941090546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a027128402c3f61%3A0xcbc6db027edfc17a!2s172%2FA%2C%20Jodhpur%20Park%2C%20Kolkata%2C%20West%20Bengal%20700068!5e0!3m2!1sen!2sin!4v1639562120493!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
									</iframe>
								</div>
							</div>

						</div>

				<?php endwhile; ?>
			<?php endif; ?>
		</section>
		<!--Section: Contact v.2-->
	</main><!-- #main -->


<?php
get_footer();
