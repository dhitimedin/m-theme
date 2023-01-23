<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
	<?php get_template_part( 'template-parts/content', 'header' ); ?>
	<div class="container">
		<h3 class="text-dark text-center fs-1 fw-bolder lh-sm p-4">
			<?php echo wp_kses_post( get_post( get_post_thumbnail_id() )->post_excerpt ); ?>
		</h3><!-- .entry-content -->

		<?php
		if ( has_post_thumbnail( $post->ID ) ) :
			$image = get_the_post_thumbnail_url( $post->ID );
			?>
			<div class="row">
				<div id="impact-featured-image" class="col-md-12 text-center">
					<img src="<?php echo esc_url( $image ); ?>" alt="">
				</div>
			</div>

			<?php
		endif;

		$args          = array(
			'post_type'      => 'section',
			'post_name__in'  => array( 'our-impact' ),
			'posts_per_page' => -1,
			'order'          => 'ASC',
		);
		$query_content = new WP_Query( $args );

		while ( $query_content->have_posts() ) :
			$query_content->the_post();

			if ( ! in_array( $post->post_name, array( 'success-stories', 'our-partners' ), true ) ) :

				// Gets all images, except featured and secondary, attached to the current custom post.
				$query_obj = _s_section_query( $post );

				while ( $query_obj['content_items']->have_posts() ) :
					$query_obj['content_items']->the_post();

					$post_count   = $query_obj['content_items']->current_post;
					$content_left = ( 0 === $post_count % 2 ) ?
								'impact-items-left' :
								'impact-items-right';
					$content      = '<div class="side-box">
									<h4 class="text-dark">' . esc_html( $post->post_title ) . '</h4>
									<p>' . wp_kses_post( $post->post_content ) . '</p>
								</div>';
					$bullet       = '<div class="' .
									esc_attr(
										( 0 === $post_count % 2 ) ?
										'float-bullet-left' :
										'float-bullet-right'
									) .
								'">
									<img src="' . esc_attr( $post->guid ) . '" alt="">
								</div>';

					?>
					<div class="row">
						<div class="<?php echo esc_attr( $content_left ); ?>">
							<?php
							echo wp_kses_post(
								( 0 === $post_count % 2 ) ?
								( $content . $bullet ) :
								( $bullet . $content )
							);
							?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
	<?php wp_reset_postdata(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
