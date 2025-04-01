<?php
/**
 * Analytics Incite Modern functions and definitions
 */

if ( ! defined( 'ANALYTICS_INCITE_VERSION' ) ) {
	// Replace the version number as needed
	define( 'ANALYTICS_INCITE_VERSION', '1.0.0' );
}

if ( ! function_exists( 'analytics_incite_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function analytics_incite_setup() {
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages
		add_theme_support( 'post-thumbnails' );

		// Register nav menus
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'analytics-incite-modern' ),
				'footer-menu'  => esc_html__( 'Footer', 'analytics-incite-modern' ),
			)
		);

		// Switch default core markup to valid HTML5
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for full and wide align images
		add_theme_support( 'align-wide' );

		// Add support for responsive embeds
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls
		add_theme_support( 'custom-line-height' );

		// Add support for custom spacing
		add_theme_support( 'custom-spacing' );

		// Add support for custom units
		add_theme_support( 'custom-units' );

		// Add support for editor styles
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles
		add_editor_style( 'assets/css/editor-style.css' );

		// Add custom logo support
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
add_action( 'after_setup_theme', 'analytics_incite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function analytics_incite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'analytics_incite_content_width', 1200 );
}
add_action( 'after_setup_theme', 'analytics_incite_content_width', 0 );

/**
 * Register widget area.
 */
function analytics_incite_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'analytics-incite-modern' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'analytics-incite-modern' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'analytics-incite-modern' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add footer widgets here.', 'analytics-incite-modern' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'analytics-incite-modern' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add footer widgets here.', 'analytics-incite-modern' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'analytics-incite-modern' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add footer widgets here.', 'analytics-incite-modern' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'analytics_incite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function analytics_incite_scripts() {
	// Enqueue Google Fonts
	wp_enqueue_style( 'analytics-incite-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null );

	// Main stylesheet
	wp_enqueue_style( 'analytics-incite-style', get_stylesheet_uri(), array(), ANALYTICS_INCITE_VERSION );

	// Modern JavaScript
	wp_enqueue_script( 'analytics-incite-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), ANALYTICS_INCITE_VERSION, true );

	// Responsive menu script
	wp_enqueue_script( 'analytics-incite-responsive', get_template_directory_uri() . '/assets/js/responsive.js', array('jquery'), ANALYTICS_INCITE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'analytics_incite_scripts' );

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
 * Add modern features - defer JavaScript loading
 */
function analytics_incite_defer_scripts( $tag, $handle, $src ) {
	$defer_scripts = array( 
		'analytics-incite-navigation',
		'analytics-incite-responsive'
	);

	if ( in_array( $handle, $defer_scripts ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'analytics_incite_defer_scripts', 10, 3 );

/**
 * Add preconnect for Google Fonts.
 */
function analytics_incite_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'analytics_incite_resource_hints', 10, 2 );
