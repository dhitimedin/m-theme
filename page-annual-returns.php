<?php
/**
 * The template for displaying Annual Returns
 *
 * This is the template that displays all pages by default..
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
			<table>
				<tr>
					<th><?php esc_html_e( 'Year', '_s' ); ?></th>
					<th><?php esc_html_e( 'Annual Return', '_s' ); ?></th>
				</tr>
				<?php
				$args          = array(
					'post_type'      => 'section',
					'post_name__in'  => array( 'annual-return' ),
					'posts_per_page' => -1,
					'order'          => 'ASC',
				);
				$query_content = new WP_Query( $args );

				while ( $query_content->have_posts() ) :
					$query_content->the_post();

					$args_team     = array(
						'post_type'      => 'attachment',
						'post_status'    => 'inherit',
						'post_mime_type' => 'application/pdf',
						'order'          => 'ASC',
						'posts_per_page' => -1,
						'post_parent'    => $post->ID,
					);
					$query_members = new WP_Query( $args_team );
					while ( $query_members->have_posts() ) :
						$query_members->the_post();
						?>
						<tr>
							<td>
								<?php echo esc_html( $post->post_title ); ?>
							</td>
							<td>
								<a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" target="_blank">
									<?php esc_html_e( 'View', '_s' ); ?>
								</a>
							</td>
						</tr>
					<?php endwhile; ?>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</table>
		</div>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
