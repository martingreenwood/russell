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

	add_theme_support( 'custom-logo' );
	
	add_image_size( 'grid-square', 0, 263 );

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
	$GLOBALS['content_width'] = apply_filters( 'russell_content_width', 960 );
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

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Caae Studies', 'russell' ),
		'id'            => 'sidebar-2',
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
	wp_enqueue_style( 'font-style', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' );

	wp_enqueue_style( 'russell-style', get_stylesheet_uri() );

	wp_enqueue_script( 'russ-js', get_template_directory_uri() . '/js/russ.js', '', '1', true );
	//wp_enqueue_script( 'russ-search', get_template_directory_uri() . '/js/search.js', '', '1', true );
	wp_enqueue_script( 'russ-fa', '//use.fontawesome.com/1933b7f144.js', '', '1', true );

	if (is_front_page() || is_singular( 'planning' ) || is_singular( 'developments' )) {
	wp_enqueue_script( 'russ-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyBO09_0XtvNzf8QkZWH_UHDyvLwwVCm_rY', '', '', true );
	}

	if (is_front_page()) {
	wp_enqueue_script( 'russ-dev-map', get_template_directory_uri() . '/js/map-home.js', '', '1', true );
	}

	if (is_singular( 'developments' )) {
	wp_enqueue_script( 'russ-local-map', get_template_directory_uri() . '/js/map-locality.js', '', '1', true );
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


/*==================================
=            ACF FILTER            =
==================================*/

//add_filter( 'json_query_vars', 'filterJsonQueryVars' );
function filterJsonQueryVars( $vars ) {
	$vars[] = 'meta_value';
	return $vars;
}

//add_action( 'rest_api_init', 'russell_post_meta_register' );
function russell_post_meta_register() {
	register_api_field( 'post',
		'testing',
		array(
			'get_callback'    => 'russell_get_post_meta',
			'update_callback' => null,
			'schema'          => null,
		)
	);
}

function russell_get_post_meta( $object, $field_name, $request ) {
	return get_post_meta( $object[ 'id' ], $field_name, true );
}

//add_filter( 'rest_query_vars', 'russell_allow_meta' );
function russell_allow_meta( $valid_vars ) {
	$valid_vars = array_merge( $valid_vars, array( 'meta_key', 'meta_value' ) );
	return $valid_vars;
}

/*============================
=            META            =
============================*/

function russell_add_meta( $valid_vars ) { ?><meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php }
add_filter( 'wp_head', 'russell_add_meta', 0 );

/*===============================
=            HEATMAP            =
===============================*/

function russell_heatmap() { 
if (is_front_page() || is_single(146) || is_single(144)) {
?><!-- Hotjar Tracking Code for https://www.russell-armer.co.uk/ -->
<script>
(function(h,o,t,j,a,r){
	h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	h._hjSettings={hjid:356354,hjsv:5};
	a=o.getElementsByTagName('head')[0];
	r=o.createElement('script');r.async=1;
	r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	a.appendChild(r);
})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script><?php }
}
add_filter( 'wp_head', 'russell_heatmap', 99 );


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
