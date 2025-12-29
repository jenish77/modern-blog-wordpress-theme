<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="container">
            <section class="error-404 not-found" style="text-align: center; padding: 4rem 0;">
                <header class="page-header">
                    <h1 class="page-title" style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-color);"><?php esc_html_e( '404', 'modern-blog-theme' ); ?></h1>
                    <h2 style="font-size: 2rem; margin-bottom: 2rem;"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'modern-blog-theme' ); ?></h2>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p style="margin-bottom: 2rem;"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'modern-blog-theme' ); ?></p>

                    <div style="max-width: 500px; margin: 0 auto 3rem;">
                        <?php get_search_form(); ?>
                    </div>

                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="read-more-button">
                        <?php esc_html_e( 'Return to Homepage', 'modern-blog-theme' ); ?>
                    </a>
                </div><!-- .page-content -->
            </section><!-- .error-404 -->
        </div>
	</main><!-- #main -->

<?php
get_footer();
