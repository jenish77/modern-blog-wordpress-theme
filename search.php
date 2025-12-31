<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="container grid-layout">
            <div class="content-area">

                <?php if ( have_posts() ) : ?>

                    <header class="page-header" style="margin-bottom: 2rem;">
                        <h1 class="page-title">
                            <?php
                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'modern-blog-theme' ), '<span>' . get_search_query() . '</span>' );
                            ?>
                        </h1>
                    </header><!-- .page-header -->

                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php
                                if ( has_post_thumbnail() ) :
                                    ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'large' ); ?>
                                        </a>
                                    </div>
                                    <?php
                                endif;

                                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                ?>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?> by <?php the_author(); ?>
                                </div>
                            </header>

                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="read-more-button"><?php esc_html_e( 'Read More', 'modern-blog-theme' ); ?></a>
                            </div>
                        </article>
                        <?php
                    endwhile;

                    the_posts_navigation();

                else :
                    ?>
                    <section class="no-results not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'modern-blog-theme' ); ?></h1>
                        </header>

                        <div class="page-content">
                            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'modern-blog-theme' ); ?></p>
                            <?php get_search_form(); ?>
                        </div>
                    </section>
                <?php
                endif;
                ?>

            </div><!-- .content-area -->

            <aside id="secondary" class="widget-area">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </aside>

        </div>
	</main><!-- #main -->

<?php
get_footer();
