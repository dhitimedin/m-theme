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

get_header();
?>

	<main id="primary" class="site-main">


		<div class="card text-white d-none d-md-block bg-light">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/img/bg1.jpg' ); ?>" class="card-img" alt="...">
			<div class="home-img-overlay d-none d-md-block">
				<h1 class="home-card-header">Empowering Rural Communities<br />&<br />Transforming Lives</h1>
			</div>
		</div>
		<div class="card border-0 d-md-none bg-light m-0 p-0">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/img/bg1.jpg' ); ?>" class="card-img-top" alt="...">
			<div class="home-img-overlay d-md-none bg-light">
				<h1 class="home-card-header fw-bolder">
					Empowering Rural Communities<br/>
					&<br/>
					Transforming Lives
				</h1>
			</div>
		</div>

	<?php

		$args          = array(
			'post_type'      => 'section',
			'post_name__in'  => array(
				'what-we-do',
				'our-impact',
				'our-innovations',
				'our-projects',
			),
			'posts_per_page' => -1,
			'order'          => 'ASC',
		);
		$query_content = new WP_Query( $args );
		while ( $query_content->have_posts() ) :
			$query_content->the_post();

			$background_image_url = get_the_post_thumbnail_url( get_the_ID() );
			?>
			<section class="py-5" style="background-image: url(<?php echo esc_url( $background_image_url ); ?>); background-size: cover">
				<?php get_template_part( 'template-parts/content', 'summary' ); ?>
			</section>
			<?php
		endwhile;
		wp_reset_postdata();

		get_template_part( 'template-parts/content', 'partner' );
		?>

	</main><!-- #main -->

<?php

// get_sidebar(); .
get_footer();
