<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( '_s_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _s_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change '_s' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_s', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary Menu', '_s' ),
				'menu-2' => esc_html__( 'Secondary Menu', '_s' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'_s_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', '_s' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', '_s' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _s_scripts() {

	// Adding Bootstrap and fontawesome to the Theme.
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'bootstrapicon-style', get_template_directory_uri() . '/icons/font/bootstrap-icons.css', array(), _S_VERSION );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), _S_VERSION, true );
	// Adding Bootstrap to the Theme - End.

	wp_enqueue_style( '_s-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( '_s-style', 'rtl', 'replace' );

	wp_enqueue_script( '_s-coverflow-carousel', get_template_directory_uri() . '/js/carousel.js', array(), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}



/**
 * Custom Code added here
 */



/**
 * Register Custom Navigation Walker
 *
 * Introduced in version 1.1
 */
function register_navwalker() {

	if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
		// File does not exist... return an error.
		return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
	} else {
		// File exists... require it.
		require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
	}

}
add_action( 'after_setup_theme', 'register_navwalker' );

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
	if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
		if ( array_key_exists( 'data-toggle', $atts ) ) {
			unset( $atts['data-toggle'] );
			$atts['data-bs-toggle'] = 'dropdown';
		}
	}
	return $atts;
}


/**
* Added since 1.0.1 get search form in the navbar
*/
if ( ! function_exists( 'add_search_box' ) ) {

	/**
	 * Adds custom search box.
	 *
	 * @param string $items html string for search box.
	 * @param object $args  stdClass object.
	 * @return string.
	 */
	function add_search_box( $items, $args ) {
		if ( 'menu-1' === $args->theme_location ) {
			ob_start();
			get_search_form();
			$searchform = ob_get_contents();
			ob_end_clean();

			$items .= '<li id="menu-item-search">' . $searchform . '</li>';

			return $items;
		} else {
			return $items;
		}
	}
	add_filter( 'wp_nav_menu_items', 'add_search_box', 10, 2 );
}


/**
 * Custom Post to add content to home page
 */
add_action( 'init', 'custom_homepage_post' );

/**
 * Register a Custom post type for.
 */
function custom_homepage_post() {
	$labels = array(
		'name'               => _x( 'Homepage Sections', 'post type general name' ),
		'singular_name'      => _x( 'Homepage', 'post type singular name' ),
		'menu_name'          => _x( 'Homepage Sections', 'admin menu' ),
		'name_admin_bar'     => _x( 'Homepage', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'Homepage' ),
		'add_new_item'       => __( 'Name' ),
		'new_item'           => __( 'New Section' ),
		'edit_item'          => __( 'Edit Section' ),
		'view_item'          => __( 'View Section' ),
		'all_items'          => __( 'All Sections' ),
		'featured_image'     => __( 'Featured Image', 'text_domain' ),
		'search_items'       => __( 'Search Section' ),
		'parent_item_colon'  => __( 'Parent Section:' ),
		'not_found'          => __( 'No content found.' ),
		'not_found_in_trash' => __( 'No content found in Trash.' ),
	);

	$args = array(
		'labels'              => $labels,
		'menu_icon'           => 'dashicons-format-gallery',
		'description'         => __( 'Description.' ),
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => true,
		'menu_position'       => null,
		'exclude_from_search' => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
	);

	register_post_type( 'section', $args );
}


/**
 * For Multiple featured images
 */

if ( class_exists( 'MultiPostThumbnails' ) ) {
	$types = array( 'post', 'page', 'section' );
	foreach ( $types as $p_type ) {
		new MultiPostThumbnails(
			array(
				// Replace [YOUR THEME TEXT DOMAIN] below with the text domain of your theme (found in the theme's `style.css`).
				'label'     => __( 'Secondary Image', '_s' ),
				'id'        => 'secondary-image',
				'post_type' => $p_type,
			)
		);
	}
}


if ( ! function_exists( 'mithun_attachment_fields_to_edit' ) ) {
	/**
	 * Adds image number metabox to the media details
	 *
	 * @param array  $form_fields Array of fields of a custom post.
	 * @param object $post       WP_Post object.
	 * @return array
	 */
	function mithun_attachment_fields_to_edit( $form_fields, $post ) {
		$form_fields['image_number'] = array(
			'label' => __( 'Image Number' ),
			'input' => 'text', // this is default if "input" is omitted.
			'value' => get_post_meta( $post->ID, '_image_number', true ),
		);
		return $form_fields;
	}
	add_filter( 'attachment_fields_to_edit', 'mithun_attachment_fields_to_edit', null, 2 );
}

if ( ! function_exists( 'mithun_attachment_fields_to_save' ) ) {
	/**
	 * Filters the attachment fields to be saved.
	 *
	 * @param array $post       An array of post data.
	 * @param array $attachment An array of attachment metadata.
	 * @return array
	 */
	function mithun_attachment_fields_to_save( $post, $attachment ) {
		if ( isset( $attachment['image_number'] ) ) {
			update_post_meta( $post['ID'], '_image_number', $attachment['image_number'] );
		}
		return $post;
	}
	add_filter( 'attachment_fields_to_save', 'mithun_attachment_fields_to_save', null, 2 );
}
