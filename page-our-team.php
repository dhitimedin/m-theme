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

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<div class="container">
			<?php
			// Get the custom posts.
			$args = array(
				'post_type'      => 'section',
				'post_name__in'  => array( 'team' ),
				'fields'         => 'ids',
				'posts_per_page' => -1,
				'order'          => 'ASC',
			);

			$query_content = new WP_Query( $args );

			$args_team = array(
				'post_type'       => 'attachment',
				'post_status'     => 'inherit',
				'post_mime_type'  => 'image',
				'meta_key'        => '_image_number',
				'orderby'         => 'meta_value_num',
				'post_parent__in' => $query_content->posts,
				'order'           => 'ASC',
				'posts_per_page'  => -1,
			);

			$query_members = new WP_Query( $args_team );

			// Loops through all the results.
			if ( $query_members->have_posts() ) :
				while ( $query_members->have_posts() ) :
					$query_members->the_post();
					?>
					<div class="mithun-team-grid-blocks">
						<div class="border-0">
							<picture class="border-0">
								<source srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" media="(min-width: 1400px)">
								<source srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" media="(min-width: 769px)">
								<source srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" media="(min-width: 577px)">
								<img srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" alt="responsive image" class="img-fluid">
							</picture>
						</div>
						<div>
							<h1 class="name text-danger fw-bolder"><?php echo wp_kses_post( $post->post_title ); ?></h1>
							<h5 class="fw-bolder pb-2"><?php echo wp_kses_post( $post->post_excerpt ); ?></h5>
							<p class="lh-lg"><?php echo wp_kses_post( $post->post_content ); ?></p>
						</div>
					</div>

				<?php endwhile; ?>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</div>
	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
