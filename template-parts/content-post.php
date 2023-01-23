<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_singular() ) : ?>
		<header class="entry-header">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			if ( has_post_thumbnail() ) :
				?>
				<div class="entry-meta">
					<?php echo '<strong>Posted In: </strong>' . wp_kses_post( get_the_post_thumbnail_caption() ); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
				<div class="single-post-image-container">
					<img class="mithun-single-post-image" src="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID ) ); ?>" alt="">
				</div>
				<?php
				endif;

				the_content();
			?>
		</div>
		<?php
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', '_s' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', '_s' ) . '</span> <span class="nav-title">%title</span>',
			)
		);
		?>

	<?php else : ?>
		<div class="news-item">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php _s_post_thumbnail(); ?>
			<?php else : ?>
				<div class="video-container">
					<?php
					echo wp_kses(
						get_the_content(),
						array(
							'div'    => array(
								'style'       => array(),
							),
							'iframe' => array(
								'src'             => array(),
								'frameborder'     => array(),
								'width'           => array(),
								'height'          => array(),
								'title'           => array(),
								'allow'           => array(),
								'allowfullscreen' => array(),
							),
						)
					);
					?>
				</div>
			<?php endif; ?>
			<header>
				<?php
				the_title( '<h2 class="entry-title"><a class="news-title" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				if ( has_post_thumbnail() ) :
					?>
					<div class="entry-meta">
						<?php echo '<strong>Posted In: </strong>' . wp_kses_post( get_the_post_thumbnail_caption() ); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-content">
					<?php
					echo wp_kses(
						'<i>' . wp_trim_words( get_the_content(), 30 ) . '</i>',
						array( 'i' => array() )
					);
					?>
				</div><!-- .entry-content -->
			<?php endif; ?>
		</div>
	<?php endif; ?>


</article><!-- #post-<?php the_ID(); ?> -->
