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
	<main id="primary" class="site-main py-0 my-0">
		<?php
		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', 'page' );
		} // End of the loop.

		if ( ! in_array( $post->post_name, array( 'gallery' ), true ) ) {
			get_template_part( 'template-parts/content', 'partner' );
		}
		?>
	</main><!-- #main -->
<?php
get_footer();
