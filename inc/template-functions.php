<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _s_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', '_s_body_classes' );

/**
 * Add a meta description to the header.
 */
function _s_meta_description() {
	global $post;
	if ( is_singular() ) {
		$des_post = wp_strip_all_tags( $post->post_content );
		$des_post = strip_shortcodes( $des_post );
		$des_post = str_replace( array( "\n", "\r", "\t", '%\&*%' ), ' ', $des_post );
		$des_post = mb_substr( $des_post, 0, 300, 'utf8' );
		printf( '<meta name="description" content="%s">', esc_html( $des_post ) );
	}
	if ( is_home() ) {
		echo '<meta name="description" content="' . esc_html( get_bloginfo( 'description' ) ) . '" />' . "\n";
	}
	if ( is_category() ) {
		$des_cat = wp_strip_all_tags( category_description() );
		echo '<meta name="description" content="' . esc_html( $des_cat ) . '" />' . "\n";
	}
}
add_action( 'wp_head', '_s_meta_description' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function _s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', '_s_pingback_header' );


/**
 * Forms query to fetch custom post type.
 *
 * @param object $post WP_POST object.
 * @return array
 */
function _s_section_query( $post ) {
	$primary_thumbnail_id = get_post_thumbnail_id( $post->ID );

	if ( class_exists( 'MultiPostThumbnails' ) ) {
		$central_image_url = MultiPostThumbnails::get_post_thumbnail_url( $post->post_type, 'secondary-image', $post->ID );
		$sec_thumbnail_id  = MultiPostThumbnails::get_post_thumbnail_id( $post->post_type, 'secondary-image', $post->ID );
	}

	$posts_to_exclude = ( ! $sec_thumbnail_id ) ?
						array( $primary_thumbnail_id ) :
						array( $primary_thumbnail_id, $sec_thumbnail_id );
	$args_post        = array(
		'post__not_in'   => $posts_to_exclude,
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'post_mime_type' => 'image',
		'posts_per_page' => -1,
		'post_parent'    => $post->ID,
		'order'          => 'ASC',
	);
	$content_items    = new WP_Query( $args_post );

	return array(
		'content_items'     => $content_items,
		'central_image_url' => $central_image_url,
		'sec_thumbnail_id'  => $sec_thumbnail_id,
	);
}
