<?php
/**
 * Template part for displaying partner carousel.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

$args          = array(
	'post_type'      => 'section',
	'post_name__in'  => array( 'our-partners' ),
	'posts_per_page' => -1,
	'order'          => 'ASC',
);
$query_content = new WP_Query( $args );
while ( $query_content->have_posts() ) :
	$query_content->the_post();

	$background_image_url = get_the_post_thumbnail_url( get_the_ID() );
	?>
	<section class="py-5" style="background-image: url(<?php echo esc_url( $background_image_url ); ?>); background-size: cover">
		<?php get_template_part( 'template-parts/content', 'slider' ); ?>
	</section>
	<?php

endwhile;
wp_reset_postdata();
