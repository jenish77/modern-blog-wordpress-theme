<?php
/**
 * The template for displaying all single posts
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

                        <div class="entry-meta">
                            <?php
                            echo get_the_date();
                            echo ' by ';
                            the_author();
                            ?>
                        </div>
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

                    <footer class="entry-footer">
                        <?php
                        // Tags, Categories, etc.
                        $categories_list = get_the_category_list( esc_html__( ', ', 'modern-blog-theme' ) );
                        if ( $categories_list ) {
                            printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'modern-blog-theme' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        }

                        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'modern-blog-theme' ) );
                        if ( $tags_list ) {
                            printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'modern-blog-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        }
                        ?>
                    </footer>
                </article>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

                the_post_navigation( array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'modern-blog-theme' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'modern-blog-theme' ) . '</span> <span class="nav-title">%title</span>',
                ) );

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
