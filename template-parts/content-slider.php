<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>
<!-- Section: Services -->
<div class="container pt-90">
	<div class="row justify-content-md-center">
		<div class="col-md-8 text-center mb-60">
			<div class="title-wrapper">
				<h2 class="title text-danger fw-bolder">
					<span class="">
						<?php echo wp_kses_post( $post->post_title ); ?>
					</span>
				</h2>
				<p><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
			</div>
		</div>
	</div>
</div>

<?php

/**
 * Writes log to debug.log
 */
$carousel_inner = '';
$post_count = 0;
if ( 'home-page-slider' !== $post->post_name ) :

	// Gets all images, except featured and secondary, attached to the current custom post.
	$query_obj = _s_section_query( $post );

	// Partner Section Starts.
	$post_count = $query_obj['content_items']->found_posts;
	$count      = ( $post_count <= 3 ) ? 1 : 0;
	?>

	<div class="mithun-coverflow-container-partner">
		<?php if ( $post_count <= 3 ) : ?>
		<i class="bi bi-chevron-left icon-left-coverflow-partner-3"></i>
		<?php else : ?>
			<i class="bi bi-chevron-left icon-left-coverflow-partner"></i>
		<?php endif; ?>

		<div class="mithun-coverflow-wrapper-partner" <?php echo ( $post_count <= 3 ) ? 'data-autoplay="false"' : 'data-autoplay="true"'; ?> >

			<?php
			while ( $query_obj['content_items']->have_posts() ) :
				$query_obj['content_items']->the_post();
				?>
				<div class="coverflow-item-partner coverflow-helper-partner-<?php echo esc_attr( ( $count < 5 ) ? ( $count + 1 ) : 'other' ); ?>">
					<a class="mithun-link-decoration" style="height:100%;" href="<?php esc_url( $post->post_title ); ?>" target="_blank">
						<picture>
							<source srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" media="(min-width: 1400px)">
							<source srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" media="(min-width: 769px)">
							<source srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" media="(min-width: 577px)">
							<img srcset="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" class="mx-auto" style="object-fit: contain;height:100%;" alt="responsive image" loading="lazy">
						</picture>
					</a>
				</div>
				<?php
				++$count;
			endwhile;
			?>
		</div>
			<?php if ( $post_count <= 3 ) : ?>
				<i class="bi bi-chevron-right icon-right-coverflow-partner-3"></i>
			<?php else : ?>
				<i class="bi bi-chevron-right icon-right-coverflow-partner"></i>
			<?php endif; ?>
	</div>
<?php endif; ?>
