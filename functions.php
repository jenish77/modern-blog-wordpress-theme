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

/**
 * Add inline script to prevent flash of unstyled theme
 */
function modern_blog_theme_js_check() {
    ?>
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (theme === 'dark' || (!theme && systemPrefersDark)) {
                document.body.classList.add('dark-mode');
            }
        })();
    </script>
    <?php
}
add_action( 'wp_head', 'modern_blog_theme_js_check', 1 );
/**
 * Add social share links
 */
function modern_blog_social_share() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    $post_url   = urlencode( get_permalink() );
    $post_title = urlencode( get_the_title() );

    $share_links = array();

    if ( get_theme_mod( 'modern_blog_share_facebook', true ) ) {
        $share_links['facebook'] = array(
            'url'  => "https://www.facebook.com/sharer/sharer.php?u={$post_url}",
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
            'label' => __( 'Facebook', 'modern-blog-theme' ),
        );
    }

    if ( get_theme_mod( 'modern_blog_share_twitter', true ) ) {
        $share_links['twitter'] = array(
            'url'  => "https://twitter.com/intent/tweet?text={$post_title}&url={$post_url}",
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>',
            'label' => __( 'Twitter', 'modern-blog-theme' ),
        );
    }

    if ( get_theme_mod( 'modern_blog_share_linkedin', true ) ) {
        $share_links['linkedin'] = array(
            'url'  => "https://www.linkedin.com/shareArticle?mini=true&url={$post_url}&title={$post_title}",
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
            'label' => __( 'LinkedIn', 'modern-blog-theme' ),
        );
    }

    if ( get_theme_mod( 'modern_blog_share_whatsapp', true ) ) {
        $share_links['whatsapp'] = array(
            'url'  => "https://api.whatsapp.com/send?text={$post_title}%20{$post_url}",
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 1 1-7.6-13.5 8.38 8.38 0 0 1 3.8.9L21 3z"></path></svg>',
            'label' => __( 'WhatsApp', 'modern-blog-theme' ),
        );
    }

    if ( empty( $share_links ) ) {
        return;
    }

    echo '<div class="social-share">';
    echo '<h3 class="share-title">' . esc_html__( 'Share this post:', 'modern-blog-theme' ) . '</h3>';
    echo '<div class="share-links">';
    foreach ( $share_links as $id => $link ) {
        printf(
            '<a href="%s" class="share-link share-%s" target="_blank" rel="noopener noreferrer" title="%s">%s<span class="screen-reader-text">%s</span></a>',
            $link['url'],
            esc_attr( $id ),
            esc_attr( sprintf( __( 'Share on %s', 'modern-blog-theme' ), $link['label'] ) ),
            $link['icon'],
            esc_html( $link['label'] )
        );
    }
    echo '</div>';
    echo '</div>';
}
