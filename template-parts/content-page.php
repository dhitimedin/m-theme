<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'template-parts/content', 'header' ); ?>
	<div class="container overflow-auto py-3">
		<?php
		if ( 'about-us' === $post->post_name ) {
			get_template_part( 'template-parts/content', 'about-us' );
		}
		if ( has_post_thumbnail( $post->ID ) ) :
			?>
			<div class="mithun-main-image-container">
				<img class="mithun-main-image" src="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID ) ); ?>" alt="">
			</div>
			<?php
		endif;
		the_content();
		?>
	</div><!-- .entry-content -->
	<?php
	if ( in_array( $post->post_name, array( 'our-innovations', 'what-we-do', 'about-us' ), true ) ) {
		get_template_part( 'template-parts/content', 'items', array( 'page_name' => $post->post_name ) );
	}

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
			'after'  => '</div>',
		)
	);
	?>
</article><!-- #post-<?php the_ID(); ?> -->
