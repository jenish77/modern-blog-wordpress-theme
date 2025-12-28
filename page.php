<?php
/**
 * The template for displaying all pages
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container grid-layout">

        <div class="content-area">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail( 'full' ); ?>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'modern-blog-theme' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>
                </article>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div>

        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </aside>

    </div>
</main>

<?php
get_footer();
