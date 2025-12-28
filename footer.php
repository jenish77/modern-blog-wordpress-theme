	<footer id="colophon" class="site-footer" style="background: #fff; padding: 2rem 0; margin-top: 3rem; border-top: 1px solid #e5e7eb;">
        <div class="container">
            <div class="site-info" style="text-align: center; color: #6b7280;">
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
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
