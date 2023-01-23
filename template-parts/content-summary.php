<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

// Gets all images, except featured and secondary, attached to the current custom post.
$query_obj = _s_section_query( $post );

$read_more_link = get_site_url() . "/$post->post_name";

?>
<div class="container">
	<div class="section-title row justify-content-md-center">
		<?php
		if ( ( ! $query_obj['content_items']->have_posts() ) && ( $query_obj['sec_thumbnail_id'] ) ) :
			?>
			<div class="col-lg-8 col-md-12">
				<h2 class="title text-danger fw-bolder"><?php echo wp_kses_post( $post->post_title ); ?></h2>
				<div class="paragraph">
					<p><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4">
				<div class="ml-70 mb-md-30">
					<div class="about-thumb">
						<img src="<?php echo esc_url( $query_obj['central_image_url'] ); ?>" alt="">
					</div>
				</div>
			</div>
		<?php else : ?>

			<div class="col-md-12 text-center mb-60">
				<h2 class="title text-danger fw-bolder"> <span><?php echo wp_kses_post( $post->post_title ); ?></span></h2>
				<div class="paragraph">
					<p><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="section-content row">
		<?php
		$initiative_block = '';
		$initiatives      = get_post_meta( $post->ID, 'initiatives' );
		foreach ( $initiatives as $initiative ) {
			$initiative_block .= '<a  class="border-button" href="#">'
									. "<span>$initiative</span>"
								. '</a>';
		}

		$center_content = '<div class="col-md-6 col-lg-6 col-xl-4 text-center">
							<img src="' . $query_obj['central_image_url'] . '" alt="" class="mb-75">'
							. (
								( false === $initiatives ) ?
								"<a href='$read_more_link' class='main-button text-decoration-none text-white'>Read More</a>" :
								''
							)
						. '</div>';

		while ( $query_obj['content_items']->have_posts() ) :
			$query_obj['content_items']->the_post();

			$half_count      = ( $query_obj['content_items']->post_count / 2 );
			$crnt_post_count = $query_obj['content_items']->current_post;
			$is_greater_than = ( $crnt_post_count >= $half_count );
			echo ( ( 0 === $crnt_post_count ) || ( $crnt_post_count === $half_count ) ) ?
						'<div class="col-md-6 col-lg-6 col-xl-4">' : '<div class="clearfix"></div>';

			$content_icon = '<div class="iconsmain">'
								. '<img src="' . esc_attr( $post->guid ) . '" alt="">'
							. '</div>';
			$content_text = '<div class="side-box">' .
								'<h5 class="text-dark ' . ( ( ! $is_greater_than ) ? 'text-end' : '' ) . '">' .
									$post->post_title .
								'</h5>' .
								'<p class="' . ( ( ! $is_greater_than ) ? 'text-end' : '' ) . '">' .
									$post->post_excerpt .
								'</p>
							</div>';
			?>
			<div class="<?php echo esc_attr( ( $is_greater_than ) ? 'main-iconbox-left' : 'main-iconbox-right' ); ?>" >
				<?php echo ( $is_greater_than) ? $content_icon . $content_text : $content_text . $content_icon; ?>
			</div>

			<?php
				echo (
					( ( $crnt_post_count + 1 === $query_obj['content_items']->post_count ) || ( ( $crnt_post_count + 1 ) === $half_count ) ) ?
					'</div>' :
					''
				);

				echo ( ( $crnt_post_count + 1 ) === $half_count ) ? $center_content : '';

		endwhile;

		if ( ! empty( $initiative_block ) ) :
			?>
			<div class="innovation-initiatives">
				<?php echo $initiative_block; ?>
			</div>
			<div class="col-md-12 col-lg-12 col-xl-12 text-center pt-4">
				<a href="<?php echo esc_url( $read_more_link ); ?>" class="main-button text-decoration-none text-white">Read More</a>
			</div>
		<?php endif; ?>
	</div>
</div>

