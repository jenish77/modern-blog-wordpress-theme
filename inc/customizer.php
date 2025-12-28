<?php
/**
 * Modern Blog Theme Customizer
 */

function modern_blog_customize_register( $wp_customize ) {
	// Add Footer Text Section
    $wp_customize->add_section( 'modern_blog_footer_options', array(
        'title'    => __( 'Footer Options', 'modern-blog-theme' ),
        'priority' => 130,
    ) );

    $wp_customize->add_setting( 'modern_blog_footer_text', array(
        'default'           => __( '© 2024 Modern Blog Theme. All rights reserved.', 'modern-blog-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( 'modern_blog_footer_text', array(
        'label'    => __( 'Footer Copyright Text', 'modern-blog-theme' ),
        'section'  => 'modern_blog_footer_options',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'modern_blog_customize_register' );
