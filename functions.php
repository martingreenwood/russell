<?php
/**
 * russell functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package russell
 */

if ( ! function_exists( 'russell_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function russell_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on russell, use a find and replace
	 * to change 'russell' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'russell', get_template_directory() . '/languages' );

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
	add_image_size( 'cover1600', 1600, 450, true );
	add_image_size( 'devfeat', 620, 300, true );
	/*
	 * Enable support for Logo in Customiser.
	 *
	 * @link https://make.wordpress.org/core/tag/4-5/
	 */
	add_theme_support( 'site-logo' );

	function russell_theme_customizer( $wp_customize ) {
		$wp_customize->add_section( 'russell_logo_section' , array(
			'title'       => __( 'Logo', 'themeslug' ),
			'priority'    => 30,
			'description' => 'Upload a logo to replace the default site name and description in the header',
		) );
		$wp_customize->add_setting( 'russell_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
				'label'    => __( 'Logo', 'themeslug' ),
				'section'  => 'russell_logo_section',
				'settings' => 'russell_logo',
		) ) );

	}
	add_action( 'customize_register', 'russell_theme_customizer' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'russell' ),
		'footer' => esc_html__( 'Footer', 'russell' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

}
endif;
add_action( 'after_setup_theme', 'russell_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function russell_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'russell_content_width', 640 );
}
add_action( 'after_setup_theme', 'russell_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function russell_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'russell' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'russell' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'russell_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

if (!is_admin()) add_action("wp_enqueue_scripts", "russell_jquery_enqueue", 11);
function russell_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

function russell_scripts() {
	wp_enqueue_style( 'font-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-style', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' );

	wp_enqueue_style( 'russell-style', get_stylesheet_uri() );

	wp_enqueue_script( 'russ-js', get_template_directory_uri() . '/js/russ.js', '', '1', true );

	if (is_front_page() || is_singular( 'planning' ) || is_singular( 'developments' )) {
	wp_enqueue_script( 'russ-map', '//maps.googleapis.com/maps/api/js?sensor=false', '', '', true );
	}

	if (is_front_page()) {
	wp_enqueue_script( 'russ-dev-map', get_template_directory_uri() . '/js/map-home.js', '', '1', true );
	}

	if (is_singular( 'planning' ) || is_singular( 'developments' )) {
	wp_enqueue_script( 'russ-base-map', get_template_directory_uri() . '/js/map-default.js', '', '1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'russell_scripts' );

/*=====================================
=            ADMIN ENQUEUE            =
=====================================*/

function russell_admin_enqueue() {
	wp_enqueue_style( 'russ-admin-css', get_template_directory_uri() . '/css/russ-admin.css');
	wp_enqueue_script( 'russ-admin-js', get_template_directory_uri() . '/js/russ-admin.js', '', '1', true );
}
add_action('admin_enqueue_scripts', 'russell_admin_enqueue');

/**
 * Custom Excerpt
 */
function russell_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'russell_excerpt_length', 999 );

/**
 * Replace the [...] wordpress puts in when using the the_excerpt() method.
 */
function new_excerpt_more($excerpt) 
{
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*====================================================
=            Remove Comments from toolbar            =
====================================================*/

function russ_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'russ_admin_bar_render' );

/*============================================
=            UNHOOK JETPACK SHARE            =
============================================*/

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );


/**
 * Setup custom post types.
 */
require get_template_directory() . '/inc/cpts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load ACF GF.
 */
require get_template_directory() . '/lib/acf-gravity_forms.php';

/**
 * Load Menu Builder.
 */
require get_template_directory() . '/inc/dev-menu.php';
require get_template_directory() . '/inc/locations-menu.php';
require get_template_directory() . '/inc/planning-menu.php';
