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

    // Add Primary Color Picker
    $wp_customize->add_setting( 'modern_blog_primary_color', array(
        'default'           => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'modern_blog_primary_color', array(
        'label'    => __( 'Primary Theme Color', 'modern-blog-theme' ),
        'section'  => 'colors', // Core section
    ) ) );
    // Add Social Share Options Section
    $wp_customize->add_section( 'modern_blog_social_share_options', array(
        'title'    => __( 'Social Share Options', 'modern-blog-theme' ),
        'priority' => 135,
    ) );

    $social_platforms = array(
        'facebook' => __( 'Facebook', 'modern-blog-theme' ),
        'twitter'  => __( 'Twitter', 'modern-blog-theme' ),
        'linkedin' => __( 'LinkedIn', 'modern-blog-theme' ),
        'whatsapp' => __( 'WhatsApp', 'modern-blog-theme' ),
    );

    foreach ( $social_platforms as $id => $label ) {
        $wp_customize->add_setting( 'modern_blog_share_' . $id, array(
            'default'           => true,
            'sanitize_callback' => 'modern_blog_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'modern_blog_share_' . $id, array(
            'label'    => sprintf( __( 'Enable %s Sharing', 'modern-blog-theme' ), $label ),
            'section'  => 'modern_blog_social_share_options',
            'type'     => 'checkbox',
        ) );
    }
}
add_action( 'customize_register', 'modern_blog_customize_register' );

/**
 * Sanitize checkbox input
 */
function modern_blog_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
