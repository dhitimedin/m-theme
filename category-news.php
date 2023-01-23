<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>

		<header class="blog-title-header">
			<?php
			// Displays the section/category name ( e.g. News ).
			$heading = get_queried_object()->name;
			echo wp_kses(
				"<h1 class='entry-title'>$heading</h1>",
				array(
					'h1' => array(
						'class' => array(),
					),
				)
			);
			?>
		</header><!-- .page-header -->

		<div class="news-listing">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				* Include the Post-Type-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Type name) and that will be used instead.
				*/
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();
			?>
		</div>
	<?php else : ?>

		<?php
		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</main><!-- #main -->

<?php

get_footer();
