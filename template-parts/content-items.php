<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

$new_args = array(
	'post_type'      => 'section',
	'post_name__in'  => array( $args['page_name'] ),
	'posts_per_page' => -1,
	'order'          => 'ASC',
);
$query_content = new WP_Query( $new_args );

while ( $query_content->have_posts() ) :
	$query_content->the_post();

	if ( ! in_array( $post->post_name, array( 'success-stories', 'our-partners' ), true ) ) :

		// Gets all images, except featured and secondary, attached to the current custom post.
		$query_obj = _s_section_query( $post );

		$initiative_block = '';
		$initiatives      = get_post_meta( $post->ID, 'initiatives' );
		foreach ( $initiatives as $initiative ) {
			$initiative_block .= "<a class='border-button' href='#'>
									<span>$initiative</span>
								</a>";
		}

		?>
		<div class="container overflow-auto py-3">
			<?php
			while ( $query_obj['content_items']->have_posts() ) :
				$query_obj['content_items']->the_post();
				?>

				<div class = "mithun-page-items">
					<div class="iconsmain">
						<img src="<?php echo esc_url( $post->guid ); ?>" alt="">
					</div>
					<div class="side-box">
						<h5 class="text-dark"><?php echo wp_kses_post( $post->post_title ); ?></h5>
						<p class=""><?php echo wp_kses_post( $post->post_content ); ?></p>
					</div>
				</div>

			<?php endwhile; ?>

			<?php if ( ! empty( $initiative_block ) ) : ?>
					<div class="innovation-initiatives">
						<?php echo $initiative_block; ?>
					</div>

			<?php endif; ?>

		</div>
	<?php endif; ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
