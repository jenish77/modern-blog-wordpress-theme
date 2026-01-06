<?php
/**
 * Modern Blog Theme functions and definitions
 */

if ( ! function_exists( 'modern_blog_setup' ) ) :
	function modern_blog_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'modern-blog-theme' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Custom logo support
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'modern_blog_setup' );

/**
 * Enqueue scripts and styles.
 */
function modern_blog_scripts() {
	wp_enqueue_style( 'modern-blog-style', get_stylesheet_uri() );
    
    // Google Fonts (Inter)
    wp_enqueue_style( 'modern-blog-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', array(), null );

    // Theme JS
    wp_enqueue_script( 'modern-blog-script', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'modern_blog_scripts' );

/**
 * Register widget area.
 */
function modern_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'modern-blog-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'modern-blog-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'modern_blog_widgets_init' );

// Include Customizer settings
require get_template_directory() . '/inc/customizer.php';

/**
 * Add reading time calculation
 */
function modern_blog_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Average reading speed 200 wpm

    return $reading_time . ' ' . ( $reading_time == 1 ? __( 'min read', 'modern-blog-theme' ) : __( 'mins read', 'modern-blog-theme' ) );
}

/**
 * Custom CSS for primary color from Customizer
 */
function modern_blog_custom_css() {
    $primary_color = get_theme_mod( 'modern_blog_primary_color', '#2563eb' );
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr( $primary_color ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'modern_blog_custom_css' );
