	<footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info">
                <?php
                 $footer_text = get_theme_mod( 'modern_blog_footer_text', __( '© 2024 Modern Blog Theme. All rights reserved.', 'modern-blog-theme' ) );
                 echo esc_html( $footer_text );
                ?>
                <br>
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'modern-blog-theme' ) ); ?>">
                    <?php
                    /* translators: %s: CMS Name, i.e. WordPress. */
                    printf( esc_html__( 'Proudly powered by %s', 'modern-blog-theme' ), 'WordPress' );
                    ?>
                </a>
            </div><!-- .site-info -->
        </div>
        
        <a href="#" id="back-to-top" class="back-to-top" title="<?php esc_attr_e( 'Back to Top', 'modern-blog-theme' ); ?>">
            <span class="screen-reader-text"><?php esc_html_e( 'Back to Top', 'modern-blog-theme' ); ?></span>
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
        </a>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
