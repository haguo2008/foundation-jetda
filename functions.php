<?php
/**
 * Foundations functions and definitions
 *
 * @package Foundations
 */

if ( ! function_exists( 'foundations_setup' ) ) :

function foundations_setup() {
	
	load_theme_textdomain( 'jetda', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * This theme does not use a hard-coded <title> tag in the document head,
	 * WordPress will provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 1568, 9999 );
	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'jetda' ),
		'expanded' => __( 'Desktop Expanded Menu', 'jetda' ),
		'mobile'   => __( 'Mobile Menu', 'jetda' ),
		'footer'   => __( 'Footer Menu', 'jetda' ),
		'social'   => __( 'Social Menu', 'jetda' ),
	);
	register_nav_menus( $locations );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	$logo_width  = 300;
	$logo_height = 100;

	add_theme_support(
		'custom-logo',
		array(
			'height'               => $logo_height,
			'width'                => $logo_width,
			'flex-width'           => true,
			'flex-height'          => true,
			'unlink-homepage-logo' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
	
	$editor_stylesheet_path = './assets/css/style-editor.css';

	// Enqueue editor styles.
	add_editor_style( $editor_stylesheet_path );
}
endif; // foundations_setup
add_action( 'after_setup_theme', 'foundations_setup' );
function remove_css_id_filter($var) {
    return is_array($var) ? array_intersect($var, array('current-menu-item','menu-item')) : '';
} 
add_filter( 'page_css_class', 'remove_css_id_filter', 100, 1);
add_filter( 'nav_menu_item_id', 'remove_css_id_filter', 100, 1);
add_filter( 'nav_menu_css_class', 'remove_css_id_filter', 100, 1);
function foundation_widgets_init() {
	
}
add_action( 'widgets_init', 'foundation_widgets_init' );
//var_dump(get_stylesheet_directory_uri());
//var_dump(get_template_directory_uri());
function foundations_scripts() {
	// Add custom fonts
	//wp_enqueue_style( 'foundations-font', foundations_font_url(), array() );
	//wp_enqueue_style( 'foundations-font', foundations_font_url(), array() );
	//wp_enqueue_style( 'foundation', get_stylesheet_uri() );
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'foundation-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'foundation', get_template_directory_uri().'/assets/css/foundation.css' );
	wp_enqueue_style( 'nivo-style', get_template_directory_uri().'/assets/css/nivo-slider.css');
	// Icon Fonts
	wp_register_style( 'genericons-neue', get_template_directory_uri() . '/assets/fonts/genericons/Genericons-Neue.css', array(), $theme_version );
	wp_enqueue_style( 'genericons-neue' );
	wp_register_style( 'webui-popover', get_template_directory_uri() . '/assets/css/jquery.webui-popover.min.css', array(), $theme_version );
	wp_enqueue_style( 'webui-popover' );
	// Font Awesome
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/fonts/fontawesome/css/font-awesome.css', array(), $theme_version );
	wp_enqueue_style( 'font-awesome' );
	wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array() );
	wp_enqueue_script( 'jquery-webui-popover', get_template_directory_uri() . '/assets/js/jquery.webui-popover.min.js', array('jquery') );
	wp_enqueue_script( 'jquery-owlcarousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery') );
	wp_enqueue_script( 'jquery-nivo-slider', get_template_directory_uri() . '/assets/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'foundations-customscripts', get_template_directory_uri() . '/assets/js/custom.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'foundations_scripts' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function foundations_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'foundations_front_page_template' );


add_filter( 'translations_api', true );